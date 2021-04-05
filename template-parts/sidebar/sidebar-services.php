<?php

global $post;

$args = [
    'posts_per_page' => -1,
    'post_type'      => get_post_type(),
    'post_status'    => 'public'
];

if (is_post_type_archive(get_post_type())) {

    $args['post_parent'] = 0;
    $title = 'Услуги';
} elseif (is_singular(get_post_type())) {

    $args['post_parent']  = $post->ID;

    $check = new WP_Query($args);

    if ($check->found_posts == 0) {

        $args['post__not_in'] = [$post->ID];
        $args['post_parent']  = $post->post_parent;
        $title = get_post($post->post_parent)->post_title;
    } else {

        $title = $post->post_title;
    }
}

$query = new WP_Query($args);

?>

<section class="sidebar__section topics">
    <h2 class="h4"><?= $title; ?></h2>
    <ul class="list-group list-group-flush">

        <?php

        if ($query->have_posts()) {

            while ($query->have_posts()) {

                $query->the_post();

        ?>

                <li class="list-group-item">
                    <a href="<?= get_the_permalink(); ?>">
                        <?= get_the_title(); ?>
                    </a>
                </li>

        <?php
            }
        }

        wp_reset_postdata();

        ?>

    </ul>
</section>