<?php

function trunov_get_thumbnail($size = 'full', $type = 'post')
{
    $alt = 'Миниатюра записи';

    if (has_post_thumbnail(get_the_ID()) && $type == 'post') {

        $src = get_the_post_thumbnail_url(get_the_ID(), $size);
        $class = 'img--cover';
    } else {

        $src = get_template_directory_uri() . '/assets/img/img-default.png';
        $class = 'img--cover img--default';

        if ($smi = wp_get_post_terms(get_the_ID(), 'smi')) {

            if ($thumb_id = get_term_meta($smi[0]->term_id, '_thumbnail_id', true)) {

                $src = wp_get_attachment_image_url($thumb_id, $size);
                $class = 'img--contain';
            }
        } else if ($topics = wp_get_post_terms(get_the_ID(), 'topics')) {

            if ($thumb_id = get_term_meta($topics[0]->term_id, '_thumbnail_id', true)) {

                $src = wp_get_attachment_image_url($thumb_id, $size);
                $class = 'img--contain';
            }
        } else if ($dela = wp_get_post_terms(get_the_ID(), 'gromkie_dela')) {

            if ($thumb_id = get_term_meta($dela[0]->term_id, '_thumbnail_id', true)) {

                $src = wp_get_attachment_image_url($thumb_id, $size);
                $class = 'img--contain';
            }
        }
    }

    $thumbnail = "<img class='img {$class}' src='{$src}' alt='{$alt}'>";

    return $thumbnail;
}
