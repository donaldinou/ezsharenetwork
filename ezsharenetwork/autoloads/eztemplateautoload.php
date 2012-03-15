<?php

use extension\ezsharenetwork\autoloads;

$eZTemplateOperatorArray = array();
$eZTemplateOperatorArray[] = array( 'script' => 'extension/ezsharenetwork/autoloads/ezsharenetworktemplateoperators.php',
									'class' => 'extension\ezsharenetwork\autoloads\eZShareNetworkTemplateOperators',
									'operator_names' => eZShareNetworkTemplateOperators::operators()
);

?>