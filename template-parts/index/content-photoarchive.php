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

        ?>

                <div class="col-lg-3 col-md-4 col-sm-6 col-6">
                    <?php var_dump($media); ?>
                </div>

        <?php

            }
        }

        wp_reset_postdata();

        ?>

    </div>

</section>