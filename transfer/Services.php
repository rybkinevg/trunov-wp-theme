<?php

namespace rybkinevg\trunov;

class Services extends Transfer
{
    static $post_type = 'services';

    protected static function get(): array
    {
        global $wpdb;

        $query = "
            SELECT
                *
            FROM
                `aleksnet_document`
            WHERE
                `id` = '16789'
            OR
                `id` = '16790'
            OR
                `id` = '118'
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
                'post_type' => self::$post_type
            ];

            $data = parent::generate_args($post, $args);

            $inserted = wp_insert_post($data, true);

            if (is_wp_error($inserted)) {

                parent::show_error($inserted, "<p>ID поста: {$post->id}</p>");
            }

            self::get_services_children($inserted);
        }

        $updated = parent::set_status(self::$post_type, 'Выполнено');

        if (!$updated)
            parent::show_error(null, var_dump($status));
    }

    protected static function get_services_children($id)
    {
        global $wpdb;

        $query = "
            SELECT
                *
            FROM
                `aleksnet_document`
            WHERE
                `parent_id` = '{$id}'
            ORDER BY
                `id`
        ";

        $posts = $wpdb->get_results($query);

        if (!is_null($posts) && !empty($posts)) {

            foreach ($posts as $post) {

                $args = [
                    'post_type'    => self::$post_type,
                    'post_parent'  => $id
                ];

                $data = parent::generate_args($post, $args);

                $child_inserted = wp_insert_post($data, true);

                if (is_wp_error($child_inserted)) {

                    $message = "
                        <p>ID поста: {$post->id}</p>
                        <p>ID родителя: {$post->parent_id}</p>
                    ";

                    self::show_error($child_inserted, $message);
                }

                self::get_services_children($child_inserted);
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

        add_action('admin_action_' . self::$post_type . '_delete', function () {

            parent::delete(self::get(), self::$post_type);

            wp_redirect($_SERVER['HTTP_REFERER']);

            exit();
        });
    }

    public static function page_block()
    {
        $data = [
            'title' => 'Услуги',
            'status' => parent::get_status(self::$post_type),
            'forms' => [
                [
                    'title'  => 'Импорт',
                    'desc'   => 'Импорт услуг, их дочерних страниц и таксономий',
                    'btn'    => 'Импортировать',
                    'action' => self::$post_type . '_get'
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
