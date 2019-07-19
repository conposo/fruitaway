<?php

namespace App;

/**
 * Add <body> classes
 */
add_filter('body_class', function (array $classes) {
    /** Add page slug if it doesn't exist */
    if (is_single() || is_page() && !is_front_page()) {
        if (!in_array(basename(get_permalink()), $classes)) {
            $classes[] = basename(get_permalink());
        }
    }

    /** Add class if sidebar is active */
    if (display_sidebar()) {
        $classes[] = 'sidebar-primary';
    }

    /** Clean up class names for custom templates */
    $classes = array_map(function ($class) {
        return preg_replace(['/-blade(-php)?$/', '/^page-template-views/'], '', $class);
    }, $classes);

    return array_filter($classes);
});

/**
 * Add "… Continued" to the excerpt
 */
add_filter('excerpt_more', function () {
    return ' &hellip; <a href="' . get_permalink() . '">' . __('Continued', 'sage') . '</a>';
});

/**
 * Template Hierarchy should search for .blade.php files
 */
collect([
    'index', '404', 'archive', 'author', 'category', 'tag', 'taxonomy', 'date', 'home',
    'frontpage', 'page', 'paged', 'search', 'single', 'singular', 'attachment', 'embed'
])->map(function ($type) {
    add_filter("{$type}_template_hierarchy", __NAMESPACE__.'\\filter_templates');
});

/**
 * Render page using Blade
 */
add_filter('template_include', function ($template) {
    collect(['get_header', 'wp_head'])->each(function ($tag) {
        ob_start();
        do_action($tag);
        $output = ob_get_clean();
        remove_all_actions($tag);
        add_action($tag, function () use ($output) {
            echo $output;
        });
    });
    $data = collect(get_body_class())->reduce(function ($data, $class) use ($template) {
        return apply_filters("sage/template/{$class}/data", $data, $template);
    }, []);
    if ($template) {
        echo template($template, $data);
        return get_stylesheet_directory().'/index.php';
    }
    return $template;
}, PHP_INT_MAX);

/**
 * Render comments.blade.php
 */
add_filter('comments_template', function ($comments_template) {
    $comments_template = str_replace(
        [get_stylesheet_directory(), get_template_directory()],
        '',
        $comments_template
    );

    $data = collect(get_body_class())->reduce(function ($data, $class) use ($comments_template) {
        return apply_filters("sage/template/{$class}/data", $data, $comments_template);
    }, []);

    $theme_template = locate_template(["views/{$comments_template}", $comments_template]);

    if ($theme_template) {
        echo template($theme_template, $data);
        return get_stylesheet_directory().'/index.php';
    }

    return $comments_template;
}, 100);



// Makes sure the plugin is defined before trying to use it
if ( ! function_exists( 'is_plugin_active_for_network' ) ) {
    require_once( ABSPATH . '/wp-admin/includes/plugin.php' );
}

$plugin_woo = 'woocommerce/woocommerce.php';
if ( is_plugin_active_for_network($plugin_woo) || is_plugin_active( $plugin_woo ) ) {

    /*
    * Remove Woo Styles
    */
    add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );

    /* Remove product meta */
    remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );

    /**
     * Remove related products output
     */
    remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );
    add_action( 'custom_woocommerce_related_product', function() {
        add_action( 'custom_woocommerce_related_product', 'woocommerce_output_related_products', 30 );
    }, 10, 1 ); 
    remove_action( 'woocommerce_cart_collaterals', 'woocommerce_cart_totals', 10 );

    // remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15 );

    if( is_page() || !is_product() ) {
        /**
         * Remove product price
         */
        remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );
    }

    /*
    * Print Short Description for Product with Variations // (for now only for "Box with seasoned fruits" but without condition)
    */
    remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20 );    
    add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 30 );
    
    add_filter( 'woocommerce_get_image_size_gallery_thumbnail', function( $size ) {
        return array(
        'width' => 1024,
        'height' => 1024,
        'crop' => 0,
        );
    });

    /**
     * Change some Breadcrumbs settings
     */
    add_filter( 'woocommerce_breadcrumb_defaults', function() {
        return array(
            'delimiter'   => ' > ',
            'wrap_before' => '<nav class="mt-4 py-2 шейш-кззеиъьяе woocommerce-breadcrumb" itemprop="breadcrumb">',
            'wrap_after'  => '</nav>',
            'before'      => '',
            'after'       => '',
            'home'        => _x( 'Начало', 'breadcrumb', 'woocommerce' ),
        );
    });

    /**
     * Change Buttons Text
     */
    add_filter( 'woocommerce_product_add_to_cart_text' , function () {
        global $product;
        $product_type = $product->get_type();
        switch ( $product_type ) {
            case 'external':
                return __( 'Buy product', 'woocommerce' );
            break;
            case 'grouped':
                return __( 'View products', 'woocommerce' );
            break;
            case 'simple':
                return __( '+ ДОБАВИ В КОШНИЦАТА', 'woocommerce' );
            break;
            case 'variable':
                return __( 'Виж повече >', 'woocommerce' );
            break;
            default:
                return __( 'Read more', 'woocommerce' );
        }
    });

    /**
     * Add to Cart Redirects
     */
    add_filter( 'woocommerce_add_to_cart_redirect',
    function ( $url ) {

        $do_it_yourself_ID = get_field('do_it_yourself', 'option');
        $terms = get_field('categories', $do_it_yourself_ID);

        $product_id = isset( $_REQUEST['add-to-cart'] ) ? absint( $_REQUEST['add-to-cart'] ) : false;
        // var_dump($product_id);
        // die;
        $product_id = apply_filters( 'woocommerce_add_to_cart_product_id', $product_id );
        $readirect_to_cart = get_post_meta( $product_id, '_my_custom_field', true );
        
        $_pf = new \WC_Product_Factory();  
        $_product = $_pf->get_product($product_id);
        // var_dump($_product);
        // die;
        if( $readirect_to_cart || $_product->is_type('variable') )
        {
            $url = wc_get_cart_url();
        }
        if ( ! $product_id ) {
            return $url;
        }

        // if( has_term( ['redirect_to_card'], 'product_tag', $product_id ) )
        // {
        //     $url = wc_get_cart_url();
        // }
        // else
        // {
        //     if ( has_term( $terms, 'product_cat', $product_id ) )
        //     {
        //         return get_permalink($do_it_yourself_ID);
        //     }
        //     else
        //     {
        //         $url = wc_get_cart_url(); // wc_get_checkout_url();
        //     }
        // }

        return $url;
    });
}

add_filter( 'the_content', function( $content ) {
    $formatted_content = $content;
    if ( is_singular('post') && has_post_thumbnail()) {
        $featuredimage = get_the_post_thumbnail(get_the_ID(), 'full', ['class' => 'w-100 h-auto']);
        $title = get_the_title();
        $authorimage = get_avatar( get_the_author_meta( 'ID' ), 50 );
        $authorname = get_the_author_meta('display_name');
        $postdate = get_the_date('d.m.Y');
        $formatted_content = '
        <div class="col-12">
            <h1 class="my-5">'.$title.'</h1>'
            . $featuredimage . '
            <div class="author-box d-flex align-items-center">
                '. $authorimage . '
                <p>
                '.__('Author').': '. $authorname .'<br>
                ' . $postdate.'
                </p>
            </div>
        </div>
        <div class="col-12 col-md-10 pb-5">' . $content . '</div>';
    }

    return $formatted_content;
});

