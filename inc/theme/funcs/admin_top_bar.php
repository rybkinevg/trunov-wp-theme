<?php

add_action('wp_before_admin_bar_render', 'delete_item_from_toolbar', 99);

function delete_item_from_toolbar()
{
    global $wp_admin_bar;

    $wp_admin_bar->remove_menu('wp-logo');
    $wp_admin_bar->remove_menu('updates');
}
