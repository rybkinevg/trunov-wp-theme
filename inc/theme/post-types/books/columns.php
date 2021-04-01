<?php

add_filter('manage_' . 'books' . '_posts_columns', 'add_books_columns');

function add_books_columns($columns)
{
    $new_columns = [
        'thumb' => 'Обложка'
    ];

    return array_slice($columns, 0, 1) + $new_columns + $columns;
}

add_action('manage_' . 'books' . '_posts_custom_column', 'fill_books_columns');

function fill_books_columns($column_name)
{
    if ($column_name === 'thumb') {

        if (has_post_thumbnail()) {

            $thumbnail = get_the_post_thumbnail(get_the_ID(), 'thumbnail');
        } else {

            $thumbnail = '—';
        }

        echo $thumbnail;
    }
};
