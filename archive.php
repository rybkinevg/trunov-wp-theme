<?php

get_header();

if (have_posts()) {

    $post_type = get_post_type();

?>

    <main class="main">
        <div class="container">
            <div class="breadcrums">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/">Главная</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Пресс-центр</li>
                    </ol>
                </nav>
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

                        <nav aria-label="Page navigation example">
                            <ul class="pagination">
                                <li class="page-item">
                                    <a class="page-link" href="#" aria-label="Previous">
                                        <span aria-hidden="true">&laquo;</span>
                                    </a>
                                </li>
                                <li class="page-item"><a class="page-link" href="#">1</a></li>
                                <li class="page-item"><a class="page-link" href="#">2</a></li>
                                <li class="page-item"><a class="page-link" href="#">3</a></li>
                                <li class="page-item">
                                    <a class="page-link" href="#" aria-label="Next">
                                        <span aria-hidden="true">&raquo;</span>
                                    </a>
                                </li>
                            </ul>
                        </nav>

                        <?php

                        the_posts_pagination();

                        ?>

                    </div>

                    <aside class="sidebar col-md-4 d-none d-lg-block">

                        <?php

                        get_template_part('template-parts/sidebar/sidebar');

                        ?>

                    </aside>

                </div>
            </section>
        </div>
    </main>

<?php

}

get_footer();

?>