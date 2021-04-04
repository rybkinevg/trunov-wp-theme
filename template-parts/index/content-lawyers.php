<?php

$post_type = $args['post_type'];
$title = $args['title'];

unset($args);

if ($post_type == 'advocats') {

    $args = [
        'post_type'      => $post_type,
        'posts_per_page' => -1,
        'post_status'    => 'publish',
        'meta_query'     => [
            'relation' => 'AND',
            'head'     => [
                'key'     => 'status',
                'value'   => 'head',
                'compare' => '!='
            ],
            [
                'relation' => 'OR',
                'rus'      => [
                    'key'     => 'office',
                    'value'   => 0,
                    'compare' => '='
                ],
                'offices'      => [
                    'key'     => 'office',
                    'value'   => 0,
                    'compare' => '!='
                ],
            ]
        ],
        'orderby' => [
            'rus' => 'ASC',
            'offices' => 'ASC',
        ]
    ];
} else {

    $args = [
        'post_type'      => $post_type,
        'posts_per_page' => -1,
        'post_status'    => 'publish',
    ];
}

$query = new WP_Query($args);

?>

<section class="section lawyers">

    <h2 class="section__title h4"><?= $title ?></h2>

    <div class="row">

        <?php

        if ($query->have_posts()) {

            while ($query->have_posts()) {

                $query->the_post();

        ?>

                <div class="col-lg-3 col-md-4 col-sm-6 col-6">
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

        <?php

            }
        }

        wp_reset_postdata();

        ?>

    </div>
</section>