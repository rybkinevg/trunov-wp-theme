<?php

$args = [
    'taxonomy'      => ['topics'],
    'include'       => [511, 512]
];

$terms = get_terms($args);

?>

<section class="sidebar__section topics">
    <h2 class="h4 visually-hidden">Темы</h2>

    <?php

    foreach ($terms as $term) {

    ?>

        <div class="card">
            <div class="row g-0">
                <div class="col-md-4">
                    <div class="sidebar__thumb">
                        <picture>
                            <source srcset="<?= get_template_directory_uri() . '/assets/img/blank.gif' ?>" media="(max-width: 992px)">
                            <img class="img img--cover" src="<?= wp_get_attachment_url(get_term_meta($term->term_id, '_thumbnail_id')[0]); ?>" alt="">
                        </picture>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="sidebar__text card-body">
                        <h5 class="card-title h6 m-0">
                            <a href="<?= '/' . $term->taxonomy . '/' . $term->slug ?>"><?= $term->name ?></a>
                        </h5>
                    </div>
                </div>
            </div>
        </div>

    <?php

    }

    ?>

</section>

<?php

unset($args);

$args = [
    'post_type'      => 'post',
    'posts_per_page' => 5,
    'post_status'    => 'publish',
    'category_name'  => 'news'
];

$query = new WP_Query($args);

?>

<section class="sidebar__section topics">
    <h2 class="h4">Новости</h2>

    <?php

    if ($query->have_posts()) {

        while ($query->have_posts()) {

            $query->the_post();

    ?>

            <div class="card">
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
                                    <?= kama_excerpt(['maxchar' => 60, 'text' => get_the_title()]) ?>
                                </a>
                            </h5>
                        </div>
                    </div>
                </div>
            </div>

    <?php

        }
    }

    wp_reset_postdata();

    ?>

</section>

<?php

unset($args);

$args = [
    'post_type'      => 'post',
    'posts_per_page' => 5,
    'post_status'    => 'publish',
    'category_name'  => 'news_smi'
];

$query = new WP_Query($args);

?>

<section class="sidebar__section topics">
    <h2 class="h4">Новости СМИ</h2>

    <?php

    if ($query->have_posts()) {

        while ($query->have_posts()) {

            $query->the_post();

    ?>

            <div class="card">
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
                                    <?= kama_excerpt(['maxchar' => 60, 'text' => get_the_title()]) ?>
                                </a>
                            </h5>
                        </div>
                    </div>
                </div>
            </div>

    <?php

        }
    }

    wp_reset_postdata();

    ?>

</section>

<?php

unset($args);

$args = [
    'post_type'      => 'post',
    'posts_per_page' => 5,
    'post_status'    => 'publish',
    'tag'            => sanitize_title('Анонс')
];

$query = new WP_Query($args);

?>

<section class="sidebar__section topics">
    <h2 class="h4">Анонсы</h2>

    <?php

    if ($query->have_posts()) {

        while ($query->have_posts()) {

            $query->the_post();

    ?>

            <div class="card">
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
                                    <?= kama_excerpt(['maxchar' => 60, 'text' => get_the_title()]) ?>
                                </a>
                            </h5>
                        </div>
                    </div>
                </div>
            </div>

    <?php

        }
    }

    wp_reset_postdata();

    ?>

</section>

<section class="sidebar__section topics">
    <h3 class="widget-title">Актуальные научные публикации</h3>
    <ul class="list-group list-group-flush">
        <li class="list-group-item">
            <a href="/press-centr/news/neprodumannoe_zakonodatelstvo_delaet_advokatov_posobnikami_prestupnikov_chto_osobenno_opasno_po_delam_o_korrupcii_i_terrorizme_/">Непродуманное законодательство делает адвокатов пособниками преступников, что особенно опасно по делам о коррупции и терроризме</a>
        </li>
        <li class="list-group-item">
            <a href="/press-centr/news/falshivye_generaly_podmoskovnoj_advokatury_/">Фальшивые генералы подмосковной адвокатуры</a>
        </li>
        <li class="list-group-item">
            <a href="/doc/kmt.pdf">Казус Майка Тайсона. Подлежат ли уголовной ответственности современные гладиаторы наносящие вред жизни и здоровью</a>
        </li>
        <li class="list-group-item">
            <a href="/nauchnye_i_uchebno_metodicheskie_trudy/nauchnye_publikacii_advokatov_kollegii/16079/">Убийства адвокатов России</a>
        </li>

        <li class="list-group-item">
            <a href="/nauchnye_i_uchebno_metodicheskie_trudy/nauchnye_publikacii_advokatov_kollegii/16081/">НЕОБХОДИМОСТЬ РЕФОРМЫ АДВОКАТУРЫ РОССИИ</a>
        </li>
        <li class="list-group-item">
            <a href="/nauchnye_i_uchebno_metodicheskie_trudy/nauchnye_publikacii_advokatov_kollegii/16092/">Демократическая терпимость чиновников и политиков к шокирующей и оскорбляющей диффамации</a>
        </li>
        <li class="list-group-item">
            <a href="/nauchnye_i_uchebno_metodicheskie_trudy/nauchnye_publikacii_advokatov_kollegii/16090/">Либерализация уголовной политики составная эффективной экономики</a>
        </li>
        <li class="list-group-item">
            <a href="/nauchnye_i_uchebno_metodicheskie_trudy/nauchnye_publikacii_advokatov_kollegii/16082/">Лечить нельзя помиловать</a>
        </li>
    </ul>

</section>

<section class="sidebar__section topics">
    <h2 class="h4">Книги</h2>

    <a href="/books" class="books__img" style="display: block; width: 100%; height: 220px;">
        <img class="img img--cover" src="<?= get_template_directory_uri() . '/assets/img/books.jpg' ?>" alt="">
    </a>

</section>