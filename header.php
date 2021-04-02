<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Hello, world!</title>
    <?php wp_head(); ?>
</head>

<body class="body">

    <div class="container site p-0">

        <header class="site__item header">
            <div class="d-flex flex-wrap justify-content-center">
                <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-dark text-decoration-none">
                    <span class="fs-4">Double header</span>
                </a>
            </div>
        </header>
        <nav class="site__item navbar navbar-expand-lg navbar-dark bg-primary">
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

                <form class="col-12 col-lg-auto mb-3 mb-lg-0">
                    <input type="search" class="form-control" placeholder="Search...">
                </form>
            </div>
        </nav>