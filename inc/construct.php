<?php



if (!class_exists('DASH_SOCIAL_SHARE_CONSTRUCT')) {

    /**
     * A PostTypeTemplate class
     */
    class DASH_SOCIAL_SHARE_CONSTRUCT
    {

        /**
         * The Constructor
         */
        public function __construct()
        {

            // register actions
            add_action('init', array(&$this, 'init'));
            
        }
        // END public function __construct()

        /**
         * hook into WP's init action hook
         */
        public function init()
        {
            
            $detect = new Mobile_Detect;
            
            if ( !$detect->isMobile() ) {
                add_action('wp_enqueue_scripts', array(&$this, 'plugin_enqueue'));
                add_action( 'wp_footer', array(&$this,'append_to_footer'), 100 );

            }
            
        }
        // END public function init()

        public function plugin_enqueue()
        {
            
            wp_enqueue_style(
                'DASH_SOCIAL_SHARE', 
                plugins_url('/css/dash-share.min.css', dirname(__FILE__)),
                false,
                'all' 
            );

            wp_enqueue_script(
                'DASH_SOCIAL_SHARE', 
                plugins_url('/js/dash-share.js', dirname(__FILE__)),
                array('jquery'), 
                '1.0.0', 
                true
            );

        }

        public function  append_to_footer() { 
            ?>
            <script>
                (function($) {
                    $("body").dashSocialShare({
                        <?php if (get_option('share_message')) echo 'propertyName: "' . get_option('share_message') . '"'; ?>
                    });
                })(jQuery);
            </script>
            <?php
        } 
    }
    // END class DASH_SOCIAL_SHARE_CONSTRUCT
}
// END if(!class_exists('DASH_SOCIAL_SHARE_CONSTRUCT'))
