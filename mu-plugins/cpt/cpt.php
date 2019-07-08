<?php
/**
 * Plugin Name: ECA Custom Post Types
 * Description: A plugin that set needed theme Custom Post Types
 * Version: 0.1
 * Author: eCommerceAcademy
 * Author URI: http://ecommercebg.com
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


function thnw_custom_post_types() {


    $labels = array(
        'name'               => 'Fruits',
        'singular_name'      => 'Fruit',
        'menu_name'          => 'Fruits',
        'name_admin_bar'     => 'Fruit',
        'add_new'            => 'Add New Fruit',
        'add_new_item'       => 'Add New Fruit',
        'new_item'           => 'New Fruit',
        'edit_item'          => 'Edit Fruit',
        'view_item'          => 'View Fruit',
        'all_items'          => 'All Fruits',
        'search_items'       => 'Search Fruits',
        'parent_item_colon'  => 'Parent Fruits:',
        'not_found'          => 'No Fruits found.',
        'not_found_in_trash' => 'No Fruits found in Trash.',
    );
    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'menu_icon'          => 'dashicons-carrot',
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'fruits' ),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => 10,
        'supports'           => array( 'title', 'editor', 'thumbnail' ),
        'taxonomies'         => array( 'fruit_cat' ),
    );
    register_post_type( 'fruits', $args );


    $labels = array(
        'name'               => 'Testimonials',
        'singular_name'      => 'Testimonial',
        'menu_name'          => 'Testimonials',
        'name_admin_bar'     => 'Testimonial',
        'add_new'            => 'Add New Testimonial',
        'add_new_item'       => 'Add New Testimonial',
        'new_item'           => 'New Testimonial',
        'edit_item'          => 'Edit Testimonial',
        'view_item'          => 'View Testimonial',
        'all_items'          => 'All Testimonials',
        'search_items'       => 'Search Testimonials',
        'parent_item_colon'  => 'Parent Testimonials:',
        'not_found'          => 'No Testimonials found.',
        'not_found_in_trash' => 'No Testimonials found in Trash.',
    );
    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'menu_icon'          => 'dashicons-format-status',
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'testimonials' ),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => 10,
        'supports'           => array( 'title', 'editor', 'thumbnail' ),
        'taxonomies'         => array( 'testimonial_cat' ),
    );
    register_post_type( 'testimonials', $args );

}
add_action( 'init', 'thnw_custom_post_types' );
