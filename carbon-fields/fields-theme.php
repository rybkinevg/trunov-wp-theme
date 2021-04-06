<?php

$img_src = get_template_directory_uri() . '/assets/img/theme-options';

use Carbon_Fields\Container;
use Carbon_Fields\Field;

Container::make(
    'theme_options',
    'Настройки темы'
)->add_tab(
    'Шапка сайта',
    [
        Field::make(
            'html',
            'site-title-info',
            'Заголовок сайта'
        )->set_html(
            "
            <div style='margin: 10px 0 20px 0; font-size: 18px; font-weight: bold;'>Заголовок сайта</div>
            <img src='{$img_src}/site-title-min.png' width='100%' height='250px' />
            "
        ),
        Field::make(
            'text',
            'site-title',
            'Заголовок сайта'
        )->set_default_value(
            '«ТРУНОВ, АЙВАР И ПАРТНЁРЫ»'
        ),
        Field::make(
            'text',
            'site-desc',
            'Описание под заголовком'
        )->set_default_value(
            'Международная Юридическая фирма, основана в 2001 году'
        ),
        Field::make(
            'html',
            'site-contacts-info'
        )->set_html(
            "
            <div style='margin: 10px 0 20px 0; font-size: 18px; font-weight: bold;'>Контактная информация в шапке</div>
            <img src='{$img_src}/site-contacts-min.png' width='100%' height='250px' />
            "
        ),
        Field::make(
            'complex',
            'site-contacts',
            'Контактная информация в шапке'
        )->setup_labels(
            [
                'plural_name'   => 'контакт',
                'singular_name' => 'контакты',
            ]
        )->add_fields(
            [
                Field::make(
                    'text',
                    'site-contact',
                    'Контакт'
                ),
                Field::make(
                    'text',
                    'site-contact-link',
                    'Ссылка контакта'
                )->set_help_text(
                    'Для телефона префикс - "tel:", для почты - "mailto:"'
                ),
            ]
        ),
        Field::make(
            'html',
            'site-socials-info'
        )->set_html(
            "
            <div style='margin: 10px 0 20px 0; font-size: 18px; font-weight: bold;'>Социальные сети</div>
            <img src='{$img_src}/site-socials-min.png' width='100%' height='250px' />
            "
        ),
        Field::make(
            'complex',
            'site-socials',
            'Социальные сети'
        )->setup_labels(
            [
                'plural_name'   => 'соц. сети',
                'singular_name' => 'соц. сеть',
            ]
        )->add_fields(
            [
                Field::make(
                    'select',
                    'site-social',
                    'Социальная сеть'
                )->set_options(
                    [
                        'vk'            => 'Вконтакте',
                        'twitter'       => 'Twitter',
                        'facebook'      => 'Facebook',
                        'instagram'     => 'Instagram',
                        'youtube'       => 'YouTube',
                        'odnoklassniki' => 'Одноклассники',
                        'telegram'      => 'Telegram',
                        'whatsapp'      => 'Whatsapp',
                    ]
                ),
                Field::make(
                    'text',
                    'site-social-link',
                    'Ссылка на социальную сеть'
                ),
            ]
        )
    ]
)->add_tab(
    'Сайдбар',
    [
        Field::make(
            'html',
            'sidebar-topics-info'
        )->set_html(
            "
            <div style='margin: 10px 0 20px 0; font-size: 18px; font-weight: bold;'>Темы в сайдбаре</div>
            <img src='{$img_src}/sidebar-topics-min.png' width='100%' height='300px' />
            "
        ),
        Field::make(
            'association',
            'sidebar-topics',
            'Темы в сайдбаре'
        )->set_types(
            [
                [
                    'type'     => 'term',
                    'taxonomy' => 'topics',
                ]
            ]
        )->set_max(
            5
        )->set_help_text(
            'Выбранные темы будут отображаться над разделом "Новости" в сайдбаре'
        ),
        Field::make(
            'html',
            'sidebar-publications-info'
        )->set_html(
            "
            <div style='margin: 10px 0 20px 0; font-size: 18px; font-weight: bold;'>Научные публикации в сайдбаре</div>
            <img src='{$img_src}/sidebar-publications-min.png' width='100%' height='300px' />
            "
        ),
        Field::make(
            'association',
            'sidebar-publications',
            'Научные публикации в сайдбаре'
        )->set_types(
            [
                [
                    'type'      => 'post',
                    'post_type' => 'publications',
                ]
            ]
        )->set_max(
            5
        )->set_help_text(
            'Выбранные темы будут отображаться в разделе "Актуальные научные публикации" в сайдбаре, если не указывать, то выведуться последние публикации'
        )
    ]
);
