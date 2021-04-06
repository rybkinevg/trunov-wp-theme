<?php

$sidebar_topics = carbon_get_theme_option('sidebar-topics');
$sidebar_publications = carbon_get_theme_option('sidebar-publications');

if ($sidebar_topics) {

    foreach ($sidebar_topics as $topic) {

        $include[] = $topic['id'];
    }

    $args = [
        'taxonomy'      => ['topics'],
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
                        <div class="col-md-4">
                            <div class="sidebar__thumb">
                                <picture>
                                    <source srcset="<?= get_template_directory_uri() . '/assets/img/blank.gif' ?>" media="(max-width: 992px)">
                                    <?= trunov_get_thumbnail(); ?>
                                </picture>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="sidebar__text card-body">
                                <h5 class="card-title h6 m-0">
                                    <a href="<?= wp_make_link_relative(get_term_link($term->term_id, 'topics')); ?>"><?= $term->name ?></a>
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
    'Новости СМИ' => [
        'category_name' => 'news_smi'
    ],
    'Анонсы'      => [
        'tag' => sanitize_title('Анонс')
    ],
];

foreach ($sidebar_news as $label => $news) {

    foreach ($news  as $key => $value) {

        $args = [
            'post_type'      => 'post',
            'posts_per_page' => 5,
            'post_status'    => 'publish',
            'orderby'        => 'date'
        ];

        $args[$key] = $value;

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
                                <div class="col-md-4">
                                    <div class="sidebar__thumb">
                                        <picture>
                                            <source srcset="<?= get_template_directory_uri() . '/assets/img/blank.gif' ?>" media="(max-width: 992px)">
                                            <?= trunov_get_thumbnail(); ?>
                                        </picture>
                                    </div>
                                </div>
                                <div class="col-md-8">
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

        </section>

    <?php
    }
}

if ($sidebar_publications) {

    foreach ($sidebar_publications as $publication) {

        $include[] = $publication['id'];
    }

    $args = [
        'post_type'      => 'publications',
        'posts_per_page' => 5,
        'post_status'    => 'publish',
        'orderby'        => 'date',
        'post__in'       => $include
    ];

    $query = new WP_Query($args);
} else {

    $args = [
        'post_type'      => 'publications',
        'posts_per_page' => 5,
        'post_status'    => 'publish',
        'orderby'        => 'date',
    ];

    $query = new WP_Query($args);
}

if ($query->have_posts()) {

    ?>

    <section class="sidebar__section topics">
        <h3 class="widget-title">Актуальные научные публикации</h3>
        <ul class="list-group list-group-flush">

            <?php

            while ($query->have_posts()) {

                $query->the_post();

            ?>

                <li class="list-group-item">
                    <a href="<?= get_the_permalink(); ?>"><?= get_the_title(); ?></a>
                </li>

            <?php

            }

            wp_reset_postdata();

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