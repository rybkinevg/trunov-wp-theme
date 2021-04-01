<?php

add_action('init', 'create_post_taxes', 0);

function create_post_taxes()
{
    $post_taxes = [
        [
            'id'   => '55',
            'name' => 'СМИ',
            'slug' => 'smi'
        ],
        [
            'id'   => '397',
            'name' => 'Архивы',
            'slug' => 'archive'
        ],
        [
            'id'   => '403',
            'name' => 'Громкие дела',
            'slug' => 'high-profile-cases'
        ],
        [
            'id'   => '447',
            'name' => 'Темы',
            'slug' => 'topics'
        ],
        [
            'id'   => '400',
            'name' => 'Телепередачи',
            'slug' => 'tv'
        ]
    ];

    foreach ($post_taxes as $tax) {

        $args = [
            'label'             => $tax['name'],
            'description'       => $tax['id'],
            'public'            => true,
            'hierarchical'      => false,
            'meta_box_cb'       => 'post_categories_meta_box',
            'show_admin_column' => false,
            'show_in_rest'      => true
        ];

        register_taxonomy(
            $tax['slug'],
            ['post'],
            $args
        );
    }

    wp_insert_term(
        '«Громкий плагиат»',
        'high-profile-cases',
        [
            'slug'        => sanitize_title('«Громкий плагиат»'),
            'description' => '547'
        ]
    );
}
