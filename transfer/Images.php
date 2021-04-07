<?php

namespace rybkinevg\trunov;

class Images extends Transfer
{
    static $post_type = 'post_images';

    protected static function get()
    {
        global $wpdb;

        $query = "
            SELECT
                `post_content`,
                `ID`,
                `post_title`
            FROM
                {$wpdb->posts}
            WHERE
                `post_content`
            LIKE
                '%<img%'
        ";

        $posts = $wpdb->get_results($query);

        return $posts;
    }

    public static function set()
    {
        $posts = self::get();

        global $wpdb;

        foreach ($posts as $post) {

            $html = new \simple_html_dom();

            $html->load($post->post_content);

            $imgs = $html->find('img');

            foreach ($imgs as $img) {

                $img->setAttribute('src', self::download_image($img->attr['src'], $post->ID));
                $img->setAttribute('class', 'aligncenter');
                $img->setAttribute('alt', '');
            }

            $new_content = $html->save();

            $wpdb->update(
                $wpdb->posts,
                ['post_content' => $new_content],
                ['ID' => $post->ID]
            );
        }
    }

    protected static function download_image($url, $post_id)
    {
        require_once(ABSPATH . 'wp-admin/includes/media.php');
        require_once(ABSPATH . 'wp-admin/includes/file.php');
        require_once(ABSPATH . 'wp-admin/includes/image.php');

        $url = str_replace('\\', '/', $url);

        $url_to_arr = explode('/', $url);

        if ($url_to_arr[0] == '..' || $url_to_arr[0] == '.' || $url_to_arr[0] == '' || $url_to_arr[0] == 'trunov.com') {

            $url_to_arr[0] = 'http://trunov.com';
        }

        $url = implode('/', $url_to_arr);

        $file_name = "post-img-{$post_id}";

        $thumb_src = media_sideload_image($url, $post_id, $file_name, 'src');

        if (is_wp_error($thumb_src)) {

            $url = 'http://trunov.com/' . $url;

            $thumb_src = media_sideload_image($url, $post_id, $file_name, 'src');
        }

        return (!is_wp_error($thumb_src)) ? wp_make_link_relative($thumb_src) : '#broken-link-img-' . $url;
    }

    public static function actions()
    {
        add_action('admin_action_' . self::$post_type . '_get', function () {

            self::set();

            wp_redirect($_SERVER['HTTP_REFERER']);

            exit();
        });
    }

    public static function page_block()
    {
        $data = [
            'title' => 'Внутренние картинки',
            'status' => '',
            'forms' => [
                [
                    'title'  => 'Скачать',
                    'desc'   => 'Скачать и установить внутренние картинки постов',
                    'btn'    => 'Скачать',
                    'action' => self::$post_type . '_get'
                ]
            ]
        ];

        return $data;
    }
}
