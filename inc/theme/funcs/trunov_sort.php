<?php

add_action('pre_get_posts', 'sort_query');

function sort_query($query)
{
    if (is_admin())
        return;

    if ($query->is_main_query() && $query->is_archive()) {

        if (
            'post' == get_post_type()
            ||
            'advocats' == get_post_type()
            ||
            'juristy' == get_post_type()
        ) {

            $query->set('meta_key', '_sort');

            $orderby = [
                'meta_value' => 'ASC',
                'date'       => 'DESC'
            ];

            $query->set('orderby', $orderby);
        }
    }
}
