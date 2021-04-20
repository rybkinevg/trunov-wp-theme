<?php

$args = [
    'post_type'      => 'post',
    'posts_per_page' => 14,
    'tag'            => sanitize_title('Важное'),
    'meta_query'     => [
        'relation' => 'OR',
        [
            'key'     => '_show_on_the_main',
            'value'   => 'show',
            'compare' => '=',
        ]
    ]
];

$query = new WP_Query($args);

?>

<section class="section slider">

    <h2 class="section__title visually-hidden">Новости на главной</h2>

    <div class="index-news">

        <?php

        if ($query->have_posts()) {

            while ($query->have_posts()) {

                $query->the_post();

        ?>

                <div class="index-news__item">
                    <div class="d-block w-100 h-100">
                        <?= trunov_get_thumbnail(); ?>
                    </div>
                    <div class="index-news__caption">
                        <h5><a href="<?= get_the_permalink(); ?>"><?= get_the_title(); ?></a></h5>
                        <p class="d-none d-md-block"><?= kama_excerpt(['maxchar' => 100, 'autop' => false]) ?></p>
                    </div>
                </div>

        <?php

            }
        }

        wp_reset_postdata();

        ?>

    </div>

</section>