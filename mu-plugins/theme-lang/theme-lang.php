<?php
/**
 * Plugin Name: ECA Setup Supported Languages
 * Description: A plugin that setup supported lnguages
 * Version: 0.1
 * Author: Sholekov
 * Author URI: http://sholekov.com
 * License: GPL2
 */

/*  Copyright 2019  I.Sholekov  (email : sholeka@gmail.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/



if(!function_exists('eca_lang_setup')):

    // add_action( 'after_setup_theme', 'eca_lang_setup' );
    // function eca_lang_setup() {

    //     add_filter( 'locale', 'set_my_locale' );
    //     function set_my_locale( $lang ) {
    //         if ( isset($_GET['language']) && 'en_US' == $_GET['language'] ) {
    //             return 'en_US'; // set to choosen language
    //         } else {
    //             return $lang; // return original language
    //         }
    //     }
    //     $is_loaded_locale = load_theme_textdomain( 'eca', get_template_directory() . '/languages' );
    //     // var_dump('Locale is loaded:', $is_loaded_locale, get_locale());
    // }

endif;
