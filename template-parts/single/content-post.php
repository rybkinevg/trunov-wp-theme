<?php

if (current_user_can('manage_options')) {

    $status = (carbon_get_post_meta(get_the_ID(), 'show_on_the_main') == 'show') ? 'Видна на главной' : 'Не видна на главной';
    $sort = carbon_get_post_meta(get_the_ID(), 'sort');
    $editlink = get_edit_post_link(get_the_ID());

?>

    <div class="admin_notice border p-3 my-3">
        <h4 class="mb-3">Краткая административная сводка</h4>
        <p>Статус новости на главной: <?= $status ?></p>
        <p>Порядок сортировки новости: <?= $sort ?></p>
        <p class="m-0"><a class="text-decoration-underline" href="<?= $editlink ?>">Редактировать новость</a></p>
    </div>

<?php

}

?>

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