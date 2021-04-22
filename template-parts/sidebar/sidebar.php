<?php

$sidebar_topics = carbon_get_theme_option('sidebar-topics');
// $sidebar_publications = carbon_get_theme_option('sidebar-publications');

if ($sidebar_topics) {

    foreach ($sidebar_topics as $topic) {

        $include[] = $topic['id'];
    }

    $args = [
        'taxonomy'      => ['topics', 'gromkie_dela'],
        'include'       => $include
    ];

    $terms = get_terms($args);
} else {

    $terms = '';
}

if ($terms) {

?>

    <section class="sidebar__section topics">
        <h2 class="h4 visually-hidden">Темы</h2>

        <?php

        foreach ($terms as $term) {

        ?>

            <div class="card-holder">
                <article class="card">
                    <div class="row g-0">
                        <div class="col-md-5">
                            <div class="sidebar__thumb">
                                <picture>
                                    <source srcset="<?= get_template_directory_uri() . '/assets/img/blank.gif' ?>" media="(max-width: 992px)">
                                    <?php

                                    if ($thumb_id = get_term_meta($term->term_id, '_thumbnail_id', true)) {

                                        $src = wp_get_attachment_image_url($thumb_id, 'full');
                                        $class = 'img--cover';
                                        $alt = 'Миниатюра записи';

                                        echo "<img class='img {$class}' src='{$src}' alt='{$alt}'>";
                                    }

                                    ?>
                                </picture>
                            </div>
                        </div>
                        <div class="col-md-7">
                            <div class="sidebar__text card-body">
                                <h5 class="card-title h6 m-0">
                                    <a href="<?= wp_make_link_relative(get_term_link($term->term_id)); ?>"><?= $term->name ?></a>
                                </h5>
                            </div>
                        </div>
                    </div>
                </article>
            </div>

        <?php

        }

        ?>

    </section>

    <?php

}

$sidebar_news = [
    'Новости'     => [
        'category_name' => 'news'
    ],
    'Анонсы' => [
        'category_name' => 'anons'
    ],
    'Новости СМИ' => [
        'category_name' => 'news_smi'
    ]
];

foreach ($sidebar_news as $label => $news) {

    foreach ($news  as $key => $value) {

        $args = [
            'post_type'      => 'post',
            'posts_per_page' => 10,
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

        $args[$key] = $value;

        $cat = get_category_by_slug($value);

        $cat_id = $cat->term_id;

        $cat_link = get_category_link($cat_id);

        $query = new WP_Query($args);

    ?>

        <section class="sidebar__section news">
            <h2 class="h4"><?= $label; ?></h2>

            <?php

            if ($query->have_posts()) {

                while ($query->have_posts()) {

                    $query->the_post();

            ?>

                    <div class="card-holder">
                        <article class="card">
                            <div class="row g-0">
                                <div class="col-md-5">
                                    <div class="sidebar__thumb">
                                        <picture>
                                            <source srcset="<?= get_template_directory_uri() . '/assets/img/blank.gif' ?>" media="(max-width: 992px)">
                                            <?= trunov_get_thumbnail(); ?>
                                        </picture>
                                    </div>
                                </div>
                                <div class="col-md-7">
                                    <div class="card-body">
                                        <span class="text-muted sidebar__date"><?= get_the_date(); ?></span>
                                        <h5 class="card-title h6 m-0">
                                            <a href="<?= get_the_permalink(); ?>">
                                                <?= kama_excerpt(['maxchar' => 60, 'text' => get_the_title(), 'autop' => false]) ?>
                                            </a>
                                        </h5>
                                    </div>
                                </div>
                            </div>
                        </article>
                    </div>

            <?php

                }
            }

            wp_reset_postdata();

            ?>

            <a class="link-primary text-decoration-underline" href="<?= $cat_link; ?>">Все <?= $label; ?></a>

        </section>

    <?php
    }
}

$args = [
    'taxonomy'      => ['topics'],
    'include'       => '516'
];

$terms = get_terms($args);

if ($terms) {

    ?>

    <section class="sidebar__section topics mt-5">
        <h2 class="h4 visually-hidden">Темы</h2>

        <?php

        foreach ($terms as $term) {

        ?>

            <div class="card-holder">
                <article class="card">
                    <div class="row g-0">
                        <div class="col-md-5">
                            <div class="sidebar__thumb">
                                <picture>
                                    <source srcset="<?= get_template_directory_uri() . '/assets/img/blank.gif' ?>" media="(max-width: 992px)">
                                    <?php

                                    if ($thumb_id = get_term_meta($term->term_id, '_thumbnail_id', true)) {

                                        $src = wp_get_attachment_image_url($thumb_id, 'full');
                                        $class = 'img--cover';
                                        $alt = 'Миниатюра записи';

                                        echo "<img class='img {$class}' src='{$src}' alt='{$alt}'>";
                                    }

                                    ?>
                                </picture>
                            </div>
                        </div>
                        <div class="col-md-7">
                            <div class="sidebar__text card-body">
                                <h5 class="card-title h6 m-0">
                                    <a href="<?= wp_make_link_relative(get_term_link($term->term_id)); ?>"><?= $term->name ?></a>
                                </h5>
                            </div>
                        </div>
                    </div>
                </article>
            </div>

        <?php

        }

        ?>

    </section>

<?php

}

$added_publications = carbon_get_theme_option('index-publications') ?: null;

if ($added_publications) {

?>

    <section class="sidebar__section topics">
        <h3 class="widget-title">Актуальные научные публикации</h3>
        <ul class="list-group list-group-flush">

            <?php

            foreach ($added_publications as $publication) {

            ?>

                <li class="list-group-item">
                    <a href="<?= $publication['index-publications-link'] ?>"><?= $publication['index-publications-title'] ?></a>
                </li>

            <?php

            }

            ?>

        </ul>
    </section>

<?php

}

?>

<section class="sidebar__section topics">
    <h2 class="h4">Книги</h2>

    <a href="/books" class="books__img" style="display: block; width: 100%; height: 220px;">
        <img class="img img--cover" src="<?= get_template_directory_uri() . '/assets/img/books.jpg' ?>" alt="">
    </a>

</section>

<?php

$args = [
    'post_type'      => 'partners',
    'posts_per_page' => -1,
    'post_status'    => 'public'
];

$query = new WP_Query($args);

?>

<section class="sidebar__section">

    <h2 class="h4">Партнёры</h2>

    <div class="partners border p-3">

        <div class="row justify-content-center">

            <?php

            if ($query->have_posts()) {

                while ($query->have_posts()) {

                    $query->the_post();

            ?>

                    <div class="col col-3">
                        <div class="parners__item">
                            <div class="d-block w-100 p-2 h-100">
                                <a href="<?= carbon_get_post_meta(get_the_ID(), 'partners_url') ?>" target="_blank" rel="noopener noreferrer" title="<?= get_the_title(); ?>">
                                    <img class='img img--contain' src='<?= get_the_post_thumbnail_url(); ?>' alt='<?= get_the_title(); ?>'>
                                </a>
                            </div>
                        </div>
                    </div>

            <?php

                }
            }

            wp_reset_postdata();

            ?>

        </div>

    </div>

</section>