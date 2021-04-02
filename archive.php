<?php

get_header();

if (have_posts()) {

    $post_type = get_post_type();

?>

    <main class="main site__item">
        <div class="breadcrums">
            <?php trunov_breadcrumbs(); ?>
        </div>
        <section class="archive archive__<?= $post_type; ?>">
            <h2 class="archive__head">
                <?= trunov_archive_title($post_type); ?>
            </h2>
            <div class="row">

                <div class="content col-lg-8">
                    <ul class="archive__list">

                        <?php

                        while (have_posts()) {

                            the_post();

                            get_template_part('template-parts/archive/content', $post_type);
                        }

                        ?>

                    </ul>

                    <?php

                    trunov_pagiantion();

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

?>