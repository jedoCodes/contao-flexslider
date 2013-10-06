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
$GLOBALS['TL_DCA']['tl_module']['palettes']['jedoFlexSlider'] = '{title_legend},name,headline, type;{select_FlexSlider_legend},select_FlexSlider;{config_legend},align,space,cssID';

/**
 * Add fields to tl_module
 */
$GLOBALS['TL_DCA']['tl_module']['fields']['select_FlexSlider'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_module']['select_FlexSlider'],
	'exclude'                 => true,
	'inputType'               => 'radio',
	'foreignKey'              => 'tl_jedoFlexSlider.title',
	'eval'                    => array('mandatory'=>true),
	'sql'			=> "int(10) unsigned NOT NULL default '0'"
);
?>