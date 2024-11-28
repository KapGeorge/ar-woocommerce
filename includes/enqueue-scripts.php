<?php
function ar_plugin_assets()
{
    wp_enqueue_style('style-plugin', AR_URI . 'css/ar-styles.css', [], AR_VERSION);
    wp_enqueue_script('ar-modelviewer', AR_URI . 'js/model-viewer.min.js', ['jquery'], null, true);
    wp_enqueue_script('ar-dependencies', AR_URI . 'js/dependencies.js', ['jquery'], null, true);
    wp_enqueue_script('ar-focus-visible', AR_URI . 'js/focus-visible.js', ['jquery'], null, false);
}