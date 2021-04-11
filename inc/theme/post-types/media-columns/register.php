<?php

add_action('init', 'register_media_columns');

function register_media_columns()
{
    $post_type = 'media-columns';

    $rewrite = [
        'slug'     => 'kolonki_smi',
        'in_front' => true
    ];

    $args = [
        'label'  => null,
        'labels' => [
            'name'               => 'Колонки СМИ',
            'singular_name'      => 'Колонка СМИ',
            'add_new'            => 'Добавить колонку',
            'add_new_item'       => 'Добавление колонки',
            'edit_item'          => 'Редактирование колонки',
            'new_item'           => 'Новая колонка',
            'view_item'          => 'Смотреть колонку',
            'search_items'       => 'Искать колонку',
            'not_found'          => 'Не найдено',
            'not_found_in_trash' => 'Не найдено в корзине',
            'parent_item_colon'  => '',
            'menu_name'          => 'Колонки СМИ',
        ],
        'description'         => '',
        'public'              => true,
        'publicly_queryable'  => false,
        'show_in_menu'        => null,
        'show_in_rest'        => null,
        'rest_base'           => null,
        'menu_position'       => null,
        'menu_icon'           => 'dashicons-rss',
        'hierarchical'        => false,
        'supports'            => ['title', 'editor'],
        'taxonomies'          => [],
        'has_archive'         => true,
        'rewrite'             => $rewrite,
        'query_var'           => true,
    ];

    register_post_type($post_type, $args);
}
