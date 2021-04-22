<?php

$args = [
    'post_type'      => 'advocats',
    'posts_per_page' => -1,
    'post_status'    => 'publish',
    'meta_query'     => [
        'head'     => [
            'key'     => 'status',
            'value'   => 'head',
            'compare' => '='
        ]
    ],
    'orderby' => [
        'name'    => 'DESC'
    ]
];

$query = new WP_Query($args);

?>

<section class="section management">

    <h2 class="section__title visually-hidden">Руководство</h2>

    <div class="row">

        <?php

        if ($query->have_posts()) {

            while ($query->have_posts()) {

                $query->the_post();

        ?>

                <div class="col-md-12 col-lg-6">

                    <div class="card-holder">
                        <div class="card">
                            <div class="management__img">
                                <a href="<?= get_the_permalink(); ?>" class="d-block h-100">
                                    <?= trunov_get_thumbnail(); ?>
                                </a>
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">
                                    <a href="<?= get_the_permalink(); ?>"><?= get_the_title(); ?></a>
                                </h5>
                                <p class="card-text"><?= carbon_get_post_meta(get_the_ID(), 'position') ?></p>
                            </div>

                            <?php

                            $extra = carbon_get_post_meta(get_the_ID(), 'extra');

                            if ($extra) {

                                $data = [
                                    'publications' => [
                                        'title' => 'Научные статьи',
                                        'icon'  => 'pencil-square-o'
                                    ],
                                    'tv' => [
                                        'title' => 'Телевидение',
                                        'icon'  => 'television'
                                    ],
                                    'actual' => [
                                        'title' => 'Актуальные дела',
                                        'icon'  => 'university '
                                    ]
                                ];

                            ?>

                                <ul class="list-group list-group-flush">

                                    <?php

                                    foreach ($extra as $item) {

                                    ?>

                                        <li class="list-group-item">
                                            <a href="<?= $item['link'] ?>">
                                                <i class="<?= "fa fa-{$data[$item['title']]['icon']} me-2" ?>" aria-hidden="true"></i>
                                                <?= $data[$item['title']]['title'] ?>
                                            </a>
                                        </li>

                                    <?php

                                    }

                                    ?>

                                </ul>

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

</section>