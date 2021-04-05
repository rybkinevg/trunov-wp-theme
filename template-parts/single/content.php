<article class="single__item">
    <h2 class="single__title"><?= get_the_title(); ?></h2>
    <div class="single__props text-muted my-3">
        <div class="single__prop">
            <i class="fa fa-calendar me-2" aria-hidden="true"></i>
            <span><?= get_the_date('j F Y'); ?></span>
        </div>
        <div class="single__prop">
            <i class="fa fa-eye me-2" aria-hidden="true"></i>
            <span>Просмотры</span>
        </div>
    </div>
    <div class="single__content">
        <?= get_the_content(); ?>
    </div>
</article>