<article class="single__item">
    <h2 class="single__title mb-4"><?= get_the_title(); ?></h2>

    <div class="single__props text-muted my-3">

        <div class="single__prop">
            <i class="fa fa-calendar me-2" aria-hidden="true"></i>
            <span><?= get_the_date('j F Y'); ?></span>
        </div>

        <div class="single__prop">
            <i class="fa fa-eye me-2" aria-hidden="true"></i>
            <span><?= pvc_get_post_views(); ?></span>
        </div>

    </div>

    <div class="single__content">
        <?php the_content(); ?>
    </div>

    <div class="single__share border mt-4">
        <div class="share">
            <a target="_blank" rel="noopener noreferrer" href="<?= trunov_get_share_url('vkontakte'); ?>" class="share__item">
                <i class="fa fa-vk" aria-hidden="true"></i>
            </a>
            <a target="_blank" rel="noopener noreferrer" href="<?= trunov_get_share_url('facebook'); ?>" class="share__item">
                <i class="fa fa-facebook" aria-hidden="true"></i>
            </a>
            <a target="_blank" rel="noopener noreferrer" href="<?= trunov_get_share_url('twitter'); ?>" class="share__item">
                <i class="fa fa-twitter" aria-hidden="true"></i>
            </a>
            <a target="_blank" rel="noopener noreferrer" href="<?= trunov_get_share_url('odnoklassniki'); ?>" class="share__item">
                <i class="fa fa-odnoklassniki" aria-hidden="true"></i>
            </a>
        </div>
    </div>

    <div class="single__item single__taxes border mt-4">
        <?php

        $post_taxes = trunov_get_post_taxes(get_the_ID());

        trunov_show_post_meta($post_taxes);

        $post_meta_persons = trunov_get_post_meta(get_the_ID(), 'persons', 'Персоны', 'advocats');

        trunov_show_post_meta($post_meta_persons);

        $post_meta_services = trunov_get_post_meta(get_the_ID(), 'services', 'Услуги', 'services');

        trunov_show_post_meta($post_meta_services);

        ?>
    </div>

</article>