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
YUI( YUI3_config ).use('node', 'event', 'io-ez', function( Y ) {
    
    /**
     * Intialize addthis
     * 
     * @return void
     */
    function initAddThis() {
        addthis.init();
    }
    
    /**
     * 
     */
    Y.on( 'domready', function( e ) {
        initAddThis();
    }
    
}