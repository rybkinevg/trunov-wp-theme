<?php

get_header();

global $wp_query;

$search_query = get_search_query();

$results = $wp_query->found_posts;

?>

<main class="main site__item">
    <div class="breadcrums">
        <?php trunov_breadcrumbs(); ?>
    </div>
    <div class="row">
        <div class="content col-lg-8">

            <section class="section search">
                <h2 class="archive__head">Поиск</h2>
                <div class="mb-3">
                    <?= get_search_form(); ?>
                </div>

                <?php

                if (have_posts() && !empty($search_query)) {

                ?>

                    <p class="text-muted">Поисковой запрос: "<?= $search_query; ?>"</p>
                    <p>Найдено: <?= $results ?></p>
                    <ul class="archive__list">

                        <?php

                        while (have_posts()) {

                            the_post();

                            $label = get_post_type_object(get_post_type())->label;

                        ?>

                            <li class="archive__list-item">
                                <div class="card-holder">
                                    <article class="card">
                                        <div class="row g-0">
                                            <div class="col-md-4">
                                                <a href="<?= get_the_permalink(); ?>" class="archive__img">
                                                    <?= trunov_get_thumbnail(); ?>
                                                </a>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="card-body">
                                                    <span class="badge bg-secondary mb-3"><?= $label; ?></span>
                                                    <p class="card-text"><small class="text-muted"><?= get_the_date('j F Y'); ?></small></p>
                                                    <h5 class="card-title">
                                                        <a href="<?= get_the_permalink(); ?>">
                                                            <?= get_the_title(); ?>
                                                        </a>
                                                    </h5>
                                                    <p class="card-text"><?= kama_excerpt(['maxchar' => 200, 'autop' => false]); ?></p>
                                                </div>
                                            </div>
                                        </div>
                                    </article>
                                </div>
                            </li>

                        <?php

                        }

                        ?>

                    </ul>

                <?php

                    trunov_pagiantion();
                } else {

                ?>

                    <p>К сожалению, по вашему запросу ничего не найдено</p>

                <?php

                }

                ?>

            </section>

        </div>

        <aside class="sidebar col-md-4 d-none d-lg-block">

            <?php

            get_template_part('template-parts/sidebar/sidebar');

            ?>

        </aside>

    </div>
</main>

<?php

get_footer();
