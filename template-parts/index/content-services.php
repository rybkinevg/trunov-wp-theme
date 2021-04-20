<?php

$args = [
    'post_type' => 'services',
    'posts_per_page' => -1,
    'post_parent__in' => [get_page_by_title('Юридический бизнес', 'OBJECT', 'services')->ID]
];

$query = new WP_Query($args);

?>

<section class="section services">

    <h2 class="section__title h4">Юридический бизнес</h2>

    <div class="row">

        <?php

        if ($query->have_posts()) {

            while ($query->have_posts()) {

                $query->the_post();

        ?>

                <div class="col-lg-3 col-md-4 col-sm-6 col-6">
                    <article class="card-holder">
                        <div class="card">
                            <div class="services__img">
                                <?= trunov_get_thumbnail(); ?>
                            </div>
                            <div class="card-body">
                                <h5 class="card-title text-center"><a class="services__link" href="<?= get_the_permalink(); ?>"><?= get_the_title(); ?></a></h5>
                                <div class="d-none d-lg-block card-text services__text"><?= kama_excerpt(['maxchar' => 80, 'autop' => false]) ?></div>
                            </div>
                        </div>
                    </article>
                </div>

        <?php

            }
        }
        wp_reset_postdata();

        ?>

    </div>

</section>