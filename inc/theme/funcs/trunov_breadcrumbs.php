<?php

function trunov_breadcrumbs()
{
    $l10n = [
        'attachment' => '',
        'tag'        => '',
        'tax_tag'    => '',
    ];

    $args = [
        'on_front_page'   => false,
        'show_post_title' => false,
        'show_term_title' => false,
        'markup' => [
            'wrappatt'  => '<ol class="breadcrumb m-0">%s</ol>',
            'linkpatt'  => '<li class="breadcrumb-item"><a href="%s">%s</a></li>',
            'sep_after' => '',
        ],
    ];

    kama_breadcrumbs('', $l10n, $args);
}
