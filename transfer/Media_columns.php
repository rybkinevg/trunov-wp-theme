<?php

namespace rybkinevg\trunov;

class Media_columns extends Transfer
{
    static $post_type = 'media-columns';

    protected static function get(): array
    {
        global $wpdb;

        // Убрал из запроса выборки по 16018 (= Колонки Адвоката трунова)
        // Убрал из запроса выборки по 16019 (= Список СМИ, указал их руками)
        $query = "
            SELECT
                *
            FROM
                `aleksnet_document`
            WHERE
                `parent_id` = '16020'
            OR
                `parent_id` = '16021'
            OR
                `parent_id` = '16022'
            OR
                `parent_id` = '16023'
            OR
                `parent_id` = '16024'
            ORDER BY
                `id`
        ";

        $posts = $wpdb->get_results($query);

        return $posts;
    }

    public static function set()
    {
        $status = parent::get_status(self::$post_type);

        if ($status)
            parent::show_error(null, 'Данные типа записи "' . self::$post_type . '" уже импортированы');

        $posts = self::get();

        foreach ($posts as $post) {

            $args = [
                'post_type'    => self::$post_type
            ];

            $data = parent::generate_args($post, $args);

            $inserted = wp_insert_post($data, true);

            if (is_wp_error($inserted)) {

                parent::show_error($inserted, "<p>ID поста: {$post->id}</p>");
            }

            carbon_set_post_meta($inserted, 'media-columns-url', $post->url);

            $tax_slug = 'media';

            if ($post->parent_id == '16020') {

                $term = get_term_by('name', 'Мир и Политика', $tax_slug);
            }

            if ($post->parent_id == '16021') {

                $term = get_term_by('name', 'Вечерняя Москва', $tax_slug);
            }

            if ($post->parent_id == '16022') {

                $term = get_term_by('name', 'INFOX.RU', $tax_slug);
            }

            if ($post->parent_id == '16023') {

                $term = get_term_by('name', 'РБК', $tax_slug);
            }

            if ($post->parent_id == '16024') {

                $term = get_term_by('name', 'Forbes', $tax_slug);
            }

            $term_id = $term->term_id;

            $inserted = wp_set_post_terms($post->id, [$term_id], $tax_slug, true);

            if (is_wp_error($inserted)) {

                $message = "
                        <p>ID поста: {$post->id}</p>
                        <p>ID термина: {$term_id}</p>
                    ";

                parent::show_error($inserted, $message);
            }

            wp_set_post_terms(
                $post->id,
                [get_term_by('name', 'Трунов Игорь Леонидович', 'column-author')->term_id],
                'column-author',
                true
            );
        }

        $updated = parent::set_status(self::$post_type, 'Выполнено');

        if (!$updated)
            parent::show_error(null, var_dump($status));
    }

    public static function set_thumbs()
    {
        $posts = self::get();

        foreach ($posts as $post) {

            parent::set_post_thumb($post->id, $post->url_img);
        }
    }

    public static function actions()
    {
        add_action('admin_action_' . self::$post_type . '_get', function () {

            self::set();

            wp_redirect($_SERVER['HTTP_REFERER']);

            exit();
        });

        add_action('admin_action_' . self::$post_type . '_set_thumbs', function () {

            self::set_thumbs();

            wp_redirect($_SERVER['HTTP_REFERER']);

            exit();
        });

        add_action('admin_action_' . self::$post_type . '_delete', function () {

            parent::delete(self::get(), self::$post_type);

            wp_redirect($_SERVER['HTTP_REFERER']);

            exit();
        });
    }

    public static function page_block()
    {
        $data = [
            'title' => 'Колонки СМИ',
            'status' => parent::get_status(self::$post_type),
            'forms' => [
                [
                    'title'  => 'Импорт',
                    'desc'   => 'Импорт записей из колонок СМИ',
                    'btn'    => 'Импортировать',
                    'action' => self::$post_type . '_get'
                ],
                [
                    'title'  => 'Миниатюры',
                    'desc'   => 'Скачать и установить миниатюры',
                    'btn'    => 'Скачать',
                    'action' => self::$post_type . '_set_thumbs'
                ],
                [
                    'title'  => 'Очистка',
                    'desc'   => 'Удаление записей, а так же привязки к таксономиям, комментариям и мета-полям',
                    'btn'    => 'Удалить',
                    'action' => self::$post_type . '_delete'
                ]
            ]
        ];

        return $data;
    }
}
