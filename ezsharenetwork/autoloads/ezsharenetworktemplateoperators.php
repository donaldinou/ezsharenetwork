<?php
namespace extension\ezsharenetwork\autoloads {

    /**
     * @brief Class operator to manage functions in template
     * @details Class operator to manage functions in template
     *
     * @author Adrien Loyant <adrien.loyant@te-laval.fr>
     *
     * @date 2012-01-01
     * @version 1.0.0
     * @since 1.0.0
     * @copyright GNU Public License v.2
     *
     * extension\ezsharenetwork\autoloads
     */
    class eZShareNetworkTemplateOperators {

        /**
         * @brief The operators
         * @details The internal operators template
         *
         * @var array
         */
        protected $Operators;

        /**
         * @brief Return the operators names
         * @details Return the operators names
         *
         * @return array
         */
        public static function operators() {
            return array( 'get_preferred_share_api', 'social_share_enabled' );
        }

        /**
         * @brief Constructor
         * @details The constructor for the operator
         *
         * @return void
         */
        public function __construct() {
            $this->Operators = static::operators();
        }

        /**
         * @brief Return an array with the template operator name.
         * @details Return an array with the template operator name.
         *
         * @return array
         */
        public function operatorList() {
            return $this->Operators;
        }

        /**
         * @brief Return true to tell the template engine that the parameter list exists per operator type
         * @details Return true to tell the template engine that the parameter list exists per operator type,
         * this is needed for operator classes that have multiple operators.
         *
         * @return boolean
         */
        public function namedParameterPerOperator() {
            return true;
        }

        /**
         * @brief Returns an array of named parameters, this allows for easier retrieval of operator parameters.
         * @details Returns an array of named parameters, this allows for easier retrieval of operator parameters.
         * @see \eZTemplateOperator::namedParameterList
         *
         * @return multitype:multitype:multitype:string boolean number  multitype:string boolean
         */
        public function namedParameterList() {
            return array(
                            'get_preferred_share_api' => array(
                                            'fallback_value' => array( 'type' => 'string', 'required' => false, 'default' => 'addthis' )
                            ),
                            'social_share_enabled' => array(
                            )
            );
        }

        /**
         * @brief Executes the PHP function for the operator cleanup and modifies \a $operatorValue
         * @details Executes the PHP function for the operator cleanup and modifies \a $operatorValue
         *
         * @param mixed $tpl
         * @param mixed $operatorName
         * @param mixed $operatorParameters
         * @param mixed $rootNamespace
         * @param mixed $currentNamespace
         * @param mixed $operatorValue This args is passed by reference
         * @param array $namedParameters
         * @param mixed $placement
         *
         * @return void
         */
        public function modify( $tpl, $operatorName, $operatorParameters, $rootNamespace, $currentNamespace, &$operatorValue, array $namedParameters, $placement ) {
            switch ( $operatorName ) {
                case 'get_preferred_share_api':
                    $fallbackValue = null;
                    if (!empty($namedParameters['fallback_value'])) {
                        $fallbackValue = $namedParameters['fallback_value'];
                    }
                    $operatorValue = $this->getPreferredShareAPI($fallbackValue);
                    break;

                case 'social_share_enabled':
                    $operatorValue = $this->socialShareEnabled();
                    break;

                default:
                    // Nothing
                    break;
            }
        }

        /**
         * @brief Get the preferred social share API defined in ezsharenetwork.ini
         * @details Get the preferred social share API defined in ezsharenetwork.ini
         * If there is no social share define in ini file the $fallbackValue is return.
         * By default $fallbackValue is addthis
         *
         * @param string $fallbackValue
         * @return string
         */
        public function getPreferredShareAPI( $fallbackValue='addthis' ) {
            // init vars
            $inieZShare = \eZINI::instance( 'ezsharenetwork.ini' );

            // set preferred library
            $result = $fallbackValue;
            if ( $inieZShare->hasVariable( 'SocialShareNetwork', 'PreferredShareAPI') ) {
                $result = $inieZShare->variable( 'SocialShareNetwork', 'PreferredShareAPI');
            }

            // return value
            return $result;
        }

        /**
         * @brief Return true if displaying social share bar is enabled
         * @details Return true if displaying social share bar is enabled
         *
         * @return boolean
         */
        public function socialShareEnabled() {
            // init vars
            $inieZShare = \eZINI::instance( 'ezsharenetwork.ini' );
            $result = true;

            // get DisplaySocialShare constant
            $displaySocialShare = 'enabled';
            if ( $inieZShare->hasVariable( 'SocialShareNetwork', 'DisplaySocialShare') ) {
                $displaySocialShare = $inieZShare->variable( 'SocialShareNetwork', 'DisplaySocialShare');
            }

            // set the result
            if ( $displaySocialShare == 'disabled' ) {
                $result = false;
            }

            // return value
            return $result;
        }

    }
}
