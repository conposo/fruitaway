<?php

namespace App;

use Roots\Sage\Container;

/**
 * Get the sage container.
 *
 * @param string $abstract
 * @param array  $parameters
 * @param Container $container
 * @return Container|mixed
 */
function sage($abstract = null, $parameters = [], Container $container = null)
{
    $container = $container ?: Container::getInstance();
    if (!$abstract) {
        return $container;
    }
    return $container->bound($abstract)
        ? $container->makeWith($abstract, $parameters)
        : $container->makeWith("sage.{$abstract}", $parameters);
}

/**
 * Get / set the specified configuration value.
 *
 * If an array is passed as the key, we will assume you want to set an array of values.
 *
 * @param array|string $key
 * @param mixed $default
 * @return mixed|\Roots\Sage\Config
 * @copyright Taylor Otwell
 * @link https://github.com/laravel/framework/blob/c0970285/src/Illuminate/Foundation/helpers.php#L254-L265
 */
function config($key = null, $default = null)
{
    if (is_null($key)) {
        return sage('config');
    }
    if (is_array($key)) {
        return sage('config')->set($key);
    }
    return sage('config')->get($key, $default);
}

/**
 * @param string $file
 * @param array $data
 * @return string
 */
function template($file, $data = [])
{
    return sage('blade')->render($file, $data);
}

/**
 * Retrieve path to a compiled blade view
 * @param $file
 * @param array $data
 * @return string
 */
function template_path($file, $data = [])
{
    return sage('blade')->compiledPath($file, $data);
}

/**
 * @param $asset
 * @return string
 */
function asset_path($asset)
{
    return sage('assets')->getUri($asset);
}

/**
 * @param string|string[] $templates Possible template files
 * @return array
 */
function filter_templates($templates)
{
    $paths = apply_filters('sage/filter_templates/paths', [
        'views',
        'resources/views'
    ]);
    $paths_pattern = "#^(" . implode('|', $paths) . ")/#";

    return collect($templates)
        ->map(function ($template) use ($paths_pattern) {
            /** Remove .blade.php/.blade/.php from template names */
            $template = preg_replace('#\.(blade\.?)?(php)?$#', '', ltrim($template));

            /** Remove partial $paths from the beginning of template names */
            if (strpos($template, '/')) {
                $template = preg_replace($paths_pattern, '', $template);
            }

            return $template;
        })
        ->flatMap(function ($template) use ($paths) {
            return collect($paths)
                ->flatMap(function ($path) use ($template) {
                    return [
                        "{$path}/{$template}.blade.php",
                        "{$path}/{$template}.php",
                    ];
                })
                ->concat([
                    "{$template}.blade.php",
                    "{$template}.php",
                ]);
        })
        ->filter()
        ->unique()
        ->all();
}

/**
 * @param string|string[] $templates Relative path to possible template files
 * @return string Location of the template
 */
function locate_template($templates)
{
    return \locate_template(filter_templates($templates));
}

/**
 * Determine whether to show the sidebar
 * @return bool
 */
function display_sidebar()
{
    static $display;
    isset($display) || $display = apply_filters('sage/display_sidebar', false);
    return $display;
}


/**
 * Theme Custom Functions
 */
if ( ! function_exists( 'print_attribute_radio_or_dropdown' ) ) {
    /*
     * Print Choices for Product with Variations // (for now only for "Box with seasoned fruits")
     */
    function print_attribute_radio_or_dropdown( $checked_value, $value, $label, $name, $available_variations, $rand_attribute ) {
        global $product;
        $weight = '';
        foreach($available_variations as $variation)
        {
            if(in_array($value, $variation['attributes']))
            {
                (!empty($variation['weight'])) ? $weight = $variation['weight_html'] : $weight = '';
            }
        }

        $input_name = 'attribute_' . esc_attr( $name );

        $esc_value = esc_attr( $value );
        $id = esc_attr( $name . '_v_' . $value . $product->get_id() ); //added product ID at the end of the name to target single products
        $checked = checked( $checked_value, $value, false );
        $filtered_label = apply_filters( 'woocommerce_variation_option_name', $label, esc_attr( $name ) );
        ($checked) ? $checked_class = 'checked' : $checked_class = '';

        if($product->get_id() == $GLOBALS['the_product_id'])
        {
            printf( '
            <div
                id="%7$s%8$s"
                class="d-flex justify-content-center align-items-center choice text-center '.$checked_class.'"
                onclick="jQuery(\'.attribute_%7$s .choice\').removeClass(\'checked\'); jQuery(\'#%7$s%8$s\').addClass(\'checked\')">
                <input type="radio" name="%1$s" value="%2$s" id="%3$s" %4$s>
                <label for="%3$s">%5$s<span class="d-block" >%6$s</span></label>
            </div>', $input_name, $esc_value, $id, $checked, $filtered_label, $weight, $rand_attribute, rand() );
        }
        else
        {
            printf( '           
            <div
                id="%7$s%8$s"
                class="px-2 dropdown-item d-flex w-100 justify-content-center align-items-center choice text-center '.$checked_class.'"
                onclick="jQuery(\'.custom-dropdown-toggle span.text\').text(\'%5$s\')"
                onclick="$(\'.attribute_%7$s .choice\').removeClass(\'checked\'); $(\'#%7$s%8$s\').addClass(\'checked\')">
            <label class="m-0 w-100 d-block text-left" for="%3$s">
                %5$s
                <span class="d-block">%6$s</span>
                <input type="radio" name="%1$s" value="%2$s" id="%3$s" %4$s style="ddisplay:none;">
            </label>
            </div>', $input_name, $esc_value, $id, $checked, $filtered_label, $weight, $rand_attribute, rand() );
        }
        return 'print_attribute_radio_or_dropdown';
    }
}  
