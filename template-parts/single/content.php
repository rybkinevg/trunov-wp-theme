<article class="single__item">
    <h2 class="single__title mb-2"><?= get_the_title(); ?></h2>
    <small class="d-block text-muted mb-2"><?= get_the_date('j F Y'); ?></small>
    <div class="single__content">
        <?= get_the_content(); ?>
    </div>
</article>