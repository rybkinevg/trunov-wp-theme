<?php

function trunov_breadcrumbs()
{
    $args = [
        'on_front_page'   => false,
        'show_post_title' => false,
        'show_term_title' => false,
        'markup' => [
            'wrappatt'  => '<ol class="breadcrumb">%s</ol>',
            'linkpatt'  => '<li class="breadcrumb-item"><a href="%s">%s</a></li>',
            'sep_after' => '',
        ],
    ];

    kama_breadcrumbs('', [], $args);
}
