<?php

add_action('init', 'register_advocats');

function register_advocats()
{
    $post_type = 'advocats';

    $args = [
        'label'  => null,
        'labels' => [
            'name'               => 'Адвокаты',
            'singular_name'      => 'Адвокат',
            'add_new'            => 'Добавить адвоката',
            'add_new_item'       => 'Добавление адвоката',
            'edit_item'          => 'Редактирование адвоката',
            'new_item'           => 'Новый адвокат',
            'view_item'          => 'Смотреть адвоката',
            'search_items'       => 'Искать адвоката',
            'not_found'          => 'Не найдено',
            'not_found_in_trash' => 'Не найдено в корзине',
            'parent_item_colon'  => '',
            'menu_name'          => 'Адвокаты',
        ],
        'description'         => '',
        'public'              => true,
        'show_in_menu'        => null,
        'show_in_rest'        => null,
        'rest_base'           => null,
        'menu_position'       => null,
        'menu_icon'           => 'dashicons-businessman',
        'hierarchical'        => false,
        'supports'            => ['title', 'editor', 'thumbnail', 'excerpt'],
        'has_archive'         => true,
        'rewrite'             => true,
        'query_var'           => true,
    ];

    register_post_type($post_type, $args);
}
