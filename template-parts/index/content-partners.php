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

                <div class="parners__item" style="height: 100px; background: #fff;">
                    <div class="d-block w-100" style="height: 100%;">
                        <?= trunov_get_thumbnail(); ?>
                        <img class="img img--cover" src="http://trunov.loc/wp-content/uploads/2015/08/d_15963.gif" alt="Миниатюра записи">
                    </div>
                </div>

        <?php

            }
        }

        wp_reset_postdata();

        ?>

    </div>

</section>