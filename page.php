<?php

get_header();

while (have_posts()) {

    the_post();

?>

    <main class="main site__item">
        <div class="breadcrums">
            <?php trunov_breadcrumbs(); ?>
        </div>

        <section class="page">
            <div class="row">

                <div class="content col-lg-8">

                    <?php

                    get_template_part('template-parts/page/content');

                    ?>

                </div>

                <aside class="sidebar col-md-4 d-none d-lg-block">

                    <?php

                    get_template_part('template-parts/sidebar/sidebar');

                    ?>

                </aside>

            </div>
        </section>
    </main>

<?php

}

get_footer();
