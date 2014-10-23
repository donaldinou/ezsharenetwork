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
            $this->socialBar = null;
            $this->buttons = null;
        }

        public function attributes() {

        }

        public function hasAttribute() {

        }

        public function attribute( $name ) {
            switch ($name) {
                case 'social_bar':
                    return $this->socialBar;
                break;

                case 'buttons':
                    return $this->buttons;
                break;

                default:
                    // Money for nothing;
                break;
            }
        }

    }

}
