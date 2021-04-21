<?php

get_header();

while (have_posts()) {

    the_post();

    $post_type = get_post_type();

?>

    <main class="main site__item">
        <div class="breadcrums mb-3">
            <?php trunov_breadcrumbs(); ?>
        </div>

        <section class="single single__<?= $post_type; ?>">
            <div class="row">

                <div class="content col-lg-8">

                    <?php

                    get_template_part('template-parts/single/content', $post_type);

                    ?>

                </div>

                <aside class="sidebar col-md-4 d-none d-lg-block">

                    <?php

                    get_template_part('template-parts/sidebar/sidebar', $post_type);

                    ?>

                </aside>

            </div>
        </section>
    </main>

<?php

}

get_footer();
