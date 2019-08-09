<?php

namespace App\Controllers;

use Sober\Controller\Controller;

class Home extends Controller
{
    protected $acf = true;

    public static function the_query($cat = '')
    {
        $args = [
            'showposts' => 4,
            'order' => 'DESC',
            'orderby' => 'ID',
        ];
        if($cat != '')
        {
            $args['cat'] = $cat;
        }
        // dd($args);
        return new \WP_Query($args);
    }
}
