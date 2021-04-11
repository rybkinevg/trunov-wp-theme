<?php

/**
 * Таксономия: Автор колонки
 */
add_action('init', 'create_column_author');

function create_column_author()
{
    $tax_name = 'column-author';

    $post_types = ['media-columns'];

    $args = [
        'label'                 => 'Автор колонки',
        'description'           => '',
        'public'                => true,
        'hierarchical'          => false,
        'rewrite'               => true,
        'meta_box_cb'           => 'post_categories_meta_box',
        'show_admin_column'     => true,
        'show_in_rest'          => true
    ];

    register_taxonomy($tax_name, $post_types, $args);

    wp_insert_term(
        'Трунов Игорь Леонидович',
        $tax_name,
        [
            'slug'        => sanitize_title('Трунов Игорь Леонидович'),
            'description' => '16019'
        ]
    );
}

/**
 * Таксономия: СМИ
 */
add_action('init', 'create_media');

function create_media()
{
    $tax_name = 'media';

    $post_types = ['media-columns'];

    $args = [
        'label'                 => 'СМИ',
        'description'           => '',
        'public'                => true,
        'hierarchical'          => false,
        'rewrite'               => true,
        'meta_box_cb'           => 'post_categories_meta_box',
        'show_admin_column'     => true,
        'show_in_rest'          => true
    ];

    register_taxonomy($tax_name, $post_types, $args);

    wp_insert_term(
        'Мир и Политика',
        $tax_name,
        [
            'slug'        => sanitize_title('Мир и Политика'),
            'description' => '16020'
        ]
    );

    wp_insert_term(
        'Вечерняя Москва',
        $tax_name,
        [
            'slug'        => sanitize_title('Вечерняя Москва'),
            'description' => '16021'
        ]
    );

    wp_insert_term(
        'INFOX.RU',
        $tax_name,
        [
            'slug'        => sanitize_title('INFOX.RU'),
            'description' => '16022'
        ]
    );

    wp_insert_term(
        'РБК',
        $tax_name,
        [
            'slug'        => sanitize_title('РБК'),
            'description' => '16023'
        ]
    );

    wp_insert_term(
        'Forbes',
        $tax_name,
        [
            'slug'        => sanitize_title('Forbes'),
            'description' => '16024'
        ]
    );
}
