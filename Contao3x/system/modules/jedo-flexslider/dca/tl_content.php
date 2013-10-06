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

/**
 * Add palettes to tl_module
 */
$GLOBALS['TL_DCA']['tl_content']['palettes']['jedoFlexSlider'] = '{type_legend},headline, type;{select_FlexSlider_legend},select_FlexSlider;{protected_legend:hide},protected;{expert_legend:hide},guests,cssID,space';

/**
 * Add fields to tl_module
 */
$GLOBALS['TL_DCA']['tl_content']['fields']['select_FlexSlider'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_content']['select_FlexSlider'],
	'exclude'                 => true,
	'inputType'               => 'radio',
	'foreignKey'              => 'tl_jedo_flexslider.title',
	'eval'                    => array('mandatory'=>true),
	'sql'			=> "int(10) unsigned NOT NULL default '0'"
);
?>