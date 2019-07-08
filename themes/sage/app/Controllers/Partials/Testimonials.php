<?php

namespace App\Controllers\Partials;

trait Testimonials
{
    public static function get($count)
    {
        $args = [
            'post_type' => 'testimonials',
            'posts_per_page' => $count,
            'orderby' => 'rand',
        ];
        return new \WP_Query( $args );
    }
}