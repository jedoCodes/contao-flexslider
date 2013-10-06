<?php

/**
 * Contao Open Source CMS
 * 
 * Copyright (C) 2005-2012 Leo Feyer
 * 
 * @package Jedo-flexslider
 * @link    http://www.contao.org
 * @license http://www.gnu.org/licenses/lgpl-3.0.html LGPL
 */
/**
 * Register the namespaces
 */
ClassLoader::addNamespaces(array
(
    'FlexSlider',
));

/**
 * Register the classes
 */
ClassLoader::addClasses(array
(
	// Modules
	'FlexSlider\ModuleFlexSlider'  => 'system/modules/jedo-flexslider/modules/ModuleFlexSlider.php',

	// Elements
	'FlexSlider\ContentFlexSlider' => 'system/modules/jedo-flexslider/elements/ContentFlexSlider.php',

	// Classes
	'FlexSlider\ClassFlexSlider'    => 'system/modules/jedo-flexslider/classes/ClassesFlexSlider.php',
));


/**
 * Register the templates
 */
TemplateLoader::addFiles(array
(
	'ce_flexslider' => 'system/modules/jedo-flexslider/templates',
));
