<?php

/**
 * Тип записи: Научные и учебно-методические труды
 */

add_action('init', 'register_publications', 20);

function register_publications()
{
    $post_type = 'publications';

    // $rewrite = [
    //     'slug'     => 'nauchnye_i_uchebno_metodicheskie_trudy',
    //     'in_front' => true
    // ];

    $args = [
        'label'  => null,
        'labels' => [
            'name'               => 'Научные и учебно-методические труды',
            'singular_name'      => 'Научные и учебно-методические труды',
            'add_new'            => 'Добавить труд',
            'add_new_item'       => 'Добавление труда',
            'edit_item'          => 'Редактирование труда',
            'new_item'           => 'Новый труд',
            'view_item'          => 'Смотреть труд',
            'search_items'       => 'Искать труд',
            'not_found'          => 'Не найдено',
            'not_found_in_trash' => 'Не найдено в корзине',
            'parent_item_colon'  => '',
            'menu_name'          => 'Научные труды',
        ],
        'description'         => '',
        'public'              => true,
        'show_in_menu'        => true,
        'show_in_rest'        => null,
        'rest_base'           => null,
        'menu_position'       => null,
        'menu_icon'           => 'dashicons-welcome-learn-more',
        'hierarchical'        => false,
        'supports'            => ['title', 'editor'],
        'taxonomies'          => [],
        'has_archive'         => 'nauchnye_i_uchebno_metodicheskie_trudy',
        'rewrite'             => true,
        'query_var'           => true
    ];

    register_post_type($post_type, $args);
}
