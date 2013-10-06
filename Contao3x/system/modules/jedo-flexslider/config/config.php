<?php

/**
 * Contao Open Source CMS
 * 
 * Copyright (C) 2005-2012 Leo Feyer
 * 
 * @package FlexSlider
 * @author  Jens Doberenz (Merlin) 
 * @link    http://www.jedo-webstudio.com
 * @license http://www.gnu.org/licenses/lgpl-3.0.html LGPL
 */


if (!is_array($GLOBALS['BE_MOD']['extensions']))
{
	array_insert($GLOBALS['BE_MOD'], 1, array('extensions' => array()));
}
array_insert($GLOBALS['BE_MOD']['extensions'], 0, array
(
	'jedoflexslider' => array
	(
		'tables'     => array('tl_jedo_flexslider','tl_jedo_flexslider_items'),
		'icon'       => 'system/modules/jedo-flexslider/assets/images/icon.png'
	)
));

array_insert($GLOBALS['FE_MOD']['application'], 0, array (

        'jedoFlexSlider' => 'ModuleFlexSlider'
));



	$GLOBALS['TL_CTE']['media']['jedoFlexSlider'] = 'ContentFlexSlider';
 
?>