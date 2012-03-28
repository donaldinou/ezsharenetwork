<?php
namespace extension\ezsharenetwork\datatypes\ezsharenetwork {
    
    /**
     * @brief eZShareNetwork DataType
     * @details eZShareNetwork DataType. Add a social bar type to an eZPublish object.
     * 
     * @author Adrien Loyant <adrien.loyant@te-laval.fr>
     * 
     * @date 2012-01-01
     * @version 1.0.0
     * @since 1.0.0
	 * @copyright GNU Public License v.2
     * 
     * @package extension\ezsharenetwork\datatypes\ezsharenetwork
     */
    use extension\ezextrafeatures\classes\enums\datatypeEnum;

    use extension\ezextrafeatures\classes\helpers\dataTypeValidatorHelper;

    class eZShareNetworkType extends \eZDataType {
        
        /**
         * @brief Datatype identifier
         * @details Datatype identifier
         * 
         * @var string
         */
        const DATA_TYPE_STRING = 'ezsharenetwork';
        
        /**
         * @brief Constructor
         * @details Constructor
         * 
         * @return void
         */
        public function __construct() {
            $properties = array( 'translation_allowed' => true, 'serialize_supported' => false, 'object_serialize_map' => false );
            
            parent::eZDataType( static::DATA_TYPE_STRING, 
                                \ezpI18n::tr('design/ezsharenetwork/datatype', 'Social Network Bar'),
                                $properties
            );
        }
        
        /**
         * @brief Return the class definition
         * @details Return the class definition (When we editing the class object in BO)
         * 
         * @return array
         */
        public static function definition() {
            $matchingFields = array(
                            'maxButtonsDisplayed' => array(
                                            'name' => 'maxbuttonsdisplayed',
                                            'field' => 'data_int1',
                                            'type' => 'integer',
                                            'min_range' => 0,
                                            'max_range' => 10,
                                            'default' => 5 )
            );
            return $matchingFields;
        }
        
        /**
         * @brief Return the object definition
         * @details Return the object definition (When user editing an object)
         * 
         * @return array
         */
        public static function objectDefinition()  {
            $matchingFields = array(
                            'hasSpecificSocialBar' => array(
                                            'name' => 'hasspecificsocialbar',
                                            'field' => 'data_int',
                                            'type' => 'boolean',
                                            'default' => false ),
                            'socialBar' => array(
                                            'name' => 'socialbar',
                                            'field' => 'data_text',
                                            'type' => 'array',
                                            'default' => array()
                                            ),
                            'buttons' => array(
                                            'name' => 'buttons',
                                            'field' => 'data_text',
                                            'type' => 'array',
                                            'default' => array()
                                            )
            );
            return $matchingFields;
        }
        
        /**
         * @brief Initializes the class attribute with some data.
         * @details Sets default values for a new class attribute.
         * 
         * @note the parameter is not typed because of parent
         * 
         * @param eZContentClassAttribute $classAttribute 
         * @return void
         * 
         * @see \eZDataType::initializeClassAttribute()
         */
        public function initializeClassAttribute( $classAttribute ) {
            if ($classAttribute instanceof \eZContentClassAttribute) {
                foreach (static::definition() as $name => $option) {
                    if ( $classAttribute->hasAttribute( $option['field'] ) ) {
                        $classAttribute->setAttribute( $option['field'], $option['default'] );
                    }
                }
            } else {
                // TODO throw custom exception
            }
        }
        
        /**
         * @brief Validates the input from the class definition form concerning this attribute.
         * @details Validates the input from the class definition form concerning this attribute.
         * 
         * @param \eZHTTPTool $http
         * @param string $base Seems to be always 'ContentClassAttribute'.
         * @param \eZContentClassAttribute $classAttribute
         * 
         * @return int eZInputValidator::STATE_ACCEPTED|eZInputValidator::STATE_INVALID|eZInputValidator::STATE_INTERMEDIATE
         * 
         * @see \eZDataType::validateClassAttributeHTTPInput()
         */
        public function validateClassAttributeHTTPInput($http, $base, $classAttribute) {
            if ( !($http instanceof \eZHTTPTool) ) {
                // TODO throw custom exception
            }
            elseif ( !($classAttribute instanceof \eZContentClassAttribute) ) {
                // TODO throw custom exception
            }
            else {
                $result = \eZInputValidator::STATE_ACCEPTED;
                $definition = self::definition();
                
                foreach (static::definition() as $name => $options) {
                    $attribute_name = $base . '_' . self::DATA_TYPE_STRING . '_' . $option['name'] . '_' . $classAttribute->attribute('id');
                    if ($http->hasPostVariable($attribute_name)) {
                        $result = dataTypeValidatorHelper::validateClassField($http->postVariable($attribute_name), $options['type'], $options);
                    }
                }
                
                // Everything is fine
                if ($result == \eZInputValidator::STATE_ACCEPTED) {
                    // FIXME : put here code needed if some fields depend to another
                }
            }
            
            return $result;
        }
        
        /**
         * @brief Fixes up the data that has been posted with the class edit form.
         * @details Fixes up the data that has been posted with the class edit form.
         * This method is called only if validation method (self::validateClassAttributeHTTPInput()) returned eZInputValidator::STATE_INTERMEDIATE
         * 
         * @param eZHTTPTool $http
         * @param string $base POST variable name prefix (Always "ContentObjectAttribute")
         * @param eZContentObjectAttribute $contentObjectAttribute
         * 
         * @return null
         * 
         * @see \eZDataType::fixupClassAttributeHTTPInput()
         */
        public function fixupClassAttributeHTTPInput($http, $base, $classAttribute) {
            if ( !($http instanceof \eZHTTPTool) ) {
                // TODO throw custom exception
            }
            elseif ( !($classAttribute instanceof \eZContentClassAttribute) ) {
                // TODO throw custom exception
            }
            else {
                // TODO : if STATE_INTERMEDIATE
                //$http->setPostVariable( $socialBar_attr, 'addthis' );
                
            }
            return null;
        }
        
        /**
         * @brief Handles the input specific for one attribute from the class edit interface.
         * @details Handles the input specific for one attribute from the class edit interface.
         * 
         * @param eZHTTPTool $http
         * @param string $base Seems to be always 'ContentClassAttribute'.
         * @param eZContentClassAttribute $classAttribute
         * 
         * @return void
         * 
         * @see \eZDataType::fetchClassAttributeHTTPInput()
         */
        public function fetchClassAttributeHTTPInput($http, $base, $classAttribute) {
            if ( !($http instanceof \eZHTTPTool) ) {
                // TODO throw custom exception
            }
            elseif ( !($classAttribute instanceof \eZContentClassAttribute) ) {
                // TODO throw custom exception
            }
            else {
                foreach (static::definition() as $name => $option) {
                    $attribute_name = $base . '_' . self::DATA_TYPE_STRING . '_' . $option['name'] . '_' . $classAttribute->attribute('id');
                    if ($http->hasPostVariable($attribute_name)) {
                        $value = $http->postVariable($attribute_name);
                        if ($classAttribute->hasAttribute($option['name'])) {
                            if (is_array($value)) {
                                $value = serialize($value);
                            }
                            $classAttribute->setAttribute($option['field'], $value);
                        }
                    }
                }
            }
        }
        
        /**
         * @brief Initializes object attribute before displaying edit template
         * @details Initializes object attribute before displaying edit template
         * Can be useful to define default values. Default values can be defined in class attributes
         * 
         * @param \eZContentObjectAttribute $contentObjectAttribute Object attribute for the new version
         * @param int $currentVersion Version number. NULL if this is the first version
         * @param \eZContentObjectAttribute $originalContentObjectAttribute Object attribute of the previous version
         * 
         * @return void
         * 
         * @see eZDataType::initializeObjectAttribute()
         */
        public function initializeObjectAttribute($objectAttribute, $currentVersion, $originalContentObjectAttribute) {
            if ( !($objectAttribute instanceof \eZContentObjectAttribute) ) {
                // TODO throw custom error
            }
            elseif ( !($originalContentObjectAttribute instanceof \eZContentObjectAttribute) ) {
                // TODO throw custom error
            }
            else {
                if ( is_null($currentVersion) ) { // set defaults values on first version
                    $contentClassAttribute = $objectAttribute->contentClassAttribute();
                    $hasSpecificSocialBar = $contentClassAttribute->attribute( $this->matchingFields['hasSpecificSocialBar']['field'] );
                    $objectAttribute->setAttribute($this->matchingFields['hasSpecificSocialBar']['field'], $hasSpecificSocialBar);
                } else {
                    $id = $originalContentObjectAttribute->attribute( 'data_text' );
                    $contentObjectAttribute->setAttribute( 'data_text', $id );
                    $contentObjectAttribute->store();
                }
            }
        }
        
        /**
         * @brief Validates input on content object level
         * @details Validates input on content object level.
         * Check if data posted by a user is valid
         * 
         * @param \eZHTTPTool $http
         * @param string $base POST variable name prefix (Always "ContentObjectAttribute")
         * @param \eZContentObjectAttribute $contentObjectAttribute
         * 
         * @return eZInputValidator::STATE_ACCEPTED|eZInputValidator::STATE_INVALID|eZInputValidator::STATE_INTERMEDIATE
         * 
         * @see eZDataType::validateObjectAttributeHTTPInput()
         */
        public function validateObjectAttributeHTTPInput($http, $base, $objectAttribute) {
            if ( !($http instanceof \eZHTTPTool) ) {
                // TODO throw custom exception
            }
            elseif ( !($objectAttribute instanceof \eZContentObjectAttribute) ) {
                // TODO throw custom exception
            }
            else {
                $result = \eZInputValidator::STATE_ACCEPTED;
                
                foreach (static::objectDefinition() as $name => $option) {
                    $attribute_name = $base . '_' . self::DATA_TYPE_STRING . '_' . $option['name'] . '_' . $option['field'] . '_' . $classAttribute->attribute('id');
                    if ($http->hasPostVariable($attribute_name)) {
                        $value = $http->postVariable($attribute_name);
                        // TODO switch
                        $result = \eZInputValidator::STATE_ACCEPTED;
                    }
                    
                    //$error = 'general error'; // TODO translate
                    $objectAttribute->setValidationError( $error );
                }
            }
            return $result;
        }
        
        /**
         * @brief Fixes up the data that has been posted with the object edit form
         * @details Fixes up the data that has been posted with the object edit form.
         * This method is called only if validation method (self::validateObjectAttributeHTTPInput()) returned eZInputValidator::STATE_INTERMEDIATE
         * 
         * @param \eZHTTPTool $http
         * @param string $base
         * @param eZContentObjectAttribute $objectAttribute
         * 
         * @return null
         * 
         * @see eZDataType::fixupObjectAttributeHTTPInput()
         */
        public function fixupObjectAttributeHTTPInput($http, $base, $objectAttribute) {
            if ( !($http instanceof \eZHTTPTool) ) {
                // TODO throw custom exception
            }
            elseif ( !($classAttribute instanceof \eZContentObjectAttribute) ) {
                // TODO throw custom exception
            }
            else {
                // Nothing
            }
            return null;
        }
        
        /**
         * @brief Fetches all variables from the object and handles them
         * @details Fetches all variables from the object and handles them Data store can be done here
         * 
         * @param \eZHTTPTool $http
         * @param string $base POST variable name prefix (Always "ContentObjectAttribute")
         * @param \eZContentObjectAttribute $contentObjectAttribute
         * 
         * @return true if fetching of object attributes is successful, false if not
         * 
         * @see eZDataType::fetchObjectAttributeHTTPInput()
         */
        public function fetchObjectAttributeHTTPInput($http, $base, $objectAttribute) {
            if ( !($http instanceof \eZHTTPTool) ) {
                // TODO throw custom exception
            }
            elseif ( !($classAttribute instanceof \eZContentObjectAttribute) ) {
                // TODO throw custom exception
            }
            else {
                $result = false;
                
                foreach (static::objectDefinition() as $name => $option) {
                    $attribute_name = $base . '_' . self::DATA_TYPE_STRING . '_' . $option['name'] . '_' . $option['field'] . '_' . $classAttribute->attribute('id');
                    if ($http->hasPostVariable($attribute_name)) {
                        $value = $http->postVariable($attribute_name);
                        // TODO
                        //$objectAttribute->setAttribute($option['field'], $value);
                    }
                }
                
                $result = true;
            }
            return $result;
        }
        
        /**
         * @brief Performs necessary actions with attribute data after object is published.
         * @details Performs necessary actions with attribute data after object is published.
         * Returns true if the value was stored correctly
         * 
         * @param \eZContentObjectAttribute $contentObjectAttribute
         * @param \eZContentObject $contentObject The published object
         * @param array $publishedNodes
         * 
         * @return boolean
         * 
         * @see eZDataType::onPublish()
         */
        public function onPublish($contentObjectAttribute, $contentObject, $publishedNodes) {
            if ( !($contentObjectAttribute instanceof \eZContentObjectAttribute) ) {
                // TODO throw custom exception
            }
            elseif ( !($contentObject instanceof \eZContentObject) ) {
                // TODO throw custom exception
            }
            else {
                return true;
            }
        }
        
        /**
         * @brief Returns the content for the class attribute
         * @details Returns the content for the class attribute.
         * This is used by templates for the datatype
         * 
         * @param eZContentClassAttribute $classAttribute
         * @return array
         * 
         * @see \eZDataType::classAttributeContent()
         */
        public function classAttributeContent($classAttribute) {
            if ( !($classAttribute instanceof \eZContentClassAttribute) ) {
                // TODO throw custom exceptions
            }
            else {
                $result = array();
                foreach (self::definition() as $options) {
                    if ($classAttribute->hasAttribute($options['field'])) {
                        $result[$option['name']] = dataTypeValidatorHelper::convertObjectField($classAttribute->attribute($options['field']), $options['type']);
                    }
                }
            }
            return $result;
        }
        
        /**
         * @brief Return true if the datatype is indexable
         * @details Return true if the datatype is indexable
         * 
         * @return boolean
         * @see \eZDataType::isIndexable()
         */
        public function isIndexable() {
            return false;
        }
        
        /**
         * @brief Return true if the datatype can be used as an information collector
         * @details Return true if the datatype can be used as an information collector
         * 
         * @return boolean
         * @see \eZDataType::isInformationCollector()
         */
        public function isInformationCollector() {
            return false;
        }
        
        /**
         * @brief Return true if the datatype requires validation during add to basket procedure
         * @details Return true if the datatype requires validation during add to basket procedure
         * 
         * @return boolean
         * @see \eZDataType::isAddToBasketValidationRequired()
         */
        public function isAddToBasketValidationRequired() {
            return false;
        }
        
        /**
         * @brief Checks if current content object attribute has content
         * @details Checks if current content object attribute has content
         * Returns true if it has content
         * 
         * @param eZContentObjectAttribute $contentObjectAttribute
         * @return boolean
         * 
         * @see \eZDataType::hasObjectAttributeContent()
         * @todo
         */
        public function hasObjectAttributeContent($contentObjectAttribute) {
            return false;
        }
        
        /**
         * @brief Returns the content.
         * @details Returns the content.
         * 
         * @param \eZContentObjectAttribute $objectAttribute
         * @return mixed
         * 
         * @see \eZDataType::objectAttributeContent()
         * @todo
         */
        public function objectAttributeContent($objectAttribute) {
            return '';
        }
        
        /**
         * @brief Returns the meta data used for search index.
         * @details  Returns the meta data used for search index.
         * 
         * @param eZContentObjectAttribute $contentObjectAttribute
         * @return string
         * 
         * @see \eZDataType::metaData()
         * @todo
         */
        public function metaData($contentObjectAttribute) {
            return '';
        }
        
        /**
         * @brief Returns the value as it will be shown if this attribute is used in the object name pattern.
         * @details Returns the value as it will be shown if this attribute is used in the object name pattern.
         * 
         * @param \eZContentObjectAttribute $objectAttribute
         * @name string $name
         * 
         * @return string
         * 
         * @see \eZDataType::title()
         * @todo
         */
        public function title($objectAttribute, $name=null) {
            return '';
        }
        
        /**
         * @brief Initializes the object attribute from a string representation
         * @details Initializes the object attribute from a string representation
         * 
         * @param eZContentObjectAttribute $objectAttribute
         * @param string $string
         * 
         * @see \eZDataType::fromString()
         * @todo
         */
        public function fromString($objectAttribute, $string) {
            //
        }
        
        /**
         * @brief Returns the string representation of the object attribute
         * @details Returns the string representation of the object attribute
         * 
         * @param \eZContentObjectAttribute $objectAttribute
         * @return string
         * 
         * @see eZDataType::toString()
         */
        public function toString($objectAttribute) {
            return '';
        }
        
        /**
         * @brief Returns the sort type. 
         * @details Returns the sort type. Can be 'string', 'int' ('float' is not supported) or false if sorting is not supported
         * 
         * @return string|int|bool
         * 
         * @see \eZDataType::sortKeyType()
         * @todo
         */
        public function sortKeyType() {
            return false;
        }
        
        /**
         * @brief Returns the sort key, for sorting at the attribute level
         * @details Returns the sort key, for sorting at the attribute level
         * 
         * @param \eZContentObjectAttribute $objectAttribute
         * @return string
         * 
         * @see \eZDataType::sortKey()
         * 
         * @todo
         */
        public function sortKey($objectAttribute) {
            return '';
        }
        
        /**
         * @brief Performs all necessary actions on the attribute when the object is moved to the Trash.
         * @details Performs all necessary actions on the attribute when the object is moved to the Trash.
         * Particularly useful if the contents of the attribute is stored in a portal
         * 
         * @param \eZContentObjectAttribute $objectAttribute
         * @param string $version
         * 
         * @return void
         * 
         * @see eZDataType::trashStoredObjectAttribute()
         * @todo
         */
        public function trashStoredObjectAttribute($objectAttribute, $version=null) {
            parent::trashStoredObjectAttribute($objectAttribute, $version);
        }
        
        /**
         * @brief Performs all necessary actions on the attribute when the object is permanently deleted.
         * @details Performs all necessary actions on the attribute when the object is permanently deleted.
         * Particularly useful if the contents of the attribute is stored in a portal.
         * 
         * @param \eZContentObjectAttribute $objectAttribute
         * @param string $version
         * 
         * @return void
         * 
         * @see eZDataType::deleteStoredObjectAttribute()
         * @todo
         */
        public function deleteStoredObjectAttribute($objectAttribute, $version=null) {
            parent::deleteStoredClassAttribute($classAttribute, $version);
        }
        
    }
    
    \eZDataType::register(eZShareNetworkType::DATA_TYPE_STRING, 'extension\\ezsharenetwork\\datatypes\\ezsharenetwork\\eZShareNetworkType');
    
}
?>