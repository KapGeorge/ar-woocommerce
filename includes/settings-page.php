<?php
class OptionsPage
{
    public function __construct()
    {
        // Hook to add admin menu and settings
        add_action('admin_menu', [$this, 'add']);
        add_action('admin_init', [$this, 'settings']);
    }

    // Function to add the custom menu page in the admin panel
    public function add()
    {
        add_menu_page(
            'AR Products', // Page title
            'AR Products', // Menu title
            'manage_options', // Capability required
            'ar-products', // Menu slug
            [$this, 'display'], // Callback function to display the page
            'dashicons-images-alt2', // Icon for the menu item
            20 // Position of the menu item
        );
    }

    // Function to register settings for the options page
    public function settings()
    {
        // Register a setting group and a setting for storing the WooCommerce hook
        register_setting('ar_products_settings', 'simple_wooc', [
            'sanitize_callback' => [$this, 'sanitize_input'], // Use a custom sanitization function
        ]);
    }

    // Function to sanitize the input before saving it to the database
    public function sanitize_input($input)
    {
        // Use sanitize_text_field to remove unwanted characters and ensure the input is safe
        return sanitize_text_field($input);
    }

    // Function to display the options page content
    public function display()
    {
        ?>
        <div class="wrap">
            <h1><?php esc_html_e('AR Products Settings', 'ar-plugin'); ?></h1>
            <form method="post" action="options.php">
                <?php
                // Output the necessary hidden fields for settings
                settings_fields('ar_products_settings'); 
                do_settings_sections('ar_products_settings'); 
                ?>
                <table class="form-table">
                    <tr valign="top">
                        <th scope="row"><?php esc_html_e('WooCommerce Hook:', 'ar-plugin'); ?></th>
                        <td>
                            <!-- Securely output the current WooCommerce hook setting -->
                            <input type="text" name="simple_wooc" value="<?php echo esc_attr(get_option('simple_wooc')); ?>">
                        </td>
                    </tr>
                </table>
                <?php submit_button(); // Render the submit button ?>
            </form>
        </div>
        <?php
    }
}

// Instantiate the OptionsPage class to hook into WordPress
new OptionsPage();
