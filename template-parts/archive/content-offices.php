<li class="archive__list-item">
    <div class="card-holder">
        <article class="card">
            <div class="row g-0">
                <div class="col-md-4">
                    <a href="<?= get_the_permalink(); ?>" class="archive__img">
                        <?= trunov_get_thumbnail(); ?>
                    </a>
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <h5 class="card-title">
                            <a href="<?= get_the_permalink(); ?>">
                                <?= get_the_title(); ?>
                            </a>
                        </h5>
                        <p class="card-text"><?= kama_excerpt(['maxchar' => 200, 'autop' => 0]); ?></p>
                    </div>
                </div>
            </div>
        </article>
    </div>
</li>