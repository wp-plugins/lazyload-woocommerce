/* 
 Function to call LazyLoad. You can unregister this file  by using the following in your THEME functions file:
 wp_dequeue_style('lazyload-call');
 */
$(function () {
    $("img.lazy").show().lazyload({effect: "fadeIn"});
});