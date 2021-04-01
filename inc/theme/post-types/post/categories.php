<?php

function create_post_cats()
{
    require_once(ABSPATH . '/wp-admin/includes/taxonomy.php');

    $post_cats = [
        'Новости' => [
            'ID'   => 1,
            'name' => 'Новости',
            'desc' => 'Категория обычных новостей сайта',
            'slug' => 'news'
        ],
        'Новости СМИ' => [
            'ID'   => 0,
            'name' => 'Новости СМИ',
            'desc' => 'Категория новостей в СМИ',
            'slug' => 'news_smi'
        ]
    ];

    foreach ($post_cats as $cat) {

        $args = [
            'cat_ID'               => $cat['ID'],
            'cat_name'             => $cat['name'],
            'category_description' => $cat['desc'],
            'category_nicename'    => $cat['slug'],
            'taxonomy'             => 'category'
        ];

        wp_insert_category($args);
    }
}

create_post_cats();
