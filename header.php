<?php

$args = [
    'theme_location' => 'header',
    'container'      => false,
    'items_wrap'     => '<ul class="navbar-nav">%3$s</ul>',
    'walker'         => new Bootstrap_Nav_Menu(),
];

$site_title = carbon_get_theme_option('site-title');
$site_desc = carbon_get_theme_option('site-desc');
$site_contacts = carbon_get_theme_option('site-contacts');
$site_socials = carbon_get_theme_option('site-socials');

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>
</head>

<body class="body">

    <div class="container site p-0">

        <header class="site__item header d-none d-lg-block">
            <div class="d-flex flex-wrap justify-content-between align-items-center py-3">
                <a href="/" class="text-decoration-none">
                    <img src="<?= get_template_directory_uri() . '/assets/img/logo.png' ?>" alt="">
                </a>
                <div class="header__brand">
                    <h1><?= $site_title; ?></h1>
                    <p><?= $site_desc; ?></p>
                </div>
                <div class="header__contacts">
                    <?php

                    if ($site_contacts) {

                        foreach ($site_contacts as $contact) {

                    ?>

                            <p><a href="<?= $contact['site-contact-link'] ?>"><?= $contact['site-contact'] ?></a></p>

                    <?php

                        }
                    }

                    ?>
                </div>
            </div>
        </header>
        <nav class="site__item navbar navbar-expand-lg border-top border-bottom navbar-light">
            <a href="/" class="logo__mob d-lg-none text-decoration-none">
                <img class="img img--contain" src="<?= get_template_directory_uri() . '/assets/img/logo.png' ?>" alt="">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#main_nav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse navbar" id="main_nav">

                <div class="row w-100 justify-content-between">

                    <div class="col-12 col-lg-auto navmenu">
                        <?php wp_nav_menu($args); ?>
                    </div>

                    <?php

                    if ($site_socials) {

                    ?>

                        <div class="col-auto">
                            <div class="social">

                                <?php

                                foreach ($site_socials as $social) {

                                ?>

                                    <a class="social__link" href="<?= $social['site-social-link'] ?>">
                                        <i class="<?= "fa fa-{$social['site-social']}" ?>" aria-hidden="true"></i>
                                    </a>

                                <?php

                                }

                                ?>

                            </div>
                        </div>

                    <?php

                    }

                    ?>

                    <div class="col-auto d-flex justify-content-center">

                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#search-modal">
                            <i class="fa fa-search" aria-hidden="true"></i>
                        </button>
                    </div>

                </div>

                <div class="modal fade" id="search-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="search-modal-label">Поиск по сайту</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
                            </div>
                            <div class="modal-body">
                                <?= get_search_form(); ?>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </nav>