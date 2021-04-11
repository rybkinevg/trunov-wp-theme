<?php

$args = [
    'post_type'      => 'advocats',
    'posts_per_page' => -1,
    'post_status'    => 'publish',
    'meta_query'     => [
        'offices'      => [
            'key'     => 'office',
            'value'   => get_the_ID(),
            'compare' => '='
        ],
    ],
];

$query = new WP_Query($args);

?>

<article class="single__item">

    <h2 class="single__title mb-4"><?= get_the_title(); ?></h2>

    <div class="single__content">
        <?php the_content(); ?>
    </div>

</article>

<section class="section lawyers mb-4">

    <h2 class="mb-4 text-start">Адвокаты в представительстве</h2>

    <div class="row">

        <?php

        if ($query->have_posts()) {

            while ($query->have_posts()) {

                $query->the_post();

        ?>

                <div class="col-lg-3 col-md-4 col-sm-6 col-6">
                    <div class="card-holder">
                        <div class="card">
                            <div class="lawyers__img">
                                <?= trunov_get_thumbnail(); ?>
                            </div>
                            <div class="card-body">
                                <p class="card-text text-center">
                                    <a href="<?= get_the_permalink(); ?>">
                                        <?= get_the_title(); ?>
                                    </a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

        <?php

            }
        }

        wp_reset_postdata();

        ?>

    </div>

</section>