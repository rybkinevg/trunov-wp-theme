<?php

add_rewrite_rule('press-centr/page/(\d+)/?$', 'index.php?pagename=press-centr&paged=$matches[1]', 'top');

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
        'slug' => 'gromkie_dela'
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

// add_action('init', 'create_post_taxes', 0);
add_action('after_setup_theme', 'create_post_taxes');

function create_post_taxes()
{
    global $post_taxes;

    foreach ($post_taxes as $tax) {

        $args = [
            'label'             => $tax['name'],
            'description'       => $tax['id'],
            'public'            => true,
            'hierarchical'      => false,
            'meta_box_cb'       => 'post_categories_meta_box',
            'show_admin_column' => false,
            'rewrite' => [
                'slug' => 'press-centr/' . $tax['slug'],
                'with_front' => false
            ]
        ];

        register_taxonomy(
            $tax['slug'],
            ['post'],
            $args
        );

        add_rewrite_rule('press-centr/' . $tax['slug'] . '/?$', 'index.php?post_type=' . 'post' . '&taxonomy=' . $tax['slug'], 'top');
        add_rewrite_rule('press-centr/' . $tax['slug'] . '/page/(\d+)/?$', 'index.php?post_type=' . 'post' . '&taxonomy=' . $tax['slug'] . '&paged=$matches[1]', 'top');
    }

    wp_insert_term(
        '«Громкий плагиат»',
        'gromkie_dela',
        [
            'slug'        => sanitize_title('«Громкий плагиат»'),
            'description' => '547'
        ]
    );
}
