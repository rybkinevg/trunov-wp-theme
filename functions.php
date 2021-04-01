<?php

add_action('after_setup_theme', 'trunov_setup');

if (!function_exists('trunov_setup')) {

    function trunov_setup()
    {
        // Генерация заголовка страницы
        add_theme_support('title-tag');

        // Поддержка миниатюр кастомных постов
        add_theme_support('post-thumbnails');

        // Навигационные меню
        register_nav_menus(
            [
                'header' => 'Меню в шапке',
                'footer' => 'Меню в подвале'
            ]
        );

        /*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
        add_theme_support(
            'html5',
            array(
                'search-form',
                'comment-form',
                'comment-list',
                'gallery',
                'caption',
                'style',
                'script',
            )
        );
    }
}

require_once get_template_directory() . '/inc/autoload.php';

require_once get_template_directory() . '/transfer/init.php';

require_once get_template_directory() . '/carbon-fields/carbon-fields.php';

// Remove side menu
// add_action('admin_menu', 'remove_default_post_type');

// function remove_default_post_type()
// {
//     remove_menu_page('edit.php');
// }

// // Remove +New post in top Admin Menu Bar
// add_action('admin_bar_menu', 'remove_default_post_type_menu_bar', 999);

// function remove_default_post_type_menu_bar($wp_admin_bar)
// {
//     $wp_admin_bar->remove_node('new-post');
// }

// // Remove Quick Draft Dashboard Widget
// add_action('wp_dashboard_setup', 'remove_draft_widget', 999);

// function remove_draft_widget()
// {
//     remove_meta_box('dashboard_quick_press', 'dashboard', 'side');
// }
