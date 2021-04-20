<?php

add_action('pre_get_posts', 'sort_query');

function sort_query($query)
{
    if (is_admin())
        return;

    if ($query->is_main_query() && $query->is_archive()) {

        if (
            'advocats' == get_post_type()
            ||
            'juristy'  == get_post_type()
            ||
            'news'     == $query->get('category_name')
            ||
            'news_smi' == $query->get('category_name')
            ||
            'anons'    == $query->get('category_name')
            ||
            $query->is_tax('smi')
            ||
            $query->is_tax('archive')
            ||
            $query->is_tax('gromkie_dela')
            ||
            $query->is_tax('topics')
            ||
            $query->is_tax('tv')
        ) {

            $query->set('meta_key', '_sort');

            $orderby = [
                'meta_value_num' => 'ASC',
                'date'           => 'DESC'
            ];

            $query->set('orderby', $orderby);
        }
    }
}
