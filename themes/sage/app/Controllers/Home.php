<?php

namespace App\Controllers;

use Sober\Controller\Controller;

class Home extends Controller
{
    protected $acf = true;

    public static function the_query($category_nicename)
    {
        return new \WP_Query('category_name=' . $category_nicename . '&showposts=5&order=ASC');
    }
}
