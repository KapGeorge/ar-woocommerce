<?php
function insert_ar_block()
{
    // Retrieve the custom fields for the AR model, poster, and surface placement
    global $post;
    $ar_model = get_post_meta($post->ID, '_text_field', true); // AR model URL
    $ar_poster = get_post_meta($post->ID, '_text_field_1', true); // AR poster URL
    $ar_surface = get_post_meta($post->ID, '_radiobutton', true); // AR surface placement (wall or floor)

    // If an AR model is set for this product, output the AR block HTML
    if ($ar_model) : ?>
        <div class="ar-holder">
            <!-- The <model-viewer> element is used for displaying the AR model -->
            <model-viewer 
                src="<?php echo esc_url($ar_model); ?>"  
                poster="<?php echo esc_url($ar_poster); ?>"  
                ar 
                ar-modes="webxr scene-viewer quick-look"
                ar-scale="fixed"
                ar-placement="<?php echo esc_attr($ar_surface); ?>"  
                camera-controls
                class="ar-model">
            </model-viewer>
        </div>
    <?php endif; // End of the condition for displaying AR model 
}

function insert_ar_block_scripts()
{
    // Enqueue AR-related scripts only on product pages
    if (is_product()) {
        wp_enqueue_script('ar-scripts', AR_URI . 'js/ar-scripts.js', [], AR_VERSION, true); // Ensure scripts are loaded in footer
    }
}

function insert_ar_block_styles()
{
    // Enqueue AR-related styles only on product pages
    if (is_product()) {
        wp_enqueue_style('ar-styles', AR_URI . 'css/ar-styles.css', [], AR_VERSION); // Load AR styles
    }
}

