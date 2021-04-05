<?php

function trunov_get_thumbnail()
{
    $alt = 'Миниатюра записи';
    $src = get_template_directory_uri() . '/assets/img/img-default.png';
    $class = 'img--cover img--default';

    $thumbnail = "<img class='img {$class}' src='{$src}' alt='{$alt}'>";

    if (has_post_thumbnail()) {

        $src = get_the_post_thumbnail_url();
        $class = 'img--cover';

        return $thumbnail;
    }

    if ($smi = wp_get_post_terms(get_the_ID(), 'smi')) {

        if ($thumb_id = get_term_meta($smi[0]->term_id, '_thumbnail_id', true)) {

            $src = wp_get_attachment_image_url($thumb_id);
            $class = 'img--contain';
        }
    }

    return $thumbnail;
}
