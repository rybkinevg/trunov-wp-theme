<?php

add_action('switch_theme', 'create_pages');

function create_pages()
{
    $pages = [
        [
            'title' => 'Главная',
            'content' => '',
            'name' => 'home',
        ],
        [
            'title' => 'Пресс-центр',
            'content' => '',
            'name' => 'press-centr',
        ],
        [
            'title' => 'Контакты',
            'content' => '',
            'name' => 'contacts',
        ]
    ];

    foreach ($pages as $page) {

        if (get_page_by_title($page['title']))
            continue;

        $args = [
            'post_type'    => 'page',
            'post_title'   => $page['title'],
            'post_content' => $page['content'],
            'post_status'  => 'publish',
            'post_author'  => 1,
            'post_name'    => $page['name']
        ];

        $page_id = wp_insert_post($args);

        if ($page_id) {

            if ($page['title'] == 'Главная') {

                update_option('page_on_front', $page_id);
                update_option('show_on_front', 'page');
            } else if ($page['title'] == 'Пресс-центр') {

                update_option('page_for_posts', $page_id);
            }
        }
    }
}
