<?php

class Bootstrap_Nav_Menu extends Walker_Nav_Menu
{
    public function start_el(&$output, $item, $depth = 0, $args = [], $id = 0)
    {
        if (isset($args->item_spacing) && 'discard' === $args->item_spacing) {

            $t = '';
            $n = '';
        } else {

            $t = "\t";
            $n = "\n";
        }

        $indent = ($depth) ? str_repeat($t, $depth) : '';

        $args = apply_filters('nav_menu_item_args', $args, $item, $depth);

        $is_dropdown = ($depth === 0 && in_array('menu-item-has-children', $item->classes));

        if ($is_dropdown) {

            $link_class = 'nav-link';
            $li_class = 'nav-item dropdown';
        } else if ($depth === 1) {

            $link_class = 'dropdown-item';
            $li_class = '';
        } else {

            $link_class = 'nav-link';
            $li_class = 'nav-item';
        }

        if ($item->current)
            $link_class .= ' active';

        $output .= $indent . '<li class="' . $li_class . '">';

        // $item_output .= ($is_dropdown) ? '<button data-bs-toggle="dropdown"></button>' : '';

        $atts = [];

        $atts['title']  = !empty($item->attr_title) ? $item->attr_title : '';
        $atts['target'] = !empty($item->target)     ? $item->target     : '';
        $atts['rel']    = !empty($item->xfn)        ? $item->xfn        : '';
        $atts['href']   = !empty($item->url)        ? $item->url        : '';

        $atts = apply_filters('nav_menu_link_attributes', $atts, $item, $args, $depth);

        $attributes = '';

        foreach ($atts as $attr => $value) {

            if (!empty($value)) {

                $value = ('href' === $attr) ? esc_url($value) : esc_attr($value);

                $attributes .= ' ' . $attr . '="' . $value . '"';
            }
        }

        $title = apply_filters('the_title', $item->title, $item->ID);
        $title = apply_filters('nav_menu_item_title', $title, $item, $args, $depth);

        $item_output = $args->before;
        $item_output .= '<a class="' . $link_class . '"' . $attributes . '>';
        $item_output .= $args->link_before . $title . $args->link_after;
        $item_output .= '</a>';
        $item_output .= $args->after;

        $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
    }

    public function end_el(&$output, $item, $depth = 0, $args = null)
    {
        if (isset($args->item_spacing) && 'discard' === $args->item_spacing) {

            $t = '';
            $n = '';
        } else {

            $t = "\t";
            $n = "\n";
        }

        $output .= "</li>{$n}";
    }

    public function start_lvl(&$output, $depth = 0, $args = null)
    {
        if (isset($args->item_spacing) && 'discard' === $args->item_spacing) {

            $t = '';
            $n = '';
        } else {

            $t = "\t";
            $n = "\n";
        }

        $indent = str_repeat($t, $depth);

        $toggle_btn = '<button class="d-lg-none dropdown-toggle--plus btn btn-outline-dark" data-bs-toggle="dropdown" aria-expanded="false">+</button>';

        $output .= "{$n}{$indent}{$toggle_btn}<ul class='dropdown-menu'>{$n}";
    }
}
