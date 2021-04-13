<?php

add_action('after_setup_theme', 'trunov_setup');

if (!function_exists('trunov_setup')) {

    function trunov_setup()
    {
        // Генерация заголовка страницы
        add_theme_support('title-tag');

        // Поддержка миниатюр кастомных постов
        add_theme_support('post-thumbnails');

        // Навигационные меню
        register_nav_menus(
            [
                'header' => 'Меню в шапке',
                'footer' => 'Меню в подвале'
            ]
        );

        /*
         * Switch default core markup for search form, comment form, and comments
         * to output valid HTML5.
         */
        add_theme_support(
            'html5',
            array(
                'search-form',
                'comment-form',
                'comment-list',
                'gallery',
                'caption',
                'style',
                'script',
            )
        );
    }
}

require_once get_template_directory() . '/inc/autoload.php';

require_once get_template_directory() . '/transfer/init.php';

require_once get_template_directory() . '/carbon-fields/carbon-fields.php';

function set_sort()
{
    global $wpdb;

    $query = "
        SELECT
            ID
        FROM
            {$wpdb->posts}
        WHERE
            `post_type` = 'post'
        OR
            `post_type` = 'advocats'
        OR
            `post_type` = 'juristy'
    ";

    $results = $wpdb->get_results($query);

    if ($results) {

        foreach ($results as $post) {

            $query = "
                SELECT
                    `meta_value`
                FROM
                    {$wpdb->postmeta}
                WHERE
                    `post_id` = '{$post->ID}'
                AND
                    `meta_key` = '_sort'
            ";

            $sort = $wpdb->get_var($query);

            if (is_null($sort)) {

                $default = [
                    'post_id'    => $post->ID,
                    'meta_key'   => '_sort',
                    'meta_value' => '10'
                ];

                $inserted_id = $wpdb->insert(
                    $wpdb->postmeta,
                    $default
                );

                if (!$inserted_id) {

                    wp_die("Ошибка проставления порядка сортировки для поста - {$post->ID}");
                }
            }
        }
    }
}

// set_sort();
