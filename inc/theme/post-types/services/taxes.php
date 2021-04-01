<?php

add_action('init', 'services_taxes');

function services_taxes()
{
    $tax_name = 'services-type';

    $post_types = ['services'];

    $default_term = [
        'name'        => 'Юридическим лицам',
        'slug'        => sanitize_title('Юридическим_лицам'),
        'description' => '16789'
    ];

    $args = [
        'label'                 => 'Категории',
        'description'           => '',
        'public'                => true,
        'hierarchical'          => false,
        'rewrite'               => true,
        'meta_box_cb'           => 'post_categories_meta_box',
        'show_admin_column'     => true,
        'show_in_rest'          => true,
        'default_term'          => $default_term,
        'rewrite'               => [
            'slug'       => 'uslugi',
            'in_front'   => true
        ]
    ];

    register_taxonomy($tax_name, $post_types, $args);

    wp_insert_term(
        'Физическим лицам',
        $tax_name,
        [
            'slug'        => sanitize_title('Физическим_лицам'),
            'description' => '16790'
        ]
    );

    wp_insert_term(
        'Юридический бизнес',
        $tax_name,
        [
            'slug'        => sanitize_title('Юридический_бизнес'),
            'description' => '118'
        ]
    );
}
