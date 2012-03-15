/**
 * Manage javascript functions for addthis
 * 
 * @author Adrien Loyant <adrien.loyant@te-laval.fr>
 * 
 * @date 2012-01-01
 * @version 1.0.0
 * @since 1.0.0
 * @copyright GNU Public License v.2
 * 
 * @package extension\ezsharenetwork\design\ezsharenetwork\javascript
 */
(function( $ ) {
    
    /**
     * Intialize addthis
     * 
     * @return void
     */
    function initAddThis() {
        addthis.init();
    }
    
    // After the DOM has loaded...
    jQuery(document).ready(function($) {
        initAddThis();
    });
    
})(jQuery);