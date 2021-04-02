<?php

// Скрытие заголовка пагинации
add_filter('navigation_markup_template', 'trunov_pagiantion_template', 10, 2);

function trunov_pagiantion_template($template, $class)
{
    return '
    <nav class="navigation %1$s" role="navigation">
        <h2 class="screen-reader-text visually-hidden">%2$s</h2>
        <div class="nav-links">%3$s</div>
    </nav>
    ';
}

// Генерация разметки пагинации
function trunov_pagiantion_data($links, $args)
{
    $navigation = '';

    if ($links) {

        $pagination = '<ul class="pagination flex-wrap justify-content-center">';

        foreach ($links as $link) {

            $active   = strpos($link, 'current');

            $disabled = strpos($link, 'dots');

            $link     = str_replace('page-numbers', 'page-link', $link);

            if ($active) {

                $pagination .= "<li class=\"page-item active\">$link</li>";
            } elseif ($disabled) {

                $pagination .= "<li class=\"page-item disabled\">$link</li>";
            } else {

                $pagination .= "<li class=\"page-item\">$link</li>";
            }
        }

        $pagination .= '</ul>';

        $navigation  = _navigation_markup($pagination, 'pagination-nav', $args['screen_reader_text']);
    }

    return $navigation;
}

// Функция вывода пагинации
function trunov_pagiantion($show = true)
{
    global $wp_query;

    $navigation = '';

    $big        = 999999999; // need an unlikely integer

    $args = array(
        'base'               => str_replace($big, '%#%', wp_specialchars_decode(esc_url(get_pagenum_link($big)))),
        'format'             => '?paged=%#%',
        'current'            => max(1, get_query_var('paged')),
        'total'              => $wp_query->max_num_pages,
        'screen_reader_text' => 'Навигация по записям',
        'end_size'           => 1,
        'mid_size'           => 2,
        'prev_text'          => '&laquo;',
        'next_text'          => '&raquo;',
        'type'               => 'array',
    );

    // Set up paginated links.
    $links      = paginate_links($args);

    $navigation = trunov_pagiantion_data($links, $args);

    if (!$show)
        return $navigation;

    echo $navigation;
}
