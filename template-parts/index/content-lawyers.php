<?php

$post_type = $args['post_type'];
$title = $args['title'];

unset($args);

if ($post_type == 'advocats') {

    $args = [
        'post_type'      => $post_type,
        'posts_per_page' => -1,
        'post_status'    => 'publish',
        'meta_key'       => '_sort',
        'meta_query'     => [
            'relation' => 'AND',
            'head'     => [
                'key'     => 'status',
                'value'   => 'head',
                'compare' => '!='
            ]
        ],
        'orderby' => [
            'meta_value_num' => 'ASC',
        ]
    ];
} else {

    $args = [
        'post_type'      => $post_type,
        'posts_per_page' => -1,
        'post_status'    => 'publish',
        'meta_key'       => '_sort',
        'orderby'        => [
            'meta_value_num' => 'ASC',
            'date'           => 'DESC'
        ]
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
                    <div class="card-holder">
                        <div class="card">
                            <div class="lawyers__img">
                                <?= trunov_get_thumbnail(); ?>
                            </div>
                            <div class="card-body">
                                <p class="card-text text-center">
                                    <a class="stretched-link" href="<?= get_the_permalink(); ?>">
                                        <?= get_the_title(); ?>
                                    </a>
                                </p>
                            </div>
                            <?php

                            if (current_user_can('manage_options')) {

                                $sort = carbon_get_post_meta(get_the_ID(), 'sort');

                            ?>

                                <div class="m-3 position-absolute top-0 end-0">
                                    <span class="badge bg-primary">??? <?= $sort ?></span>
                                </div>

                            <?php

                            }

                            ?>
                        </div>
                    </div>
                </div>

        <?php

            }
        }

        wp_reset_postdata();

        ?>

    </div>

    <?php

    if ($post_type == 'advocats') {

    ?>

        <ul class="list-group list-group">
            <li class="list-group-item" style="max-width: 330px;">
                <a href="/nauchnye_i_uchebno_metodicheskie_trudy/nauchnye_publikacii_advokatov_kollegii/">
                    <i class="fa fa-pencil-square-o me-2" aria-hidden="true"></i>
                    ?????????????? ???????????? ?????????????????? ????????????????
                </a>
            </li>
        </ul>

    <?php

    }

    ?>

</section>