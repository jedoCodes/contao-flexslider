<?php if (!defined('TL_ROOT')) die('You cannot access this file directly!');
/**
 * Contao Open Source CMS
 * Copyright (C) 2005-2012 Leo Feyer
 *
 * Formerly known as TYPOlight Open Source CMS.
 *
 * This program is free software: you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation, either
 * version 3 of the License, or (at your option) any later version.
 * 
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU
 * Lesser General Public License for more details.
 * 
 * You should have received a copy of the GNU Lesser General Public
 * License along with this program. If not, please visit the Free
 * Software Foundation website at <http://www.gnu.org/licenses/>.
 *
 * PHP version 5
 * @copyright  jedo Webstudio 2005-2012
 * @author     Jens Doberenz <http://www.jedo-webstudio.com>
 * @package    jedo FlexSlider (jQuery)
 * @license    LGPL
 * @version 1.0.0
 */


/**
 * Fields
 */
$GLOBALS['TL_LANG']['tl_jedoFlexSlider']['title'] = array('Title', 'Please enter the slideshow title.');
$GLOBALS['TL_LANG']['tl_jedoFlexSlider']['alias'] = array('Alias', 'This alias is a unique reference to the Coin Slider which can be called instead of its numeric ID.');
$GLOBALS['TL_LANG']['tl_jedoFlexSlider']['size']        = array('Image width and height', 'Here you can set the image dimensions and the resize mode.');
$GLOBALS['TL_LANG']['tl_jedoFlexSlider']['animation'] = array('Animation Type', 'elect your animation type, "fade" or "slide"');
$GLOBALS['TL_LANG']['tl_jedoFlexSlider']['slideDirection'] = array('Sliding Direction', 'Select the sliding direction, "horizontal" or "vertical"');
$GLOBALS['TL_LANG']['tl_jedoFlexSlider']['slideshow'] = array('Slideshow', 'Animate slider automatically');
$GLOBALS['TL_LANG']['tl_jedoFlexSlider']['slideshowSpeed'] = array('Slideshow Speed', 'Set the speed of the slideshow cycling, in milliseconds');
$GLOBALS['TL_LANG']['tl_jedoFlexSlider']['animationDuration'] = array('Animation Speed', 'Set the speed of animations, in milliseconds');
$GLOBALS['TL_LANG']['tl_jedoFlexSlider']['directionNav'] = array('previous/next navigation', 'Create navigation for previous/next navigation');
$GLOBALS['TL_LANG']['tl_jedoFlexSlider']['controlNav'] = array('paging control', 'Create navigation for paging control of each clide');
$GLOBALS['TL_LANG']['tl_jedoFlexSlider']['keyboardNav'] = array('Keyboard Navigation', 'Allow slider navigating via keyboard left/right keys.');
$GLOBALS['TL_LANG']['tl_jedoFlexSlider']['mousewheel'] = array('Mousewheel', 'Allow slider navigating via mousewheel');
$GLOBALS['TL_LANG']['tl_jedoFlexSlider']['animationLoop'] = array('Animation Loop', 'Should the animation loop');
$GLOBALS['TL_LANG']['tl_jedoFlexSlider']['pauseOnAction'] = array('Pause on Aktion', 'Pause the slideshow when interacting with control elements');
$GLOBALS['TL_LANG']['tl_jedoFlexSlider']['pauseOnHover'] = array('Pause on Hover', 'Pause the slideshow when hovering over slider, then resume when no longer hovering');
$GLOBALS['TL_LANG']['tl_jedoFlexSlider']['slideToStart'] = array('Slide to Start', 'The slide that the slider should start on'); 
$GLOBALS['TL_LANG']['tl_jedoFlexSlider']['pausePlay'] = array('Pause / Play', 'Create pause/play dynamic element');
$GLOBALS['TL_LANG']['tl_jedoFlexSlider']['randomize'] = array('Randomize', 'Randomize slide order');

$GLOBALS['TL_LANG']['tl_jedoFlexSlider']['ribbon'] = array('Show Ribbon', 'Select yes or no to show or hidden the ribbon.');
$GLOBALS['TL_LANG']['tl_jedoFlexSlider']['caption'] = array('Show Description', 'Select yes or no to show or hidden the description of image');
$GLOBALS['TL_LANG']['tl_jedoFlexSlider']['theme'] = array('Slider Template', 'Select the Slideshow design.');

$GLOBALS['TL_LANG']['tl_jedoFlexSlider']['published']   = array('Publish slideshow', 'Make the slideshow visible on the website.');


/**
 * Reference
 */
$GLOBALS['TL_LANG']['tl_jedoFlexSlider']['true'] = 'yes';
$GLOBALS['TL_LANG']['tl_jedoFlexSlider']['false'] = 'no';


/**
 * Legends
 */
$GLOBALS['TL_LANG']['tl_jedoFlexSlider']['preferences_legend'] = 'Animation Settings';
$GLOBALS['TL_LANG']['tl_jedoFlexSlider']['publish_legend']   = 'Publish';
$GLOBALS['TL_LANG']['tl_jedoFlexSlider']['navigation_legend']   = 'Navigation Settings';
$GLOBALS['TL_LANG']['tl_jedoFlexSlider']['slideshow_legend']   = 'Slideshow Setings';
$GLOBALS['TL_LANG']['tl_jedoFlexSlider']['title_legend']   = 'Default Settings';


/**
 * Buttons
 */
$GLOBALS['TL_LANG']['tl_jedoFlexSlider']['new']    = array('New slideshow', 'Create a new slideshow');
$GLOBALS['TL_LANG']['tl_jedoFlexSlider']['edit']   = array('Edit slideshow pictures', 'Edit pictures of this slideshow ID %s');
$GLOBALS['TL_LANG']['tl_jedoFlexSlider']['editheader']   = array('Edit slideshow', 'Edit this slideshow ID %s');
$GLOBALS['TL_LANG']['tl_jedoFlexSlider']['copy']   = array('Duplicate slideshow', 'Duplicate this slideshow ID %s');
$GLOBALS['TL_LANG']['tl_jedoFlexSlider']['delete'] = array('Delete slideshow', 'Delete this slideshow ID %s');
$GLOBALS['TL_LANG']['tl_jedoFlexSlider']['toggle'] = array('Publish/unpublish slideshow', 'Publish/unpublish this slideshow ID %s');
$GLOBALS['TL_LANG']['tl_jedoFlexSlider']['show']   = array('FlexSlider details', 'Show the details of this slideshow ID %s');


/**
 * Labels
 */

$GLOBALS['TL_LANG']['tl_jedoFlexSlider']['pictures'] = 'pictures';
?>