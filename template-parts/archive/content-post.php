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

                        <?php

                        if (current_user_can('manage_options')) {

                            $sort = carbon_get_post_meta(get_the_ID(), 'sort');

                        ?>

                            <div class="mb-3 position-absolute top-0 end-0">
                                <span class="badge bg-primary">№ <?= $sort ?></span>
                            </div>

                        <?php

                        }

                        ?>

                        <p class="card-text text-muted archive__props">
                            <i class="fa fa-calendar me-2" aria-hidden="true"></i>
                            <span><?= get_the_date('j F Y'); ?></span>
                        </p>
                        <h5 class="card-title">
                            <a href="<?= get_the_permalink(); ?>">
                                <?= kama_excerpt(['maxchar' => 60, 'text' => get_the_title(), 'autop' => false]) ?>
                            </a>
                        </h5>
                        <p class="card-text"><?= kama_excerpt(['maxchar' => 200, 'autop' => 0]); ?></p>
                    </div>
                </div>
            </div>
        </article>
    </div>
</li>