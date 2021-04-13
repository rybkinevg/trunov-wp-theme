<?php

add_action('init', 'services_register');

function services_register()
{
    $post_type = 'services';

    $rewrite = [
        'slug'     => 'uslugi',
        'in_front' => true
    ];

    $args = [
        'label'  => null,
        'labels' => [
            'name'               => 'Услуги',
            'singular_name'      => 'Услуга',
            'add_new'            => 'Добавить услугу',
            'add_new_item'       => 'Добавление услуги',
            'edit_item'          => 'Редактирование услуги',
            'new_item'           => 'Новая услуга',
            'view_item'          => 'Смотреть услугу',
            'search_items'       => 'Искать услугу',
            'not_found'          => 'Не найдено',
            'not_found_in_trash' => 'Не найдено в корзине',
            'parent_item_colon'  => '',
            'menu_name'          => 'Услуги',
        ],
        'description'         => '',
        'public'              => true,
        'show_in_nav_menus'   => true,
        'show_in_menu'        => null,
        'show_in_rest'        => null,
        'rest_base'           => null,
        'menu_position'       => null,
        'menu_icon'           => 'dashicons-megaphone',
        'hierarchical'        => true,
        'supports'            => ['title', 'editor', 'page-attributes', 'thumbnail', 'excerpt'],
        'taxonomies'          => [],
        'has_archive'         => true,
        'rewrite'             => $rewrite,
        'query_var'           => true,
    ];

    register_post_type($post_type, $args);
}
