<?php

namespace rybkinevg\trunov;

class Views extends Transfer
{
    static $post_type = 'post-views';

    protected static function get(): array
    {
        global $wpdb;

        $query = "
            SELECT
                `ID`
            FROM
                `wp_posts`
            WHERE
                `post_type` = 'post'
            ORDER BY
                `ID`
        ";

        $posts = $wpdb->get_results($query);

        return $posts;
    }

    public static function set()
    {
        global $wpdb;

        $posts = self::get();

        foreach ($posts as $post) {

            $post_id = $post->ID;

            $query = "
                SELECT
                    COUNT(*)
                FROM
                    `aleksnet_view`
                WHERE
                    `id_doc` = '{$post_id}'
            ";

            $views = $wpdb->get_var($query);

            $insert_query = "
                INSERT INTO {$wpdb->prefix}post_views (id, type, period, count)
                VALUES ({$post_id}, 4, 'total', {$views})
            ";

            $inserted = $wpdb->query($insert_query);

            if (!$inserted) {

                parent::show_error(null, 'Ошибка импорта просмотров записи в таблицу wp_post_views, ID - ' . $post_id);
            }
        }
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
            'title' => 'Просмотры страниц',
            'status' => '',
            'forms' => [
                [
                    'title'  => 'Импорт',
                    'desc'   => 'Импорт просмотров страниц',
                    'btn'    => 'Импортировать',
                    'action' => self::$post_type . '_get'
                ]
            ]
        ];

        return $data;
    }
}
