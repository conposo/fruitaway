<?php

namespace App\Controllers;

use Sober\Controller\Controller;

class App extends Controller
{
    use Partials\Testimonials;
    protected $acf = true;

    public static function logo($size, $action)
    {
        if('print' == $action)
        {
            $image = wp_get_attachment_image( get_field('logo', 'options')[$size], '', '', ['alt' => 'Logo '.get_bloginfo('name', 'display')] );
        }

        return $image;
    }
    // Common Settings Field
    // public static function show_the_content()
    // {
    //     return get_field('show_the_content_on_screen', 'option');
    // }
    // public static function in_array_r($needle, $haystack, $strict = false)
    // {
    //     foreach ($haystack as $item) {
    //         if (($strict ? $item === $needle : $item == $needle) || (is_array($item) && self::in_array_r($needle, $item, $strict))) {
    //             return true;
    //         }
    //     }
    //     return false;
    // }

    // public static function current_lang()
    // {
    //     $current_lang = get_locale();
    //     return $current_lang;
    // }

    // public static function languages()
    // {
    //     $languages = explode(',', get_field('chosen_language_codes', 'option'));
    //     return $languages;
    // }

    public static function testimonialsHeader()
    {
        if( $header = get_field('testimonials_section_header', 'option') )
            return $header;
        else
            return false;
    }
    public static function testimonialsNumber()
    {
        $number = get_field('number_of_testimonials_shown_on_front', 'option');
        return $number;
    }

    public function siteName()
    {
        return get_bloginfo('name');
    }

    public static function title()
    {
        if (is_home()) {
            if ($home = get_option('page_for_posts', true)) {
                return get_the_title($home);
            }
            return __('Latest Posts', 'sage');
        }
        if (is_archive()) {
            return get_the_archive_title();
        }
        if (is_search()) {
            return sprintf(__('Search Results for %s', 'sage'), get_search_query());
        }
        if (is_404()) {
            return __('Not Found', 'sage');
        }
        return get_the_title();
    }
}
