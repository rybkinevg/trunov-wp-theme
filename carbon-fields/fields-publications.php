<?php

use Carbon_Fields\Container;
use Carbon_Fields\Field;

Container::make('post_meta', 'Дополнительные поля')
    ->show_on_post_type('publications')
    ->add_fields(
        [
            Field::make('text', 'publications-url', 'Ссылка на публикацию')
                ->set_help_text('Укажите ссылку на публикацию')
        ]
    );
