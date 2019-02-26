<?php

/*
Plugin Name: Dash Social Share
Plugin URI: 
Description: Add social share links on every page.
Version: 1.1.1
Author: Marcel Badua
Author URI: http://marcelbadua.com/
License: GPL2
*/

/*
Copyright 2017  Marcel Badua  (email : bitterdash@gmail.com)

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License, version 2, as
published by the Free Software Foundation.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

require_once 'libs/Mobile_Detect.php';
require_once 'libs/updater.php';

if (!class_exists('DASH_SOCIAL_SHARE')) {
    class DASH_SOCIAL_SHARE
    {
        /**
         * Construct the plugin object
         */
        public function __construct() {
            
            if (is_admin()) { // note the use of is_admin() to double check that this is happening in the admin
        		$config = array(
        			'slug' => plugin_basename(__FILE__), // this is the slug of your plugin
        			'proper_folder_name' => 'dash-social-share', // this is the name of the folder your plugin lives in
        			'api_url' => 'https://api.github.com/repos/marcelbadua/dash-social-share', // the GitHub API url of your GitHub repo
        			'raw_url' => 'https://raw.github.com/marcelbadua/dash-social-share/master', // the GitHub raw url of your GitHub repo
        			'github_url' => 'https://github.com/marcelbadua/dash-social-share', // the GitHub url of your GitHub repo
        			'zip_url' => 'https://github.com/marcelbadua/dash-social-share/zipball/master', // the zip url of the GitHub repo
        			'sslverify' => true, // whether WP should check the validity of the SSL cert when getting an update, see https://github.com/jkudish/WordPress-GitHub-Plugin-Updater/issues/2 and https://github.com/jkudish/WordPress-GitHub-Plugin-Updater/issues/4 for details
        			'requires' => '3.0', // which version of WordPress does your plugin require?
        			'tested' => '3.3', // which version of WordPress is your plugin tested up to?
        			'readme' => 'README.md', // which file to use as the readme for the version number
        			'access_token' => '', // Access private repositories by authorizing under Appearance > GitHub Updates when this example plugin is installed
        		);
        		new WP_GitHub_Updater($config);
        	}
            // Initialize Settings
            require_once(sprintf("%s/settings.php", dirname(__FILE__)));
            $DASH_SOCIAL_SHARE_SETTINGS = new DASH_SOCIAL_SHARE_SETTINGS();

            require_once( sprintf("%s/inc/construct.php", dirname(__FILE__)) );
            $DASH_SOCIAL_SHARE_CONSTRUCT = new DASH_SOCIAL_SHARE_CONSTRUCT();


        } // END public function __construct

        /**
         * Activate the plugin
         */
        public static function activate() {
            // Do nothing
        } // END public static function activate
        
        /**
         * Deactivate the plugin
         */
        public static function deactivate() {
            // Do nothing
        }// END public static function deactivate

    } // END class DASH_SOCIAL_SHARE
} // END if(!class_exists('DASH_SOCIAL_SHARE'))

if (class_exists('DASH_SOCIAL_SHARE')) {
    // Installation and uninstallation hooks
    register_activation_hook(__FILE__, array('DASH_SOCIAL_SHARE','activate'));
    register_deactivation_hook(__FILE__, array( 'DASH_SOCIAL_SHARE', 'deactivate'));
    // instantiate the plugin class
    $DASH_SOCIAL_SHARE = new DASH_SOCIAL_SHARE();
}
