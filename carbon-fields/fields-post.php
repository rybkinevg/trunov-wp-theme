<?php

use Carbon_Fields\Container;
use Carbon_Fields\Field;

// Массив Адвокатов
$person_arr = [];

$posts = get_posts(
    [
        'numberposts' => -1,
        'post_type'   => 'advocats',
        'post_status' => 'publish'
    ]
);

foreach ($posts as $post) {
    $person_arr[$post->ID] = $post->post_title;
}

wp_reset_postdata();

// Массив услуг
$services_arr = [];

$posts = get_posts(
    [
        'numberposts' => -1,
        'post_type'   => 'services',
        'post_status' => 'publish'
    ]
);

foreach ($posts as $post) {
    $services_arr[$post->ID] = $post->post_title;
}

wp_reset_postdata();

Container::make(
    'post_meta',
    'Additional fields'
)->show_on_post_type(
    'post'
)->add_fields(
    [
        Field::make('multiselect', 'persons', 'Персоны')
            ->set_options($person_arr)
            ->set_help_text('Выберите одного или несколько адвокатов, упомянутых в новости'),
        Field::make('multiselect', 'services', 'Услуги')
            ->set_options($services_arr)
            ->set_help_text('Выберите одну или несколько услуг, упомянутых в новости')
    ]
);

Container::make(
    'post_meta',
    'Post visibility'
)->show_on_post_type(
    'post'
)->set_context(
    'side'
)->add_fields(
    [
        Field::make(
            'select',
            'show_on_the_main',
            'Статус новости на главной'
        )->add_options(
            [
                'show' => 'Показывать',
                'hide' => 'Не показывать',
            ]
        ),
    ]
);
