<li class="archive__list-item">
    <article class="card">
        <div class="card-body">
            <h5 class="card-title">
                <a href="<?= get_the_permalink(); ?>">
                    <?= get_the_title(); ?>
                </a>
            </h5>
            <p class="card-text"><?= kama_excerpt(['maxchar' => 200, 'autop' => 0]); ?></p>
        </div>
    </article>
</li>