<?php

// Подключение скриптов
add_action('wp_enqueue_scripts', 'trunov_scripts');

function trunov_scripts()
{
    // URI до папки
    $uri = get_template_directory_uri() . '/assets';

    // URI до папки
    $src = get_template_directory() . '/assets';

    $assets = [
        [
            'type'   => 'css',
            'handle' => 'bootstrap-style',
            'src'    => $uri . '/vendor/bootstrap/bootstrap.min.css',
            'deps'   => [],
            'ver'    => ''
        ],
        [
            'type'   => 'js',
            'handle' => 'bootstrap-script',
            'src'    => $uri . '/vendor/bootstrap/bootstrap.min.js',
            'deps'   => ['jquery'],
            'ver'    => ''
        ],
        [
            'type'   => 'css',
            'handle' => 'fancybox-style',
            'src'    => $uri . '/vendor/fancybox/jquery.fancybox.css',
            'deps'   => [],
            'ver'    => ''
        ],
        [
            'type'   => 'js',
            'handle' => 'fancybox-script',
            'src'    => $uri . '/vendor/fancybox/jquery.fancybox.pack.js',
            'deps'   => ['jquery'],
            'ver'    => ''
        ],
        [
            'type'   => 'css',
            'handle' => 'slick-style',
            'src'    => $uri . '/vendor/slick/slick.css',
            'deps'   => [],
            'ver'    => ''
        ],
        [
            'type'   => 'css',
            'handle' => 'slick-theme-style',
            'src'    => $uri . '/vendor/slick/slick-theme.css',
            'deps'   => [],
            'ver'    => ''
        ],
        [
            'type'   => 'css',
            'handle' => 'fontawesome-style',
            'src'    => $uri . '/vendor/fontawesome/css/font-awesome.min.css',
            'deps'   => [],
            'ver'    => ''
        ],
        [
            'type'   => 'js',
            'handle' => 'slick-script',
            'src'    => $uri . '/vendor/slick/slick.min.js',
            'deps'   => ['jquery'],
            'ver'    => ''
        ],
        [
            'type'   => 'css',
            'handle' => 'main-style',
            'src'    => $uri . '/css/main.css',
            'deps'   => [],
            'ver'    => filemtime($src . '/css/main.css')
        ],
        [
            'type'   => 'js',
            'handle' => 'main-script',
            'src'    => $uri . '/js/main.js',
            'deps'   => [],
            'ver'    => filemtime($src . '/js/main.js')
        ],
    ];

    foreach ($assets as $asset) {

        if ($asset['type'] == 'css') {

            wp_register_style(
                $asset['handle'],
                $asset['src'],
                $asset['deps'],
                $asset['ver'],
                'all'
            );

            wp_enqueue_style($asset['handle']);
        } else {

            wp_register_script(
                $asset['handle'],
                $asset['src'],
                $asset['deps'],
                $asset['ver'],
                true
            );

            wp_enqueue_script($asset['handle']);
        }
    }
}
