<?php

use Carbon_Fields\Container;
use Carbon_Fields\Field;

Container::make(
    'post_meta',
    'Sort options'
)->show_on_post_type(
    [
        'post',
        'advocats',
        'juristy'
    ]
)->set_context(
    'side'
)->add_fields(
    [
        Field::make('text', 'sort', 'Порядковый номер')
            ->set_default_value(10)
    ]
);
