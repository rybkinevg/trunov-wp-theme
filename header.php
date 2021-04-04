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
                    <h1>«ТРУНОВ, АЙВАР И ПАРТНЁРЫ»</h1>
                    <p>Международная Юридическая фирма, основана в 2001 году</p>
                </div>
                <div class="header__contacts">
                    <p>+7(499)158-29-17</p>
                    <p>+7(499)158-85-81</p>
                    <p>+7(499)158-65-66</p>
                    <p>info@copy.trunov.com</p>
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

                <?php

                $args = [
                    'theme_location' => 'header',
                    'container'      => false,
                    'items_wrap'     => '<ul class="navbar-nav">%3$s</ul>',
                    'walker'         => new Bootstrap_Nav_Menu(),
                ];

                wp_nav_menu($args);

                ?>

                <form class="d-flex">
                    <input class="form-control me-2" type="search" placeholder="Поиск по сайту" aria-label="Search">
                    <button class="btn btn-outline-dark" type="submit">Найти</button>
                </form>
            </div>
        </nav>