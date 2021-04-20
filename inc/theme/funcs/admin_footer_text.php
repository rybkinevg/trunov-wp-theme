<?php

function remove_footer_admin()
{
    return '';
}

add_filter('admin_footer_text', 'remove_footer_admin');
