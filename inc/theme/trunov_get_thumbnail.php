<?php

function trunov_get_thumbnail($type = 'post')
{
    $alt = 'Миниатюра записи';

    if (has_post_thumbnail() && $type == 'post') {

        $src = get_the_post_thumbnail_url();
        $class = 'img--cover';
    } else {

        $src = get_template_directory_uri() . '/assets/img/img-default.png';
        $class = 'img--cover img--default';

        if ($smi = wp_get_post_terms(get_the_ID(), 'smi')) {

            if ($thumb_id = get_term_meta($smi[0]->term_id, '_thumbnail_id', true)) {

                $src = wp_get_attachment_image_url($thumb_id);
                $class = 'img--contain';
            }
        }

        if ($topics = wp_get_post_terms(get_the_ID(), 'topics')) {

            if ($thumb_id = get_term_meta($topics[0]->term_id, '_thumbnail_id', true)) {

                $src = wp_get_attachment_image_url($thumb_id);
                $class = 'img--contain';
            }
        }
    }

    $thumbnail = "<img class='img {$class}' src='{$src}' alt='{$alt}'>";

    return $thumbnail;
}
