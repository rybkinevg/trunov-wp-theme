<?php

add_action('wp_dashboard_setup', 'clear_wp_dash');

function clear_wp_dash()
{
    $dash_side   = &$GLOBALS['wp_meta_boxes']['dashboard']['side']['core'];
    $dash_normal = &$GLOBALS['wp_meta_boxes']['dashboard']['normal']['core'];

    unset($dash_side['dashboard_quick_press']);       // Быстрая публикация
    unset($dash_side['dashboard_recent_drafts']);     // Последние черновики
    unset($dash_side['dashboard_primary']);           // Блог WordPress
    unset($dash_side['dashboard_secondary']);         // Другие Новости WordPress

    unset($dash_normal['dashboard_incoming_links']);  // Входящие ссылки
    unset($dash_normal['dashboard_right_now']);       // Прямо сейчас
    unset($dash_normal['dashboard_recent_comments']); // Последние комментарии
    unset($dash_normal['dashboard_plugins']);         // Последние Плагины
    unset($dash_normal['dashboard_activity']);        // Активность
    // unset($dash_normal['dashboard_site_health']);     // Здоровье сайта
}

remove_action('welcome_panel', 'wp_welcome_panel');
