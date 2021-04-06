<?php

$args = [
    'post_type'      => 'post',
    'posts_per_page' => 8,
    'tax_query'      => [
        [
            'taxonomy' => 'archive',
            'field'    => 'slug',
            'terms'    => 'fotoarhiv'
        ]
    ]
];

$query = new WP_Query($args);

?>

<section class="section photoarchive">

    <h2 class="section__title h4">Фотоархив</h2>

    <div class="row">

        <?php

        if ($query->have_posts()) {

            while ($query->have_posts()) {

                $query->the_post();

                $media = get_attached_media('image', get_the_ID());

                unset($media[get_post_thumbnail_id()]);

        ?>

                <div class="col-lg-3 col-md-4 col-sm-6 col-6">

                    <div class="photoarchive__item">
                        <a title="<?= get_the_title(); ?>" data-fancybox-href="<?= get_the_post_thumbnail_url(get_the_id(), 'full') ?>" rel="<?= get_the_ID() ?>" class="fancybox">
                            <?= trunov_get_thumbnail(); ?>
                        </a>
                    </div>

                    <?php

                    foreach ($media as $img) {

                        $src = $img->guid;

                    ?>

                        <div class="photoarchive__item--hidden">
                            <a title="<?= get_the_title(); ?>" data-fancybox-href="<?= $src ?>" rel="<?= get_the_ID() ?>" class="fancybox"></a>
                        </div>

                    <?php

                    }

                    ?>

                </div>

        <?php

            }
        }

        wp_reset_postdata();

        ?>

    </div>

</section>