<?php

function advocats_admin_order($query)
{
    $post_types = get_post_types(['_builtin' => false], 'names');

    $post_type = $query->get('post_type');

    if (in_array($post_type, $post_types) && $post_type == 'advocats') {

        $meta = [
            'relation' => 'OR',
            'head' => [
                'key'     => 'status',
                'compare' => 'EXISTS'
            ],
            'office' => [
                'key'     => 'office',
                'compare' => 'EXISTS'
            ]
        ];

        $order = [
            'head'   => 'ASC'
        ];

        $query->set('meta_query', $meta);
        $query->set('orderby', $order);
    }
}

if (is_admin()) {

    add_action('pre_get_posts', 'advocats_admin_order');
}
