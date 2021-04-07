<?php

namespace rybkinevg\trunov;

class Links extends Transfer
{
    static $post_type = 'post_links';

    public static function get($type = ''): array
    {
        global $wpdb;

        if (empty($type)) {

            return [];
        }

        if ($type == 'links') {

            $query = "
                SELECT
                    `ID`,
                    `post_type`,
                    `post_content`
                FROM
                    `{$wpdb->posts}`
                WHERE
                    `post_content` LIKE '%content.php?%'
                ORDER BY
                    `ID`
            ";
        }

        if ($type == 'docs') {

            $query = "
                SELECT
                    `ID`,
                    `post_content`
                FROM
                    `{$wpdb->posts}`
                WHERE
                    `post_content` LIKE '%.pdf%'
                OR
                    `post_content` LIKE '%.doc%'
                OR
                    `post_content` LIKE '%.docx%'
                ORDER BY
                    `ID`
            ";
        }

        $posts = $wpdb->get_results($query);

        return $posts;
    }

    public static function set_links()
    {
        global $wpdb;

        $posts = self::get('links');

        foreach ($posts as $post) {

            $html = new \simple_html_dom();

            $html->load($post->post_content);

            $links = $html->find('a[href*=content.php?]');

            foreach ($links as $link) {

                $link_explode = explode("=", $link->attr['href']);

                $content_id = array_pop($link_explode);

                $content_table = $wpdb->get_results("SELECT `title` FROM `content` WHERE `id` = '{$content_id}' LIMIT 1");

                if (empty($content_table)) {

                    $link->attr['href'] = "#broken-link-empty-content-{$content_id}";

                    continue;
                }

                $post_title = $content_table[0]->title;

                $posts_table = $wpdb->get_results("SELECT `id` FROM `aleksnet_document` WHERE `name` LIKE '%{$post_title}%' LIMIT 1");

                if (empty($posts_table)) {

                    $link->attr['href'] = "#broken-link-empty-posts-{$content_id}";

                    continue;
                }

                $found_post = get_post($posts_table[0]->id);

                $link->attr['href'] = wp_make_link_relative(get_permalink($found_post));
            }

            $new_post_content = $html->save();

            $wpdb->update(
                $wpdb->posts,
                ['post_content' => $new_post_content],
                ['ID' => $post->ID]
            );
        }
    }

    public static function set_docs()
    {
        global $wpdb;

        $posts = self::get('docs');

        foreach ($posts as $post) {

            $html = new \simple_html_dom();

            $html->load($post->post_content);

            $links = $html->find('a[href*=.doc], a[href*=.docx], a[href*=.pdf]');

            foreach ($links as $link) {

                $url     = $link->href;
                $post_id = $post->ID;
                $desc    = basename($url);

                $url_arr = parse_url($url);

                if ($url_arr['host'] == 'redcross-moscow.ru') {

                    $url_arr['host'] = 'redcross-mos.ru';

                    $url = reverse_parse_url($url_arr);
                }

                if (is_attach_exists($desc))
                    continue;

                // Загрузим файл
                $tmp = download_url($url);

                // Установим данные файла
                $file_array = [
                    'name'     => basename($url),
                    'tmp_name' => $tmp,
                    'error'    => 0,
                    'size'     => filesize($tmp),
                ];

                // загружаем файл
                $id = media_handle_sideload($file_array, $post_id, $desc);

                if (is_wp_error($id)) {

                    unset($id);

                    unset($tmp);

                    // Загрузим новый файл, подставляем исходную ссылку
                    $tmp = download_url('https://trunov.com/' . $url);

                    // Установим данные файла
                    $file_array = [
                        'name'     => basename($url),
                        'tmp_name' => $tmp,
                        'error'    => 0,
                        'size'     => filesize($tmp),
                    ];

                    // загружаем файл
                    $id = media_handle_sideload($file_array, $post_id, $desc);

                    // Ссылка на файл успешно загружена
                    $new_link = wp_make_link_relative(wp_get_attachment_url($id));

                    if (is_wp_error($id)) {

                        // Ошибка
                        $new_link = '#broken-link-file-' . $url;
                    }
                } else {

                    // Ссылка на файл успешно загружена
                    $new_link = wp_make_link_relative(wp_get_attachment_url($id));
                }

                // удалим временный файл
                @unlink($tmp);

                // Присваеваем новую ссылку на файл
                $link->attr['href'] = $new_link;
            }

            $new_post_content = $html->save();

            $wpdb->update(
                $wpdb->posts,
                ['post_content' => $new_post_content],
                ['ID' => $post->ID]
            );
        }
    }

    public static function actions()
    {
        add_action('admin_action_' . self::$post_type . '_set_links', function () {

            self::set_links();

            wp_redirect($_SERVER['HTTP_REFERER']);

            exit();
        });

        add_action('admin_action_' . self::$post_type . '_set_docs', function () {

            self::set_docs();

            wp_redirect($_SERVER['HTTP_REFERER']);

            exit();
        });
    }

    public static function page_block()
    {
        $data = [
            'title' => 'Внутренние ссылки',
            'status' => '',
            'forms' => [
                [
                    'title'  => 'Починить внутренние ссылки',
                    'desc'   => '<p>Процесс починки ссылок типа - content.php?</p><p>Изменить руками нужно эти посты: 211, 218, 6831, 6833, 10226</p><p>Битые ссылки: 186 шт.</p><p>Починено: 76 шт.</p>',
                    'btn'    => 'Начать',
                    'action' => self::$post_type . '_set_links'
                ],
                [
                    'title'  => 'Скачать документы',
                    'desc'   => '<p>Проверить все ссылки на документы и скачать их</p>',
                    'btn'    => 'Начать',
                    'action' => self::$post_type . '_set_docs'
                ]
            ]
        ];

        return $data;
    }
}
