<?php
namespace extension\ezsharenetwork\classes\enums {

	/**
	 * @brief Enumeration class for addthis ini file
	 * @details Classe witch define all enumeration use for ini file
	 * This class will need to extends <a href="http://php.net/manual/fr/book.spl-types.php">SplEnum</a> soon
	 * It's a final class because there is no need to extends it;
	 * 
	 * @author Adrien Loyant <adrien.loyant@te-laval.fr>
	 * 
	 * @date 2012-03-01
	 * @version 1.0.0
	 * @since 1.0.0
	 * @copyright GNU Public License v.2
	 * 
	 * @package extension\ezadvancedautoload\classes\enums
	 */
	final class addThisConfigEnum {
		
		/**
		 * @brief default value
		 * @details this is the default value of this enumeration
		 * @var int
		 */
		const __default = self::ALL;
		
		/**
		 * @brief All constant enumeration
		 * @details All constant enumeration. Use for build kernel autoload only
		 * 
		 * @var int
		 */
		const ALL = 1;
		
		/**
		 * @brief Config sconstant enumeration
		 * @details Config constant enumeration. Use for build kernel override autoload only
		 * 
		 * @var int
		 */
		const CONFIG = 2;
		/**
		 * @brief Share constant enumeration
		 * @details Share constant enumeration. Use for build extension autoload only
		 * 
		 * @var int
		 */
		const SHARE = 3;
		/**
		 * @brief localization constant enumeration
		 * @details localization constant enumeration. Use for build test autoload only
		 * 
		 * @var int
		 */
		const LOCALIZATION = 4;
		
	}
	
}
?>