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
            'show_in_nav_menus' => true,
            'show_ui'           => true,
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

add_action('pre_get_posts', 'alter_query');

function alter_query($query)
{
    if (!$query->is_main_query())
        return;

    $post_taxes = [
        'smi',
        'archive',
        'gromkie_dela',
        'topics',
        'tv',
    ];

    $tax = $query->get('taxonomy');

    $paged = $query->get('paged') ?: 1;

    if (in_array($tax, $post_taxes)) {

        $new_query = new WP_Query([
            'post_type'      => 'post',
            'posts_per_page' => get_option('posts_per_page', 10),
            'paged'          => $paged,
            'meta_key'       => '_sort',
            'orderby'        => [
                'meta_value_num' => 'ASC',
                'date'           => 'DESC'
            ],
            'tax_query'      => [
                [
                    'taxonomy' => $tax,
                    'operator' => 'EXISTS'
                ]
            ]
        ]);

        $query->set('query', $query->parse_query($new_query->query));
    }
}
