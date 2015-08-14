<?php

/*
  Plugin Name: Lazy Load for WooCommerce
  Plugin URI: https://wordpress.org/plugins/lazyload-woocommerce/
  Description: Lazy Load for WooCommerce includes the functionality to properly append Lazy Load into the image loop for WooCommerce in product listings (i.e. category). This does not apply to the individual product image, but anywhere they are used in the loop (by default, the unordered list). Includes a fallback if JavaScript is not active. Does not call in jQuery (you must have this already in use).
  Version: 1.1
  Author: Edge Webware
  Author URI: http://edgewebware.com
  License: GPLv2
  Text Domain: lazyload-woo
 */
/*
  Copyright (C) 2015 Edge Webware
  This program is free software; you can redistribute it and/or
  modify it under the terms of the GNU General Public License
  as published by the Free Software Foundation; either version 2
  of the License, or (at your option) any later version.
  This program is distributed in the hope that it will be useful,
  but WITHOUT ANY WARRANTY; without even the implied warranty of
  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
  GNU General Public License for more details.
  You should have received a copy of the GNU General Public License
  along with this program; if not, write to the Free Software
  Foundation, Inc., 59 Temple Place - Suite 330, Boston, MA  02111-1307, USA.
 */

/* This utilizes the LazyLoad Script written by Mike Tuupola. View his project here http://www.appelsiini.net/projects/lazyload */

// If this file is called directly, abort.
if (!defined('WPINC')) {
    die;
}

//option for setting width and height
add_filter('woocommerce_get_sections_products', 'lazyload_woo_add_section');

function lazyload_woo_add_section($sections) {
    $sections['lazywoo'] = __('Lazy Load', 'lazyload-woo');
    return $sections;
}

add_filter('woocommerce_get_settings_products', 'lazyload_woo_all_settings', 10, 2);

function lazyload_woo_all_settings($settings, $current_section) {
    if ($current_section == 'lazywoo') {
        $settings_slider = array();
        // Add Title to the Settings
        $settings_slider[] = array('name' => __('Lazy Load Image Settings', 'lazyload-woo'), 'type' => 'title', 'desc' => __('The following options are used to configure LazyLoad for WooCommerce. It is recommended that these match your set catalog image dimensions under Display.', 'lazyload-woo'), 'id' => 'lazywoo');
        // Add first checkbox option
        $settings_slider[] = array(
            'name' => __('Product Width', 'lazyload-woo'),
            'desc_tip' => __('This will set the width for your catalog images', 'lazyload-woo'),
            'id' => 'lazyload-woo_width',
            'type' => 'text',
            'desc' => __('This will set the width for your catalog images', 'lazyload-woo'),
        );
        // Add second text field option
        $settings_slider[] = array(
            'name' => __('Product Height', 'lazyload-woo'),
            'desc_tip' => __('This will set the height for your catalog images', 'lazyload-woo'),
            'id' => 'lazyload-woo_height',
            'type' => 'text',
            'desc' => __('This will set the height for your catalog images', 'lazyload-woo'),
        );
        $settings_slider[] = array(
            'name' => __('Placeholder Image', 'lazyload-woo'),
            'desc_tip' => __('Please put the full URL for the placeholder image. If none is set, it will default to the WooCommerce plaeholder image.', 'lazyload-woo'),
            'id' => 'lazyload-woo_placeholder',
            'type' => 'text',
            'desc' => __('This will set the custom placeholder image for your catalog images', 'lazyload-woo'),
        );
        $settings_slider[] = array('type' => 'sectionend', 'id' => 'lazywoo');
        return $settings_slider;
    } else {
        return $settings;
    }
}

/* WooCommerce Loop Product Thumbs */
if (!function_exists('woocommerce_template_loop_product_thumbnail')) {


    /* Queue up Lazy Load in the head */

    function lazyload_woo_scripts() {
        // Register
        wp_register_script('lazyload', plugins_url('/js/jquery.lazyload.min.js', __FILE__), array('jquery'), '1.9.5', false);
        wp_register_script('lazyload-call', plugins_url('/js/call-ll.js', __FILE__), array('jquery'), '1.0', true);
        wp_register_style('lazyload-css', plugins_url('/css/lazy.css', __FILE__), array(), '1.0', 'all');
        //Enqueue
        wp_enqueue_script('lazyload');
        wp_enqueue_script('lazyload-call');
        wp_enqueue_style('lazyload-css');
    }

    add_action('wp_enqueue_scripts', 'lazyload_woo_scripts');

    remove_action('woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10);
    add_action('woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10);

    function woocommerce_template_loop_product_thumbnail() {
        $llwoo_image_src = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full');
        $llwoo_placeholder = get_option('lazyload-woo_placeholder');
        $llwoo_placeholder_fallback = woocommerce_placeholder_img_src();
        $llwoo_width = get_option('lazyload-woo_width');
        $llwoo_height = get_option('lazyload-woo_height');
        if (!empty($llwoo_placeholder)) {
            echo '<img src="' . $llwoo_placeholder . '" data-original="' . $llwoo_image_src[0] . '" width="' . $llwoo_width . '" height="' . $llwoo_height . '" class="attachment-shop_catalog wp-post-image lazy"><noscript><img src="' . $llwoo_image_src[0] . '" width="' . $llwoo_width . '" height="' . $llwoo_height . '" class="attachment-shop_catalog wp-post-image lazy"></noscript>';
        } else {
            echo '<img src="' . $llwoo_placeholder_fallback . '" data-original="' . $llwoo_image_src[0] . '" width="' . $llwoo_width . '" height="' . $llwoo_height . '" class="attachment-shop_catalog wp-post-image lazy"><noscript><img src="' . $llwoo_image_src[0] . '" width="' . $llwoo_width . '" height="' . $llwoo_height . '" class="attachment-shop_catalog wp-post-image lazy"></noscript>';
        }
    }

}