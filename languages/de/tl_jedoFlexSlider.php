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
$GLOBALS['TL_LANG']['tl_jedoFlexSlider']['title'] = array('Titel', 'Bitte den Titel der Diashow eingeben.');
$GLOBALS['TL_LANG']['tl_jedoFlexSlider']['alias'] = array('Alias', 'Der Alias ist eine eindeutige Referenz auf den jedoFlex-Slider und kann anstatt der ID benutzt werden.');
$GLOBALS['TL_LANG']['tl_jedoFlexSlider']['size']        = array('Bild-Breite und -Höhe', 'Hier können Sie die Bildabmessungen und den Zuschneide-Modus einstellen.');
$GLOBALS['TL_LANG']['tl_jedoFlexSlider']['animation'] = array('Animations Effekt', 'wöhlen Sie hier den Slide Effekt.');
$GLOBALS['TL_LANG']['tl_jedoFlexSlider']['slideDirection'] = array('Effekt Richtung', 'wöhlen Sie hier die Richtung des Effekts.');
$GLOBALS['TL_LANG']['tl_jedoFlexSlider']['slideshow'] = array('Diashow', 'Diashow automatisch starten?');
$GLOBALS['TL_LANG']['tl_jedoFlexSlider']['slideshowSpeed'] = array('Diashow Geschwindigkeit', 'Stellen Sie hier die Gewindigkeit in Millisekunden ein.');
$GLOBALS['TL_LANG']['tl_jedoFlexSlider']['animationDuration'] = array('Effekt Dauer', 'Stellen Sie hier die Geschwindigkeit der Animationen in Millisekunden ein.');
$GLOBALS['TL_LANG']['tl_jedoFlexSlider']['directionNav'] = array('Navigation (vor / zurück)', 'wollen Sie diese Naviagtion anzeigen?');
$GLOBALS['TL_LANG']['tl_jedoFlexSlider']['controlNav'] = array('Kontrol', 'wöhlen Sie hier die Richtung des Effekts.');
$GLOBALS['TL_LANG']['tl_jedoFlexSlider']['keyboardNav'] = array('Tastatur erlauben', 'lassen Sie die Navigation via Tastatur zu.');
$GLOBALS['TL_LANG']['tl_jedoFlexSlider']['mousewheel'] = array('Mausrad erlauben', 'lassen Sie die Navigation via Mausrad zu.');
$GLOBALS['TL_LANG']['tl_jedoFlexSlider']['animationLoop'] = array('Animation Schleife', 'Soll die Animation wiederholt werden?');
$GLOBALS['TL_LANG']['tl_jedoFlexSlider']['pauseOnAction'] = array('Pause bei Aktion', 'Diashow pausieren bei Benutzung eines Bedienelements.');
$GLOBALS['TL_LANG']['tl_jedoFlexSlider']['pauseOnHover'] = array('Pause bei Maus', 'Diashow pausieren wenn sich Maus auf Slide Element befindet.');
$GLOBALS['TL_LANG']['tl_jedoFlexSlider']['published']   = array('Veröffentlichen', 'Die Diashow auf der Website veröffentlichen (sichtbar schalten).');
$GLOBALS['TL_LANG']['tl_jedoFlexSlider']['slideToStart'] = array('Start mit Element', 'geben Sie hier die Nummer des Elements ein mit dem begonnen werden soll.'); 
$GLOBALS['TL_LANG']['tl_jedoFlexSlider']['pausePlay'] = array('Pause / Play', 'Erstellen eines Pause / Play dynamisches Element.');
$GLOBALS['TL_LANG']['tl_jedoFlexSlider']['randomize'] = array('Zufallswiedergabe', 'Wiedergabe via Zufallsmodus.');
$GLOBALS['TL_LANG']['tl_jedoFlexSlider']['ribbon'] = array('Farbband', 'wollen Sie ein Farbband anzeigen.');
$GLOBALS['TL_LANG']['tl_jedoFlexSlider']['caption'] = array('Details anzeigen', 'wollen Sie die Details zum SlideElement anzeigen.');
$GLOBALS['TL_LANG']['tl_jedoFlexSlider']['theme'] = array('Slider Template', 'wöhlen Sie hier das Design der Slidershow.');

/**
 * Reference
 */
$GLOBALS['TL_LANG']['tl_jedoFlexSlider']['true'] = 'ja';
$GLOBALS['TL_LANG']['tl_jedoFlexSlider']['false'] = 'nein';


/**
 * Legends
 */
$GLOBALS['TL_LANG']['tl_jedoFlexSlider']['preferences_legend'] = 'Einstellungen der Animation';
$GLOBALS['TL_LANG']['tl_jedoFlexSlider']['publish_legend']   = 'Veröffentlichung';
$GLOBALS['TL_LANG']['tl_jedoFlexSlider']['navigation_legend']   = 'Steuerungseinstellung';
$GLOBALS['TL_LANG']['tl_jedoFlexSlider']['slideshow_legend']   = 'Diashow Einstellungen';
$GLOBALS['TL_LANG']['tl_jedoFlexSlider']['title_legend']   = 'Grundeinstellung';


/**
 * Buttons
 */
$GLOBALS['TL_LANG']['tl_jedoFlexSlider']['new']    = array('Neuer FlexSlider', 'Erzeugt eine neue Diashow');
$GLOBALS['TL_LANG']['tl_jedoFlexSlider']['edit']   = array('Bearbeite FlexSlider Bilder', 'Bearbeiten Sie die Bilder der Diashow ID %s');
$GLOBALS['TL_LANG']['tl_jedoFlexSlider']['editheader']   = array('Bearbeite FlexSlider', 'Bearbeiten Sie die Diashow ID %s');
$GLOBALS['TL_LANG']['tl_jedoFlexSlider']['copy']   = array('Dupliziere FlexSlider', 'Erstellt eine Kopie von Diashow ID %s');
$GLOBALS['TL_LANG']['tl_jedoFlexSlider']['delete'] = array('Lösche FlexSlider', 'Löscht die Diashow ID %s');
$GLOBALS['TL_LANG']['tl_jedoFlexSlider']['toggle'] = array('Veröffentlichen/Unveröffentlichen FlexSlider', 'Veröffentlicht/Unveröffentlicht die Diashow ID %s');
$GLOBALS['TL_LANG']['tl_jedoFlexSlider']['show']   = array('FlexSlider Details', 'Zeige Details von Diashow ID %s');


/**
 * Labels
 */

$GLOBALS['TL_LANG']['tl_jedoFlexSlider']['pictures'] = 'Bilder';
?>
