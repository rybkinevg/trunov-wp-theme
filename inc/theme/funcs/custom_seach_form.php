<?php

add_filter('get_search_form', 'trunov_search_form', 10, 2);

function trunov_search_form($form, $args)
{
    $value = get_search_query() ?: '';

    $form = "
        <form role='search' method='get' class='search-form' action='/'>
            <label for='search' class='form-label'>Введите поисковый запрос</label>
            <div class='input-group'>
                <input type='search' class='form-control' id='search' value='{$value}' name='s'>
                <button type='submit' class='btn btn-primary'>Искать</button>
            </div>
        </form>
    ";

    return $form;
}
