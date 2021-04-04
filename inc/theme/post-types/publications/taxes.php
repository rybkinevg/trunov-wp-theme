<?php

// Таксономия: Разделы
add_action('init', 'register_publications_categories');

function register_publications_categories()
{
    $tax_name = 'publications-categories';

    $post_types = ['publications'];

    $default_term = [
        'name'        => 'Научные публикации адвокатов коллегии',
        'slug'        => 'nauchnye_publikacii_advokatov_kollegii',
        'description' => '16076'
    ];

    $args = [
        'label'                 => 'Разделы',
        'description'           => '',
        'public'                => true,
        'hierarchical'          => false,
        'rewrite'               => [
            'slug' => 'nauchnye_i_uchebno_metodicheskie_trudy',
            'with_front' => true
        ],
        'meta_box_cb'           => 'post_categories_meta_box',
        'show_admin_column'     => true,
        'show_in_rest'          => true,
        'default_term'          => $default_term
    ];

    register_taxonomy($tax_name, $post_types, $args);

    add_rewrite_rule('nauchnye_i_uchebno_metodicheskie_trudy/' . 'nauchnye_publikacii_advokatov_kollegii' . '/?$', 'index.php?post_type=' . 'publications' . '&taxonomy=' . 'publications-categories', 'top');
    add_rewrite_rule('nauchnye_i_uchebno_metodicheskie_trudy/' . 'nauchnye_publikacii_advokatov_kollegii' . '/page/(\d+)/?$', 'index.php?post_type=' . 'publications' . '&taxonomy=' . 'publications-categories' . '&paged=$matches[1]', 'top');

    add_rewrite_rule('nauchnye_i_uchebno_metodicheskie_trudy/' . 'spisok_nauchnyh_i_uchebno-metodicheskih_trudov_advokata_trunova' . '/?$', 'index.php?post_type=' . 'publications' . '&taxonomy=' . 'publications-categories', 'top');
    add_rewrite_rule('nauchnye_i_uchebno_metodicheskie_trudy/' . 'spisok_nauchnyh_i_uchebno-metodicheskih_trudov_advokata_trunova' . '/page/(\d+)/?$', 'index.php?post_type=' . 'publications' . '&taxonomy=' . 'publications-categories' . '&paged=$matches[1]', 'top');

    add_rewrite_rule('nauchnye_i_uchebno_metodicheskie_trudy/' . 'spisok_nauchnyh_i_uchebno-metodicheskih_trudov_advokata_ajvar' . '/?$', 'index.php?post_type=' . 'publications' . '&taxonomy=' . 'publications-categories', 'top');
    add_rewrite_rule('nauchnye_i_uchebno_metodicheskie_trudy/' . 'spisok_nauchnyh_i_uchebno-metodicheskih_trudov_advokata_ajvar' . '/page/(\d+)/?$', 'index.php?post_type=' . 'publications' . '&taxonomy=' . 'publications-categories' . '&paged=$matches[1]', 'top');

    $taxes = [
        [
            'name' => 'Список научных и учебно-методических трудов адвоката Айвар Людмилы Константиновны',
            'id'   => '15539',
            'slug' => 'spisok_nauchnyh_i_uchebno-metodicheskih_trudov_advokata_trunova'
        ],
        [
            'name' => 'Список научных и учебно-методических трудов адвоката Трунова Игоря Леонидовича',
            'id'   => '15010',
            'slug' => 'spisok_nauchnyh_i_uchebno-metodicheskih_trudov_advokata_ajvar'
        ],
    ];

    foreach ($taxes as $tax) {

        wp_insert_term(
            $tax['name'],
            $tax_name,
            [
                'slug'        => $tax['slug'],
                'description' => $tax['id']
            ]
        );
    }
}

// Таксономия: Типы
add_action('init', 'register_publications_types');

function register_publications_types()
{
    $tax_name = 'publications-types';

    $post_types = ['publications'];

    $default_term = [
        'name'        => 'Научные статьи',
        'slug'        => sanitize_title('Научные статьи'),
        'description' => 'Айвар - 15540, Трунов - 15011'
    ];

    $args = [
        'label'                 => 'Типы',
        'description'           => '',
        'public'                => true,
        'hierarchical'          => false,
        'rewrite'               => [
            'slug'     => 'nauchnye_i_uchebno_metodicheskie_trudy',
            'in_front' => true
        ],
        'meta_box_cb'           => 'post_categories_meta_box',
        'show_admin_column'     => true,
        'show_in_rest'          => true,
        'default_term'          => $default_term
    ];

    register_taxonomy($tax_name, $post_types, $args);

    wp_insert_term(
        'Книги, монографии',
        $tax_name,
        [
            'slug'        => sanitize_title('Книги, монографии'),
            'description' => 'Айвар - 15541, Трунов - 15012'
        ]
    );
}
