<?php

get_header();

$args = [
    'post_type'      => 'advocats',
    'posts_per_page' => -1,
    'post_status'    => 'publish',
    'meta_query'     => [
        [
            'key'     => 'office',
            'compare' => 'EXISTS'
        ]
    ]
];

$query = new WP_Query($args);

while ($query->have_posts()) {

    $query->the_post();

    var_dump(carbon_get_post_meta(get_the_ID(), 'office'));
}

?>

Просмотров: <?php echo get_post_meta(3973, 'views', true); ?>

<main class="main">

    <div class="container">
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
    </div>

</main>

<?php

get_footer();

?>