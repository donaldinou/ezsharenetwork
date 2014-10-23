<?php
namespace extension\ezsharenetwork\autoloads {

    use extension\ezsharenetwork\classes\enums\addThisConfigEnum;
    use extension\ezextrafeatures\classes\helpers\iniHelper;

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
     * @note The multiplicity of operators are not needed or necessary but it can be usefull when default template is overrided
     *
     * extension\ezsharenetwork\autoloads
     */
    class eZAddThisTemplateOperators {

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
            return array(
                            'get_addthis_config',
                            'get_addthis_share',
                            'get_addthis_localize',
                            'get_addthis_location',
                            'get_addthis_api',
                            'ezscript_addthis_location',
                            'ezscript_addthis_config',
                            'ezscript_addthis_share',
                            'ezscript_addthis_localize',
                            'ezscript_addthis_api',
            );
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
                            'get_addthis_config' => array(
                            ),
                            'get_addthis_share' => array(
                            ),
                            'get_addthis_localize' => array(
                            ),
                            'get_addthis_location' => array(
                                            'params' => array( 'type' => 'boolean', 'required' => false, 'default' => true )
                            ),
                            'get_addthis_api' => array(
                                            'type' => array( 'type' => 'integer', 'required' => false, 'default' => addThisConfigEnum::ALL )
                            ),
                            'ezscript_addthis_config' => array(
                            ),
                            'ezscript_addthis_share' => array(
                            ),
                            'ezscript_addthis_localize' => array(
                            ),
                            'ezscript_addthis_location' => array(
                                            'params' => array( 'type' => 'boolean', 'required' => false, 'default' => true )
                            ),
                            'ezscript_addthis_api' => array(
                                            'type' => array( 'type' => 'integer', 'required' => false, 'default' => addThisConfigEnum::ALL )
                            ),
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
                case 'get_addthis_api':
                    $type = addThisConfigEnum::ALL;
                    if (isset($namedParameters['type']) && is_int($namedParameters['type'])) {
                        $type = $namedParameters['type'];
                    }
                    $operatorValue = $this->getAddThisAPI( $type );
                    break;

                case 'get_addthis_config':
                    $operatorValue = $this->getAddThisConfig();
                    break;

                case 'get_addthis_share':
                    $operatorValue = $this->getAddThisShare();
                    break;

                case 'get_addthis_localize':
                    $operatorValue = $this->getAddThisLocalize();
                    break;

                case 'get_addthis_location':
                    $params = true;
                    if (isset($namedParameters['params']) && is_bool($namedParameters['params'])) {
                        $params = $namedParameters['params'];
                    }
                    $operatorValue = $this->getAddThisLocation( $params );
                    break;

                case 'ezscript_addthis_api':
                    $type = addThisConfigEnum::ALL;
                    if (isset($namedParameters['type']) && is_int($namedParameters['type'])) {
                        $type = $namedParameters['type'];
                    }
                    $operatorValue = $this->eZScriptAddThisAPI( $type );
                    break;

                case 'ezscript_addthis_config':
                    $operatorValue = $this->eZScriptAddThisConfig();
                    break;

                case 'ezscript_addthis_share':
                    $operatorValue = $this->eZScriptAddThisShare();
                    break;

                case 'ezscript_addthis_localize':
                    $operatorValue = $this->eZScriptAddThisLocalize();
                    break;

                case 'ezscript_addthis_location':
                    $params = true;
                    if (isset($namedParameters['params']) && is_bool($namedParameters['params'])) {
                        $params = $namedParameters['params'];
                    }
                    $operatorValue = $this->eZScriptAddThisLocation( $params );
                    break;

                default:
                    // Nothing
                    break;
            }
        }

        /**
         * @brief Return the specified variable as json
         * @details Return the specified variable as json
         *
         * @param addThisConfigEnum $type
         * @return string
         *
         */
        public function getAddThisAPI( $type=addThisConfigEnum::ALL ) {
            $result = json_encode(array());
            switch ($type) {
                case addThisConfigEnum::ALL:
                    $result = iniHelper::INItoJSON( 'addthis.ini', array( 'addthis_config', 'addthis_share', 'addthis_localize' ) );
                    break;

                case addThisConfigEnum::CONFIG:
                    $result = iniHelper::INItoJSON( 'addthis.ini', 'addthis_config' );
                    break;

                case addThisConfigEnum::SHARE:
                    $result = iniHelper::INItoJSON( 'addthis.ini', 'addthis_share' );
                    break;

                case addThisConfigEnum::LOCALIZATION:
                    $result = iniHelper::INItoJSON( 'addthis.ini', 'addthis_localize' );
                    break;

                default:
                    $result = iniHelper::INItoJSON( 'addthis.ini', array( 'addthis_config', 'addthis_share', 'addthis_localize' ) );
                    break;
            }
            return $result;
        }

        /**
         * @brief Return the addthis_config variable as json
         * @details Return the addthis_config variable as json
         *
         * @return string
         */
        public function getAddThisConfig() {
            return static::getAddThisAPI( addThisConfigEnum::CONFIG );
        }

        /**
         * @brief Return the addthis_share variable as json
         * @details Return the addthis_share variable as json
         *
         * @return string
         */
        public function getAddThisShare() {
            return static::getAddThisAPI( addThisConfigEnum::SHARE );
        }

        /**
         * @brief Return the addthis_localize variable as json
         * @details Return the addthis_localize variable as json
         *
         * @return string
         */
        public function getAddThisLocalize() {
            return static::getAddThisAPI( addThisConfigEnum::LOCALIZATION );
        }

        /**
         * @brief Return the location of the addthis library with or without params
         * @details Return the location of the addthis library with or without params
         *
         * @param boolean $params
         * @return string|boolean false if there is no location defined
         */
        public function getAddThisLocation( $params=true ) {
            $iniAddThis = \eZINI::instance( 'addthis.ini' );
            $result = false;

            if ($iniAddThis->hasVariable('Configuration', 'LibraryURI')) {
                $result = $iniAddThis->variable('Configuration', 'LibraryURI');
                if ($params) {
                    $result .= ($iniAddThis->hasVariable('Configuration', 'PublisherId') && $iniAddThis->variable('Configuration', 'PublisherId') != '') ? '#pubid='.$iniAddThis->variable('Configuration', 'PublishedId') : '';
                    $result .= ($iniAddThis->hasVariable('Configuration', 'OnDomReady') && $iniAddThis->variable('Configuration', 'OnDomReady') === 'enabled') ? '#domready=1' : '';
                    $result .= ($iniAddThis->hasVariable('Configuration', 'AsynchronousLoading') && $iniAddThis->variable('Configuration', 'AsynchronousLoading') === 'enabled') ? '#async=1' : '';
                }
            }

            return $result;
        }

        /**
         * @brief Return the specified variable as json enclose with the javascript tag
         * @details Return the specified variable as json enclose with the javascript tag
         *
         * @param addThisConfigEnum $type
         * @return string
         *
         */
        public function eZScriptAddThisAPI( $type=addThisConfigEnum::ALL ) {
            return $this->encloseScript($this->getAddThisAPI($type));
        }

        /**
         * @brief Return the addthis_config as json enclose with the javascript tag
         * @details Return the addthis_config as json enclose with the javascript tag
         *
         * @return string
         */
        public function eZScriptAddThisConfig() {
            return $this->encloseScript('var addthis_config = '. $this->getAddThisConfig());
        }

        /**
         * @brief Return the addthis_share as json enclose with the javascript tag
         * @details Return the addthis_share as json enclose with the javascript tag
         *
         * @return string
         */
        public function eZScriptAddThisShare() {
            return $this->encloseScript('var addthis_share = '. $this->getAddThisShare());
        }

        /**
         * @brief Return the addthis_localize as json enclose with the javascript tag
         * @details Return the addthis_localize as json enclose with the javascript tag
         * only if custom localization is activated; Else return false
         *
         * @return string
         */
        public function eZScriptAddThisLocalize() {
            $result = false;
            $iniAddThis = \eZINI::instance('addthis');

            // get custom localization
            $customLocalization = 'disabled';
            if ( $iniAddThis->hasVariable('Configuration', 'CustomLocalization') ) {
                $customLocalization = $iniAddThis->variable('Configuration', 'CustomLocalization');
            }

            // set localization if needed
            if ($customLocalization === 'enabled') {
                $result = $this->encloseScript('var addthis_localize = '. $this->getAddThisLocalize());
            }

            return $result;
        }

        /**
         * @brief Return the location of the addthis library with or without params enclosed in a html tag
         * @details Return the location of the addthis library with or without params enclosed in a html tag
         *
         * @note We cannot use \ezjscPacker because it's an external library
         *
         * @param boolean $params
         * @return string
         */
        public function eZScriptAddThisLocation( $params=true ) {
            return '<script type="text/javascript" src="'.$this->getAddThisLocation( $params ).'"></script>';
        }

        /**
         * @brief Return the specified script encosed in the javascript html tag
         * @details Return the specified script encosed in the javascript html tag
         *
         * @param string $script
         * @return string
         */
        private function encloseScript( $script ) {
            return '<script type="text/javascript">'.$script.'</script><noscript></noscript>';
        }

    }
}
