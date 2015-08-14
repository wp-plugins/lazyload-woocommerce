/* 
 Function to call LazyLoad. You can unregister this file  by using the following in your THEME functions file:
 wp_dequeue_style('lazyload-call');

 v.1.1
 Fixed: included jQuery using the WP no conflict mode method. 
 */
jQuery(function ($) {
    $("img.lazy").show().lazyload({effect: "fadeIn"});
});