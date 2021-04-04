<?php

add_action('init', 'register_juristy');

function register_juristy()
{
    $post_type = 'juristy';

    $args = [
        'label'  => null,
        'labels' => [
            'name'               => 'Юристы',
            'singular_name'      => 'Юрист',
            'add_new'            => 'Добавить юриста',
            'add_new_item'       => 'Добавление юриста',
            'edit_item'          => 'Редактирование юриста',
            'new_item'           => 'Новый юрист',
            'view_item'          => 'Смотреть юриста',
            'search_items'       => 'Искать юриста',
            'not_found'          => 'Не найдено',
            'not_found_in_trash' => 'Не найдено в корзине',
            'parent_item_colon'  => '',
            'menu_name'          => 'Юристы',
        ],
        'description'         => '',
        'public'              => true,
        'show_in_menu'        => null,
        'show_in_rest'        => null,
        'rest_base'           => null,
        'menu_position'       => null,
        'menu_icon'           => 'dashicons-businessman',
        'hierarchical'        => false,
        'supports'            => ['title', 'editor', 'thumbnail'],
        'has_archive'         => true,
        'rewrite'             => true,
        'query_var'           => true,
    ];

    register_post_type($post_type, $args);
}
