<?php

add_filter('pre_get_posts', 'change_advocats_order');

function change_advocats_order($query)
{
    if (is_post_type_archive('advocats') && $query->is_main_query()) {

        $query->set(
            'meta_query',
            [
                'relation' => 'OR',
                'management' => [
                    'key'   => 'status',
                    'value' => 'head',
                    'compare' => '='
                ],
                'staff' => [
                    'key'   => 'status',
                    'value' => 'head',
                    'compare' => '!='
                ],
            ]
        );

        $query->set(
            'orderby',
            [
                'management' => 'ASC',
                'date'       => 'ASC',
            ]
        );
    }

    return $query;
}
