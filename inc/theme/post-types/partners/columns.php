<?php

/**
 * Добавление новых колонок
 */
add_filter('manage_' . 'partners' . '_posts_columns', 'add_partners_columns');

function add_partners_columns($columns)
{
    $new_columns = [
        'thumb'         => 'Логотип',
        'partners-url'  => 'Ссылка'
    ];

    unset($columns['date']);

    return array_slice($columns, 0, 1) + $columns + $new_columns;
}

/**
 * Заполнение новых колонок
 */
add_action('manage_' . 'partners' . '_posts_custom_column', 'fill_partners_columns');

function fill_partners_columns($column_name)
{
    if ($column_name === 'thumb' && has_post_thumbnail()) {

        $thumbnail = get_the_post_thumbnail(get_the_ID(), 'thumbnail');

        echo $thumbnail;
    }

    if ($column_name === 'partners-url') {

        $link = carbon_get_post_meta(get_the_ID(), 'partners_url');

        echo ($link) ? $link : '-';
    }
};
