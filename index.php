<?php

get_header();

?>

Просмотров: <?php echo get_post_meta(3973, 'views', true); ?>

<main class="main site__item">
    <div class="row">
        <div class="content col-lg-8">

            <?php

            get_template_part('template-parts/index/content', 'slider');

            get_template_part('template-parts/index/content', 'management');

            get_template_part('template-parts/index/content', 'offices');

            get_template_part('template-parts/index/content', 'lawyers', ['post_type' => 'advocats', 'title' => 'Адвокаты']);

            get_template_part('template-parts/index/content', 'lawyers', ['post_type' => 'juristy', 'title' => 'Юристы']);

            get_template_part('template-parts/index/content', 'services');

            get_template_part('template-parts/index/content', 'photoarchive');

            get_template_part('template-parts/index/content', 'about');

            ?>

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

?>