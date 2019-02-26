<?php
if(!class_exists('DASH_SOCIAL_SHARE_SETTINGS'))
{
	class DASH_SOCIAL_SHARE_SETTINGS
	{
		/**
		 * Construct the plugin object
		 */
		public function __construct()
		{
			// register actions
            add_action('admin_init', array(&$this, 'admin_init'));
        	add_action('admin_menu', array(&$this, 'add_menu'));
		} // END public function __construct
		
        /**
         * hook into WP's admin_init action hook
         */
        public function admin_init()
        {
        	// register your plugin's settings
        	register_setting('dash_social_share-group', 'share_message');
        	// add your settings section
        	add_settings_section(
        	    'dash_social_share-section', 
        	    'Dash Share Settings', 
        	    array(&$this, 'settings_section_dash_social_share'), 
        	    'dash_social_share'
        	);
        	
        	// add your setting's fields
            add_settings_field(
                'dash_social_share-share_message', 
                'Share Message', 
                array(&$this, 'settings_field_input_textarea'), 
                'dash_social_share', 
                'dash_social_share-section',
                array(
                    'field' => 'share_message'
                )
            );
            // Possibly do additional admin_init tasks
        } // END public static function activate
        
        public function settings_section_dash_social_share()
        {
            // Think of this as help text for the section.
            echo 'These settings do things for the Dash Social Share.';
        }
        
        /**
         * This function provides textarea inputs for settings fields
         */
        public function settings_field_input_textarea($args)
        {
            // Get the field name from the $args array
            $field = $args['field'];
            // Get the value of this setting
            $value = get_option($field);
            // echo a proper input type="text"
            //echo sprintf('<input type="text" name="%s" id="%s" value="%s" />', $field, $field, $value);
            echo sprintf('<textarea rows="4" cols="50" type="text" name="%s" id="%s"/>%s</textarea>', $field, $field, $value);
        } // END public function settings_field_input_text($args)
        
        /**
         * This function provides text inputs for settings fields
         */
        public function settings_field_input_text($args)
        {
            // Get the field name from the $args array
            $field = $args['field'];
            // Get the value of this setting
            $value = get_option($field);
            // echo a proper input type="text"
            echo sprintf('<input type="text" name="%s" id="%s" value="%s" />', $field, $field, $value);
        } // END public function settings_field_input_text($args)
        
        /**
         * add a menu
         */		
        public function add_menu()
        {
            // Add a page to manage this plugin's settings
        	add_options_page(
        	    'Dash Social Share Settings', 
        	    'Dash Social Share', 
        	    'manage_options', 
        	    'dash_social_share', 
        	    array(&$this, 'plugin_settings_page')
        	);
        } // END public function add_menu()
    
        /**
         * Menu Callback
         */		
        public function plugin_settings_page()
        {
        	if(!current_user_can('manage_options'))
        	{
        		wp_die(__('You do not have sufficient permissions to access this page.'));
        	}
	
        	// Render the settings template
        	include(sprintf("%s/tpl/settings.php", dirname(__FILE__)));
        } // END public function plugin_settings_page()
    } // END class DASH_SOCIAL_SHARE_SETTINGS
} // END if(!class_exists('DASH_SOCIAL_SHARE_SETTINGS'))