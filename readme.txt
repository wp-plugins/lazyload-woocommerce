=== Lazy Load for WooCommerce ===
Contributors: edgewebware,aibrean
Tags: lazy load, jquery,woocommerce, products, images
Requires at least: 4.0.0
Tested up to: 4.3
Stable tag: 1.1.1
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Lazy Load for WooCommerce includes the functionality to properly append Lazy Load into the image loop for WooCommerce (2.4.4 tested).

== Description ==
Lazy Load for WooCommerce includes the functionality to properly append Lazy Load into the image loop for WooCommerce in product listings (i.e. category). It has been tested against WooCommerce 2.3.8. This does not apply to the individual product image, but anywhere they are used in the loop (by default, the unordered list).

== Installation ==
1. Download the plugin
2. Install the plugin
3. Go to WooCommerce > Settings > Products and click the "Lazy Load" option. 
4. Set your Product width/height for the loop and optionally a custom placeholder image (full src). Your width/height should match your shop_catalog (so they have the right crops).

To note, you will need to have jQuery running for this to work. To reduce conflicts, we have chosen not to include jQuery. To include jQuery, just use the following in your template functions file: `wp_enqueue_script('jquery');`

Additionally, we allow for you to modify the available functions for Lazy Load. To dequeue the plugin functions and use your own, use `wp_dequeue_script('lazyload-call');`. See http://www.appelsiini.net/projects/lazyload for a full rundown of options (trigger loading, effects, images in containers, nonsequential images, invisible images, etc.).

== Screenshots ==
1. Setting up the variable width/height for the products that will be used for LazyLoad (match shop catalog image dimensions).

== Changelog ==
= 1.1.1 =
* Fixed: `$llwoo_image_src` so it would match the shop catalog dimensions. 

= 1.1 = 
* Tested against WP 4.3 RC1
* Tested Against WooCommerce 2.4.4
* Fixed: issue with `call-ll.js` "not a function" error

= 1.0.1 =
* ADDED: Support for placeholder images (url option in settings)
* Adjusted Plugin name (Lazy Load rather than LazyLoad)

= 1.0 =
* Initial version