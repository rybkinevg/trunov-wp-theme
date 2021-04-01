<?php

add_filter('manage_' . 'post' . '_posts_columns', 'add_post_columns');

function add_post_columns($columns)
{
    $columns = [
        'cb'         => '<input type="checkbox" />',
        'title'      => 'Заголовок',
        'categories' => 'Рубрики',
        'tags'       => 'Метки',
        'persons'    => 'Персоны',
        'views'      => 'Просмотры'
    ];

    return $columns;
}

add_action('manage_' . 'post' . '_posts_custom_column', 'fill_post_columns');

function fill_post_columns($column_name)
{
    if ($column_name === 'persons') {

        $meta = carbon_get_post_meta(get_the_ID(), 'persons') ?: null;

        if (!is_null($meta)) {

            if (is_array($meta)) {

                foreach ($meta as $id) {

                    $person = get_post($id);

                    echo "<a href='{$person->guid}' style='display: block;'>{$person->post_title}</a>";
                }
            } else {

                $person = get_post($meta);

                echo "<a href='{$person->guid}' style='display: block;'>{$person->post_title}</a>";
            }
        } else {

            echo "—";
        }
    }

    if ($column_name === 'views') {

        $views = get_post_meta(get_the_ID(), 'views', true) ?: 0;

        echo $views;
    }
};
