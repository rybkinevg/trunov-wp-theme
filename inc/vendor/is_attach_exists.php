<?php

// Проверяет наличие файла, если он есть в БД, то возвращает ID, если нет, то false
function is_attach_exists($filename)
{
    global $wpdb;

    $query = "
        SELECT
            `post_id`
        FROM
            `{$wpdb->postmeta}`
        WHERE
            `meta_value` LIKE '%/$filename'
    ";

    $id = $wpdb->get_var($query);

    return ($id ?: false);
}
