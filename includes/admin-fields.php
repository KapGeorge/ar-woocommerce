<?php
function ar_plugin_add_custom_fields()
{
    // Begin the custom fields group in the product page
    echo '<div class="options_group">';

    // Field for the 3D model link (URL input)
    woocommerce_wp_text_input([
        'id' => '_text_field',
        'label' => __('3D Model link', 'woocommerce'),
        'placeholder' => 'URL',
        'desc_tip' => 'true',
        'description' => __('Fill URL 3D model for product', 'woocommerce'),
        'type' => 'url', // Specifies that the field expects a URL
    ]);

    // Field for the 3D model poster (URL input)
    woocommerce_wp_text_input([
        'id' => '_text_field_1',
        'label' => __('3D Model poster', 'woocommerce'),
        'placeholder' => 'URL',
        'desc_tip' => 'true',
        'description' => __('Fill URL to poster for product', 'woocommerce'),
        'type' => 'url', // Specifies that the field expects a URL
    ]);

    // Radio buttons for selecting the placement area (Wall or Floor)
    woocommerce_wp_radio([
        'id' => '_radiobutton',
        'label' => __('Placing area', 'woocommerce'),
        'options' => [
            'wall' => 'Wall',
            'floor' => 'Floor',
        ],
        'desc_tip' => 'true',
        'description' => __('Select "Wall" for wall objects.', 'woocommerce'),
    ]);

    // End the custom fields group
    echo '</div>';
}

function ar_plugin_custom_fields_save($post_id)
{
    // Check if the '3D model link' field is set, then sanitize and save it
    if (isset($_POST['_text_field'])) {
        $url = esc_url_raw($_POST['_text_field']); // Clean the URL input to prevent XSS
        update_post_meta($post_id, '_text_field', $url); // Save sanitized URL
    }

    // Check if the '3D model poster' field is set, then sanitize and save it
    if (isset($_POST['_text_field_1'])) {
        $poster_url = esc_url_raw($_POST['_text_field_1']); // Clean the URL input to prevent XSS
        update_post_meta($post_id, '_text_field_1', $poster_url); // Save sanitized URL
    }

    // Check if the radio button field is set, then sanitize and save it
    if (isset($_POST['_radiobutton'])) {
        $radio_value = sanitize_key($_POST['_radiobutton']); // Sanitize the radio button value (it should be a valid key)
        update_post_meta($post_id, '_radiobutton', $radio_value); // Save sanitized value
    }
}

