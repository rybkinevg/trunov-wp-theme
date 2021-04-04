<?php

$args = [
    'post_type'      => 'offices',
    'posts_per_page' => -1,
    'post_status'    => 'publish',
];

$query = new WP_Query($args);

?>

<section class="section offices">

    <h2 class="section__title h4">Зарубежные представительства</h2>

    <div class="row">

        <?php

        if ($query->have_posts()) {

            while ($query->have_posts()) {

                $query->the_post();

        ?>

                <div class="col-lg-4 col-md-6">
                    <div class="card offices__item">
                        <div class="row g-0">
                            <div class="col-md-5">
                                <div class="offices__img">
                                    <?= trunov_get_thumbnail(); ?>
                                </div>
                            </div>
                            <div class="col-md-7">
                                <div class="card-body offices__text">
                                    <h5 class="card-title text-center m-0">
                                        <a href="<?= get_the_permalink(); ?>"><?= get_the_title(); ?></a>
                                    </h5>
                                </div>
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