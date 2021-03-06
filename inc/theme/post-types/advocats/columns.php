<?php

add_filter('manage_' . 'advocats' . '_posts_columns', 'add_advocats_columns');

function add_advocats_columns($columns)
{
    $columns = [
        'cb'     => '<input type="checkbox" />',
        'thumb'  => 'Фото',
        'title'  => 'ФИО',
        'office' => 'Представительство'
    ];

    return $columns;
}

add_action('manage_' . 'advocats' . '_posts_custom_column', 'fill_advocats_columns');

function fill_advocats_columns($column_name)
{
    if ($column_name === 'thumb') {

        if (!has_post_thumbnail())
            echo "—";

        $src = get_the_post_thumbnail_url(get_the_ID(), 'thumbnail');

        echo "<img src='{$src}' width='100' height='100' alt=' style='border-radius:4px;'>";
    }

    if ($column_name === 'office') {

        $office_id = carbon_get_post_meta(get_the_ID(), 'office');

        $office = ($office_id != 'null') ? get_post(carbon_get_post_meta(get_the_ID(), 'office'))->post_title : '—';

        echo $office;
    }
};
