<?php
/**
 * WP Publications Settings Page
 */

// Create admin menu item for settings
function wpap_add_settings_page() {
    add_submenu_page(
        'edit.php?post_type=publication',
        'Publications Style Settings',
        'Style Settings',
        'manage_options',
        'wpap-settings',
        'wpap_settings_page_callback'
    );
}
add_action('admin_menu', 'wpap_add_settings_page');

// Enqueue color picker
function wpap_admin_scripts($hook) {
    if ('publication_page_wpap-settings' !== $hook) {
        return;
    }
    wp_enqueue_style('wp-color-picker');
    wp_enqueue_script('wp-color-picker');
    wp_enqueue_script('wpap-settings-js', plugins_url('/js/settings.js', __FILE__), array('wp-color-picker'), false, true);
}
add_action('admin_enqueue_scripts', 'wpap_admin_scripts');

// Register settings
function wpap_register_settings() {
    register_setting('wpap_settings_group', 'wpap_button_color');
    register_setting('wpap_settings_group', 'wpap_button_hover_color');
    register_setting('wpap_settings_group', 'wpap_button_text_color');
}
add_action('admin_init', 'wpap_register_settings');

// Settings page callback
function wpap_settings_page_callback() {
    $button_color = get_option('wpap_button_color', '#0073aa');
    $button_hover_color = get_option('wpap_button_hover_color', '#006799');
    $button_text_color = get_option('wpap_button_text_color', '#ffffff');
    ?>
    <div class="wrap">
        <h1>Publications Style Settings</h1>
        
        <form method="post" action="options.php">
            <?php settings_fields('wpap_settings_group'); ?>
            <?php do_settings_sections('wpap_settings_group'); ?>
            
            <table class="form-table">
                <tr valign="top">
                    <th scope="row">Button Color</th>
                    <td>
                        <input type="text" name="wpap_button_color" value="<?php echo esc_attr($button_color); ?>" class="wpap-color-picker" />
                        <p class="description">Primary color for buttons in the publication display</p>
                    </td>
                </tr>
                
                <tr valign="top">
                    <th scope="row">Button Hover Color</th>
                    <td>
                        <input type="text" name="wpap_button_hover_color" value="<?php echo esc_attr($button_hover_color); ?>" class="wpap-color-picker" />
                        <p class="description">Color when hovering over buttons</p>
                    </td>
                </tr>
                
                <tr valign="top">
                    <th scope="row">Button Text Color</th>
                    <td>
                        <input type="text" name="wpap_button_text_color" value="<?php echo esc_attr($button_text_color); ?>" class="wpap-color-picker" />
                        <p class="description">Color of the text on buttons</p>
                    </td>
                </tr>
            </table>
            
            <?php submit_button(); ?>
        </form>
    </div>
    <?php
}

// Output custom CSS with color variables
function wpap_add_custom_button_colors() {
    $button_color = get_option('wpap_button_color', '#0073aa');
    $button_hover_color = get_option('wpap_button_hover_color', '#006799');
    $button_text_color = get_option('wpap_button_text_color', '#ffffff');
    
    echo '<style>
        :root {
            --wpap-button-color: ' . esc_attr($button_color) . ';
            --wpap-button-hover-color: ' . esc_attr($button_hover_color) . ';
            --wpap-button-text-color: ' . esc_attr($button_text_color) . ';
        }
    </style>';
}
add_action('wp_head', 'wpap_add_custom_button_colors');
add_action('admin_head', 'wpap_add_custom_button_colors');