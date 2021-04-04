<?php

use Carbon_Fields\Container;
use Carbon_Fields\Field;

// Массив Представительств
$offices_arr = [
    '0' => 'Не выбрано'
];

$posts = get_posts(
    [
        'numberposts' => -1,
        'post_type'   => 'offices',
        'post_status' => 'publish'
    ]
);

foreach ($posts as $post) {
    $offices_arr[$post->ID] = $post->post_title;
}

wp_reset_postdata();

Container::make('post_meta', 'Дополнительные поля')
    ->show_on_post_type('advocats')
    ->add_fields(
        [
            Field::make('select', 'office', 'Представительство')
                ->add_options($offices_arr)
                ->set_default_value(0)
                ->set_help_text('Выберите представительство'),
        ]
    );

Container::make('post_meta', 'Информация о статусе')
    ->show_on_post_type('advocats')
    ->add_fields(
        [
            Field::make('select', 'status', 'Статус адвоката')
                ->add_options(
                    [
                        'staff' => 'Член коллегии',
                        'head'  => 'Глава коллегии'
                    ]
                )
                ->set_default_value('staff')
                ->set_help_text('Выберите статус адвоката, если выбран статус "Глава коллегии", то откроется доступ к заполнению следующих полей'),
            Field::make('text', 'position', 'Должность')
                ->set_conditional_logic(
                    [
                        [
                            'field' => 'status',
                            'value' => 'head',
                        ]
                    ]
                ),
            Field::make('textarea', 'speech', 'Цитата, речь или приветсвенное слово')
                ->set_conditional_logic(
                    [
                        [
                            'field' => 'status',
                            'value' => 'head',
                        ]
                    ]
                ),
            Field::make('complex', 'extra', 'Дополнительные ссылки, материалы')
                ->add_fields(
                    [
                        Field::make('text', 'title', 'Название'),
                        Field::make('text', 'link', 'Ссылка'),
                    ]
                )
                ->set_conditional_logic(
                    [
                        [
                            'field' => 'status',
                            'value' => 'head',
                        ]
                    ]
                )
        ]
    );
