<?php

add_action('init', 'register_partners');

function register_partners()
{
    $post_type = 'partners';

    $args = [
        'label'  => null,
        'labels' => [
            'name'               => 'Партнёры',
            'singular_name'      => 'Партнёр',
            'add_new'            => 'Добавить партнёра',
            'add_new_item'       => 'Добавление партнёра',
            'edit_item'          => 'Редактирование партнёра',
            'new_item'           => 'Новый партнёр',
            'view_item'          => 'Смотреть партнёра',
            'search_items'       => 'Искать партнёра',
            'not_found'          => 'Не найдено',
            'not_found_in_trash' => 'Не найдено в корзине',
            'parent_item_colon'  => '',
            'menu_name'          => 'Партнёры',
        ],
        'description'         => '',
        'public'              => true,
        'publicly_queryable'  => false,
        'show_in_menu'        => null,
        'show_in_rest'        => null,
        'rest_base'           => null,
        'menu_position'       => null,
        'menu_icon'           => 'dashicons-groups',
        'hierarchical'        => false,
        'supports'            => ['title', 'thumbnail'],
        'taxonomies'          => [],
        'has_archive'         => true,
        'rewrite'             => true,
        'query_var'           => true,
    ];

    register_post_type($post_type, $args);
}
