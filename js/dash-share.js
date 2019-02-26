/*
 *  jquery-boilerplate - v4.0.0
 *  A jump-start for jQuery plugins development.
 *  http://jqueryboilerplate.com
 *
 *  Made by Zeno Rocha
 *  Under MIT License
 */
// the semi-colon before function invocation is a safety net against concatenated
// scripts and/or other plugins which may not be closed properly.
;( function( $, window, document, undefined ) {

    "use strict";

        // undefined is used here as the undefined global variable in ECMAScript 3 is
        // mutable (ie. it can be changed by someone else). undefined isn't really being
        // passed in so we can ensure the value of it is truly undefined. In ES5, undefined
        // can no longer be modified.

        // window and document are passed through as local variable rather than global
        // as this (slightly) quickens the resolution process and can be more efficiently
        // minified (especially when both are regularly referenced in your plugin).

        // Create the defaults once
        var pluginName = "dashSocialShare",
            defaults = {
                propertyName: ""
            };

        // The actual plugin constructor
        function Plugin ( element, options ) {
            this.element = element;

            // jQuery has an extend method which merges the contents of two or
            // more objects, storing the result in the first object. The first object
            // is generally empty as we don't want to alter the default options for
            // future instances of the plugin
            this.settings = $.extend( {}, defaults, options );
            this._defaults = defaults;
            this._name = pluginName;
            this.init();
            this.attachEvents(this.element, this.settings);
        }

        // Avoid Plugin.prototype conflicts
        $.extend( Plugin.prototype, {
            
            init: function() {

                // Place initialization logic here
                // You already have access to the DOM element and
                // the options via the instance, e.g. this.element
                // and this.settings
                // you can add more functions like the one below and
                // call them like the example bellow

                var html = '';

                html +='<div class="ui-share-options">';
                  html +='<a title="Facebook" class="ui-icon show-hint"><i class="fa fa-facebook"></i></a>';
                  html +='<a title="Twitter" class="ui-icon show-hint"><i class="fa fa-twitter"></i></a>';
                  html +='<a title="Google+" class="ui-icon show-hint"><i class="fa fa-google-plus"></i></a>';
                  html +='<a title="Linkedin" class="ui-icon show-hint"><i class="fa fa-linkedin"></i></a>';
                  html +='<a title="Email" class="ui-icon show-hint"><i class="fa fa-envelope"></i></a>';
                html +='</div>';

                this.yourOtherFunction( html );

            },
            yourOtherFunction: function( text ) {

                // some logic
                $( this.element ).append( text );
            },
            attachEvents: function(el, options) {
                
                var text_value = this.settings.propertyName;

                $(el).on("click", '.ui-icon', function(event){

                    var $target = $(event.currentTarget),
                    currentUrl = encodeURIComponent(window.location.href),
                    title = $target.attr('title') || $target.attr('v-title'),
                    text = encodeURIComponent( text_value ),
                    winOptions = 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600';

                    switch (title) {
                      case 'Facebook':
                        window.open('https://www.facebook.com/sharer/sharer.php?u='+currentUrl+'&t='+text, '', winOptions);
                      break;
                      case 'Twitter':
                        window.open('https://twitter.com/share?text='+text, '', winOptions);
                      break;
                      case 'Google+':
                        window.open('https://plus.google.com/share?url='+currentUrl, '', winOptions);
                      break;
                      case 'Linkedin':
                        window.open('http://www.linkedin.com/shareArticle?mini=true&url='+currentUrl+'&title='+text, '',  winOptions);
                      break;
                      case 'Email':
                        window.location.href='mailto:?body='+text+' '+currentUrl;
                      break;
                    }

                    event.stopPropagation();

                    event.preventDefault();
                     
                 });
             }

        } );

        // A really lightweight plugin wrapper around the constructor,
        // preventing against multiple instantiations
        $.fn[ pluginName ] = function( options ) {
            return this.each( function() {
                if ( !$.data( this, "plugin_" + pluginName ) ) {
                    $.data( this, "plugin_" +
                        pluginName, new Plugin( this, options ) );
                }
            } );
        };

} )( jQuery, window, document );