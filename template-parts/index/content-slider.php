<?php

$args = [
    'post_type'      => 'post',
    'posts_per_page' => 14,
    'tag'            => sanitize_title('Важное')
];

$query = new WP_Query($args);

?>

<section class="section slider">

    <h2 class="section__title visually-hidden">Новости на главной</h2>

    <div class="index-news">

        <div class="index-news__item">
            <div class="d-block w-100 h-100">
                <img src="<?= get_template_directory_uri() . '/assets/img/gonorar.jpg' ?>" alt="" class="img--cover">
            </div>
            <div class="index-news__caption">
                <h5><a href="#">Гонорар успеха</a></h5>
                <p class="d-none d-md-block">
                    Нанимайте наших лучших адвокатов и юристов за ГОНОРАР УСПЕХА
                </p>
            </div>
        </div>

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