<?php

use extension\ezsharenetwork\autoloads\eZShareNetworkTemplateOperators;
use extension\ezsharenetwork\autoloads\eZAddThisTemplateOperators;

$eZTemplateOperatorArray = array();

// eZShare
$eZTemplateOperatorArray[] = array( 'script' => 'extension/ezsharenetwork/autoloads/ezsharenetworktemplateoperators.php',
                                    'class' => 'extension\\ezsharenetwork\\autoloads\\eZShareNetworkTemplateOperators',
                                    'operator_names' => eZShareNetworkTemplateOperators::operators()
);

// AddThis
$eZTemplateOperatorArray[] = array( 'script' => 'extension/ezsharenetwork/autoloads/ezaddthistemplateoperators.php',
                                    'class' => 'extension\\ezsharenetwork\\autoloads\\eZAddThisTemplateOperators',
                                    'operator_names' => eZAddThisTemplateOperators::operators()
);
