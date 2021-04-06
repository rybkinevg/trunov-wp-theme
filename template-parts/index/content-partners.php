<?php

$args = [
    'post_type'      => 'partners',
    'posts_per_page' => -1,
    'post_status'    => 'public'
];

$query = new WP_Query($args);

?>

<section class="section slider">

    <h2 class="section__title visually-hidden">Новости на главной</h2>

    <div class="partners">

        <?php

        if ($query->have_posts()) {

            while ($query->have_posts()) {

                $query->the_post();

        ?>

                <div class="parners__item">
                    <div class="d-block w-100" style="height: 100%;">
                        <a href="<?= carbon_get_post_meta(get_the_ID(), 'partners_url') ?>" target="_blank" rel="noopener noreferrer" title="<?= get_the_title(); ?>">
                            <img class='img img--contain' src='<?= get_the_post_thumbnail_url(); ?>' alt='<?= get_the_title(); ?>'>
                        </a>
                    </div>
                </div>

        <?php

            }
        }

        wp_reset_postdata();

        ?>

    </div>

</section>