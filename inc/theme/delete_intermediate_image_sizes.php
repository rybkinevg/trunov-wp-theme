<?php

add_filter('intermediate_image_sizes', 'delete_intermediate_image_sizes');

function delete_intermediate_image_sizes($sizes)
{
    return array_diff(
        $sizes,
        [
            'medium',
            'medium_large',
            'large',
            '1536x1536',
            '2048x2048',
        ]
    );
}
