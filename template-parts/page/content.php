<article class="page__item">
    <h2 class="page__title mb-5"><?= get_the_title(); ?></h2>
    <!-- <small class="d-block text-muted mb-2"><?= get_the_date('j F Y'); ?></small> -->
    <div class="page__content">
        <?= get_the_content(); ?>
    </div>
</article>