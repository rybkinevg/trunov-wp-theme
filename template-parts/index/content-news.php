<?php

$args = [
    'post_type'      => 'post',
    'posts_per_page' => 3,
    'post_status'    => 'publish',
    'meta_key'       => '_sort',
    'orderby'        => [
        'meta_value_num' => 'ASC',
        'date'           => 'DESC'
    ],
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

    <h2 class="section__title">Новости</h2>

    <div class="index-news">

        <ul class="list-group">

            <?php

            if ($query->have_posts()) {

                while ($query->have_posts()) {

                    $query->the_post();

            ?>

                    <li class="list-group-item p-3">
                        <span class="text-muted sidebar__date"><?= get_the_date(); ?></span>
                        <h5>
                            <a href="<?= get_the_permalink(); ?>">
                                <?= kama_excerpt(['maxchar' => 60, 'text' => get_the_title(), 'autop' => false]) ?>
                            </a>
                        </h5>
                        <p class="m-0"><?= kama_excerpt(['maxchar' => 100, 'autop' => false]) ?></p>
                    </li>

            <?php

                }
            }

            wp_reset_postdata();

            ?>

        </ul>

    </div>

</section>