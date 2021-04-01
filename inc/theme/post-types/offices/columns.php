<?php

add_filter('manage_' . 'offices' . '_posts_columns', 'add_offices_columns');

function add_offices_columns($columns)
{
    $columns = [
        'cb'     => '<input type="checkbox" />',
        'thumb'  => 'Флаг',
        'title'  => 'Название'
    ];

    return $columns;
}

add_action('manage_' . 'offices' . '_posts_custom_column', 'fill_offices_columns');

function fill_offices_columns($column_name)
{
    if ($column_name === 'thumb') {

        if (!has_post_thumbnail())
            echo "—";

        $thumbnail = get_the_post_thumbnail(get_the_ID(), 'thumbnail');

        echo $thumbnail;
    }
};
