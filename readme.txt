=== Lazy Load for WooCommerce ===
Contributors: edgewebware,aibrean
Tags: lazy load, jquery,woocommerce, products, images
Requires at least: 4.0.0
Tested up to: 4.2.2
Stable tag: 1.0.1
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Lazy Load for WooCommerce includes the functionality to properly append Lazy Load into the image loop for WooCommerce (2.3.8 tested).

== Description ==
Lazy Load for WooCommerce includes the functionality to properly append Lazy Load into the image loop for WooCommerce in product listings (i.e. category). It has been tested against WooCommerce 2.3.8. This does not apply to the individual product image, but anywhere they are used in the loop (by default, the unordered list).

== Installation ==
1. Download the plugin
2. Install the plugin
3. Go to WooCommerce > Settings > Products and click the "Lazy Load" option. Set your Product width/height for the loop and optionally a custom placeholder image (full src).

To note, you will need to have jQuery running for this to work. To reduce conflicts, we have chosen not to include jQuery. To include jQuery, just use the following in your template functions file: `wp_enqueue_script('jquery');`

Additionally, we allow for you to modify the available functions for Lazy Load. To dequeue the plugin functions and use your own, use `wp_dequeue_style('lazyload-call');`. See http://www.appelsiini.net/projects/lazyload for a full rundown of options (trigger loading, effects, images in containers, nonsequential images, invisible images, etc.).

== Screenshots ==
1. Setting up the variable width/height for the products that will be used for LazyLoad.

== Changelog ==
= 1.0 =
* Initial version

= 1.0.1 =
* ADDED: Support for placeholder images (url option in settings)
* Adjusted Plugin name (Lazy Load rather than LazyLoad)