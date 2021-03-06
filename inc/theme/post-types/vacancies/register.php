<?php

add_action('init', 'register_vacancies');

function register_vacancies()
{
    $post_type = 'vacancies';

    $rewrite = [
        'slug'     => 'vacancy',
        'in_front' => true
    ];

    $args = [
        'label'  => null,
        'labels' => [
            'name'               => 'Вакансии',
            'singular_name'      => 'Вакансия',
            'add_new'            => 'Добавить вакансию',
            'add_new_item'       => 'Добавление вакансии',
            'edit_item'          => 'Редактирование вакансии',
            'new_item'           => 'Новая вакансия',
            'view_item'          => 'Смотреть вакансии',
            'search_items'       => 'Искать вакансию',
            'not_found'          => 'Не найдено',
            'not_found_in_trash' => 'Не найдено в корзине',
            'parent_item_colon'  => '',
            'menu_name'          => 'Вакансии',
        ],
        'description'         => '',
        'public'              => true,
        'show_in_menu'        => null,
        'show_in_rest'        => null,
        'rest_base'           => null,
        'menu_position'       => null,
        'menu_icon'           => 'dashicons-search',
        'hierarchical'        => false,
        'supports'            => ['title', 'editor', 'excerpt'],
        'taxonomies'          => [],
        'has_archive'         => true,
        'rewrite'             => $rewrite,
        'query_var'           => true,
    ];

    register_post_type($post_type, $args);
}
