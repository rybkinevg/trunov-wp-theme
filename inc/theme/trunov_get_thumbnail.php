<?php

// TODO: сделать проверку на миниатюру у таксы СМИ, и если нет миниатюры выбранной, подхватывать её, но с другим классом (img--contain)
function trunov_get_thumbnail()
{
    $alt = 'Миниатюра записи';

    if (has_post_thumbnail()) {

        $src = get_the_post_thumbnail_url();

        $class = 'img--cover';
    } else if ($smi = wp_get_post_terms(get_the_ID(), 'smi')) {

        if ($thumb_id = get_term_meta($smi[0]->term_id, '_thumbnail_id', true)) {

            $src = wp_get_attachment_image_url($thumb_id);

            $class = 'img--contain';
        }
    } else {

        $src = get_template_directory_uri() . '/assets/img/img-default.png';

        $class = 'img--cover img--default';
    }

    $thumbnail = "<img class='img {$class}' src='{$src}' alt='{$alt}'>";

    return $thumbnail;
}
