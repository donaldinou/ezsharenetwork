<?php 
namespace extension\ezsharenetwork\datatypes\ezsharenetwork {
    
    /**
     * 
     * @author aloyant
     *
     */
    class eZShareNetwork {
        
        private $socialBar;
        
        private $buttons;
        
        public function __construct() {
            //;
        }
        
        public function attributes() {
            
        }
        
        public function hasAttribute() {
            
        }
        
        public function attribute( $name ) {
            switch ($name) {
                case 'social_bar':
                    echo 'social_bar';
                break;
                
                default:
                    // Money for nothing;
                break;
            }
        }
        
    }
    
}
?>