<?php

function is_attach_exists($filename)
{
    global $wpdb;

    $query = "SELECT COUNT(*) FROM {$wpdb->postmeta} WHERE meta_value LIKE '%/$filename'";

    return ($wpdb->get_var($query) > 0);
}
