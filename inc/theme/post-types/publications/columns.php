<?php

// Колонка с ссылкой
add_filter('manage_' . 'publications' . '_posts_columns', 'add_publications_columns');

function add_publications_columns($columns)
{
    $new_columns = [
        'publications-url' => 'Ссылка'
    ];

    unset($columns['date']);

    return array_slice($columns, 0, 1) + $columns + $new_columns;
}

add_action('manage_' . 'publications' . '_posts_custom_column', 'fill_publications_columns');

function fill_publications_columns($column_name)
{
    if ($column_name === 'publication-url') {

        $link = carbon_get_post_meta(get_the_ID(), 'publication-url');

        echo ($link) ? $link : '-';
    }
};
