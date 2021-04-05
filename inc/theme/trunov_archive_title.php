<?php

function trunov_archive_title($post_type, $tag = 'h2')
{
    $label = get_post_type_object($post_type)->label;

    $title = "<{$tag} class='archive__head'>{$label}</{$tag}>";

    $is_cat = get_query_var('cat', false);

    $is_tag = get_query_var('tag', false);

    $is_tax = get_query_var('tax_query', false);

    $is_term = get_query_var('term', false);

    $subtitle = '';

    if ($is_cat) {

        $subtitle .= get_cat_name($is_cat);
    }

    if ($is_tag) {

        $tag = get_tags(['slug' => $is_tag]);

        $subtitle .= $tag[0]->name;
    }

    if ($is_tax) {

        $tax = get_taxonomy($is_tax[0]['taxonomy']);

        $subtitle .= $tax->label;
    }

    if ($is_term) {

        $term = get_term_by('slug', $is_term, get_query_var('taxonomy'));

        $subtitle .= $term->name;
    }

    if (!empty($subtitle)) {

        $title .= "<p class='text-muted'>{$subtitle}</p>";
    }

    return $title;
}
