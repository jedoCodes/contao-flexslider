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
 * Table tl_jedoFlexSlider
 */
$GLOBALS['TL_DCA']['tl_jedoFlexSlider'] = array
(

	// Config
	'config' => array
	(
		'dataContainer'               => 'Table',
                'ctable'                      => array('tl_jedoFlexSliderPictures'),
                'switchToEdit'                => true,
		'enableVersioning'            => true
	),

	// List
	'list' => array
	(
		'sorting' => array
		(
			'mode'                    => 1,
			'fields'                  => array('title'),
			'flag'                    => 1,
                        'panelLayout'             => 'filter;sorting,search,limit',
            'child_record_callback' => array('tl_jedoFlexSliderPictures', 'listPictures')
		),
		'label' => array
		(
			'fields'                  => array('title'),
			'format'                  => '%s',
                        'label_callback'          => array('tl_jedoFlexSlider', 'addPicturesNumber')
		),
		'global_operations' => array
		(
			'all' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['MSC']['all'],
				'href'                => 'act=select',
				'class'               => 'header_edit_all',
				'attributes'          => 'onclick="Backend.getScrollOffset();" accesskey="e"'
			)
		),
		'operations' => array
		(
			'edit' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_jedoFlexSlider']['edit'],
				'href'                => 'table=tl_jedoFlexSliderPictures',
				'icon'                => 'edit.gif'
			),
			'copy' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_jedoFlexSlider']['copy'],
				'href'                => 'act=copy',
				'icon'                => 'copy.gif'
			),
			'delete' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_jedoFlexSlider']['delete'],
				'href'                => 'act=delete',
				'icon'                => 'delete.gif',
				'attributes'          => 'onclick="if (!confirm(\'' . $GLOBALS['TL_LANG']['MSC']['deleteConfirm'] . '\')) return false; Backend.getScrollOffset();"'
			),
                        'toggle' => array
                        (
                                'label'               => &$GLOBALS['TL_LANG']['tl_jedoFlexSlider']['toggle'],
                                'icon'                => 'visible.gif',
                                'attributes'          => 'onclick="Backend.getScrollOffset(); return AjaxRequest.toggleVisibility(this, %s);"',
                                'button_callback'     => array('tl_jedoFlexSlider', 'toggleIcon')
                        ),
			'show' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_jedoFlexSlider']['show'],
				'href'                => 'act=show',
				'icon'                => 'show.gif'
			)
		)
	),

	// Palettes
	'palettes' => array
	(
		'__selector__'                => array(''),
		'default'                     => '{title_legend},title,alias,size,theme,ribbon,caption;{preferences_legend},animation,slideDirection;{navigation_legend},directionNav,controlNav,keyboardNav,mousewheel,pauseOnAction,pauseOnHover,pausePlay;{slideshow_legend},slideshow, slideToStart, slideshowSpeed, animationDuration,animationLoop,randomize;{publish_legend},published'
	),

	// Subpalettes
	'subpalettes' => array
	(
		''                            => ''
	),

	// Fields
	'fields' => array
	(
            	'title' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_jedoFlexSlider']['title'],
			'exclude'                 => true,
			'search'                  => true,
			'sorting'                 => true,
			'flag'                    => 1,
			'inputType'               => 'text',
			'eval'                    => array('mandatory'=>true, 'maxlength'=>255, 'tl_class'=>'w50')
		),

                'alias' => array
                (
                        'label'                   => &$GLOBALS['TL_LANG']['tl_jedoFlexSlider']['alias'],
                        'exclude'                 => true,
                        'inputType'               => 'text',
                        'eval'                    => array('rgxp'=>'alnum', 'doNotCopy'=>true, 'spaceToUnderscore'=>true, 'maxlength'=>128, 'tl_class'=>'w50'),
                        'save_callback' => array
                        (
                                array('tl_jedoFlexSlider', 'generateAlias')
                        )
                ),

        'size' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_jedoFlexSlider']['size'],
            'exclude'                 => true,
            'inputType'               => 'imageSize',
            'options'                 => (version_compare(VERSION.'.'.BUILD, '2.11.0', '>=') ? $GLOBALS['TL_CROP'] : array('crop', 'proportional', 'box')),
            'reference'               => &$GLOBALS['TL_LANG']['MSC'],
            'eval'                    => array('rgxp'=>'digit', 'nospace'=>true, 'tl_class'=>'w50')
        ),
                'theme' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_jedoFlexSlider']['theme'],
			'exclude'                 => true,
                        	'default'                 => 'default',
			'inputType'               => 'select',
                        	'options'                 => array('default', 'jedo'),
			'reference'               => &$GLOBALS['TL_LANG']['tl_jedoFlexSlider'],
			'eval'                    => array('tl_class'=>'w50')
		),

                'animation' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_jedoFlexSlider']['animation'],
			'exclude'                 => true,
                        	'default'                 => 'slide',
			'inputType'               => 'select',
                        	'options'                 => array('slide', 'fade'),
			'reference'               => &$GLOBALS['TL_LANG']['tl_jedoFlexSlider'],
			'eval'                    => array('tl_class'=>'w50')
		),
                'slideDirection' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_jedoFlexSlider']['slideDirection'],
			'exclude'                 => true,
                        	'default'                 => 'horizontal',
			'inputType'               => 'select',
                        	'options'                 => array('horizontal', 'vertical'),
			'reference'               => &$GLOBALS['TL_LANG']['tl_jedoFlexSlider'],
			'eval'                    => array('tl_class'=>'w50')
		),

                'caption' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_jedoFlexSlider']['caption'],
			'exclude'                 => true,
                        	'default'                 => 'true',
			'inputType'               => 'select',
                        	'options'                 => array('true', 'false'),
			'reference'               => &$GLOBALS['TL_LANG']['tl_jedoFlexSlider'],
			'eval'                    => array('tl_class'=>'w50')
		),

                'ribbon' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_jedoFlexSlider']['ribbon'],
			'exclude'                 => true,
                        	'default'                 => 'false',
			'inputType'               => 'select',
                        	'options'                 => array('true', 'false'),
			'reference'               => &$GLOBALS['TL_LANG']['tl_jedoFlexSlider'],
			'eval'                    => array('tl_class'=>'w50')
		),
                'slideshow' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_jedoFlexSlider']['slideshow'],
			'exclude'                 => true,
                        	'default'                 => 'true',
			'inputType'               => 'select',
                        	'options'                 => array('true', 'false'),
			'reference'               => &$GLOBALS['TL_LANG']['tl_jedoFlexSlider'],
			'eval'                    => array('tl_class'=>'w50')
		),
                'slideshowSpeed' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_jedoFlexSlider']['slideshowSpeed'],
			'exclude'                 => true,
                        'default'                 => '7000',
			'inputType'               => 'text',
			'eval'                    => array('rgxp'=>'digit', 'maxlength'=>255, 'tl_class'=>'w50')
		),
                'animationDuration' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_jedoFlexSlider']['animationDuration'],
			'exclude'                 => true,
                        'default'                 => '600',
			'inputType'               => 'text',
			'eval'                    => array('rgxp'=>'digit', 'maxlength'=>255, 'tl_class'=>'w50')
		),
                'directionNav' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_jedoFlexSlider']['directionNav'],
			'exclude'                 => true,
                        	'default'                 => 'true',
			'inputType'               => 'select',
                        	'options'                 => array('true', 'false'),
			'reference'               => &$GLOBALS['TL_LANG']['tl_jedoFlexSlider'],
			'eval'                    => array('tl_class'=>'w50')
		),
                'controlNav' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_jedoFlexSlider']['controlNav'],
			'exclude'                 => true,
                        	'default'                 => 'true',
			'inputType'               => 'select',
                        	'options'                 => array('true', 'false'),
			'reference'               => &$GLOBALS['TL_LANG']['tl_jedoFlexSlider'],
			'eval'                    => array('tl_class'=>'w50')
		),
                'keyboardNav' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_jedoFlexSlider']['keyboardNav'],
			'exclude'                 => true,
                        	'default'                 => 'true',
			'inputType'               => 'select',
                        	'options'                 => array('true', 'false'),
			'reference'               => &$GLOBALS['TL_LANG']['tl_jedoFlexSlider'],
			'eval'                    => array('tl_class'=>'w50')
		),
                'mousewheel' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_jedoFlexSlider']['mousewheel'],
			'exclude'                 => true,
                        	'default'                 => 'false',
			'inputType'               => 'select',
                        	'options'                 => array('true', 'false'),
			'reference'               => &$GLOBALS['TL_LANG']['tl_jedoFlexSlider'],
			'eval'                    => array('tl_class'=>'w50')
		),
                'animationLoop' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_jedoFlexSlider']['animationLoop'],
			'exclude'                 => true,
                        	'default'                 => 'true',
			'inputType'               => 'select',
                        	'options'                 => array('true', 'false'),
			'reference'               => &$GLOBALS['TL_LANG']['tl_jedoFlexSlider'],
			'eval'                    => array('tl_class'=>'w50')
		),

                'pauseOnAction' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_jedoFlexSlider']['pauseOnAction'],
			'exclude'                 => true,
                        	'default'                 => 'true',
			'inputType'               => 'select',
                        	'options'                 => array('true', 'false'),
			'reference'               => &$GLOBALS['TL_LANG']['tl_jedoFlexSlider'],
			'eval'                    => array('tl_class'=>'w50')
		),
                'pauseOnHover' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_jedoFlexSlider']['pauseOnHover'],
			'exclude'                 => true,
                        	'default'                 => 'false',
			'inputType'               => 'select',
                        	'options'                 => array('true', 'false'),
			'reference'               => &$GLOBALS['TL_LANG']['tl_jedoFlexSlider'],
			'eval'                    => array('tl_class'=>'w50')
		),
                'pausePlay' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_jedoFlexSlider']['pausePlay'],
			'exclude'                 => true,
                        	'default'                 => 'false',
			'inputType'               => 'select',
                        	'options'                 => array('true', 'false'),
			'reference'               => &$GLOBALS['TL_LANG']['tl_jedoFlexSlider'],
			'eval'                    => array('tl_class'=>'w50')
		),
                'randomize' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_jedoFlexSlider']['randomize'],
			'exclude'                 => true,
                        	'default'                 => 'false',
			'inputType'               => 'select',
                        	'options'                 => array('true', 'false'),
			'reference'               => &$GLOBALS['TL_LANG']['tl_jedoFlexSlider'],
			'eval'                    => array('tl_class'=>'w50')
		),
		'slideToStart' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_jedoFlexSlider']['slideToStart'],
			'exclude'                 => true,
                        'default'                 => '0',
			'inputType'               => 'text',
			'eval'                    => array('rgxp'=>'digit', 'mandatory'=>true, 'maxlength'=>255, 'tl_class'=>'w50')
		),
                'published' => array
                (
                        'label'                   => &$GLOBALS['TL_LANG']['tl_jedoFlexSlider']['published'],
                        'exclude'                 => true,
                        'filter'                  => true,
                        'flag'                    => 2,
                        'inputType'               => 'checkbox',
                        'eval'                    => array('doNotCopy'=>true, 'tl_class'=>'w50 m12')
                )
	)
);


/**
 * Class tl_jedoFlexSlider
 *
 * Provide miscellaneous methods that are used by the data configuration array.
 * @package Controller
 */
class tl_jedoFlexSlider extends Backend {

    /**
     * Count the number of courses in the database
     * @param array
     * @param string
     * @return string
     */

    public function addPicturesNumber($row, $label) {

        $objElements = $this->Database->prepare("SELECT * FROM tl_jedoFlexSliderPictures WHERE pid=? ORDER by sorting ASC")
                ->execute($row['id']);
					   
		if ($objElements->numRows > 0)
		{
			while ($objElements->next())
			{
				if (strncmp($objElements->singleSRC, '.', 1) === 0)
				{
					continue;
				}
	
				if (is_file(TL_ROOT . '/' . $objElements->singleSRC))
				{
					$objFile = new File($objElements->singleSRC);
					if ($objFile->isGdImage)
					{
						$arrElements[$x]['image'] = @$this->getImage($objElements->singleSRC, 100, 50);
						$x++;
					}
				}
	
			}			   
			
			if (is_array($arrElements))
			{
				foreach ($arrElements as $element)
				{
					$OutputImages .= '<img src="' . $element['image'] . '" alt="' . $element['alt'] . '"  style="margin-right: 5px;" />';
				}
			}

		}
		else
		{
			$OutputImages = $GLOBALS['TL_LANG']['tl_jedocslider01']['misc_elements'];
		}
					   
		return '<div class="labelbox">
		<div class="heading">' . $row['title'] . ' (' . count($arrElements) . ')</div>
		<div class="limit_height' . (!$GLOBALS['TL_CONFIG']['doNotCollapse'] ? ' h64' : '') . ' block">
			' . $OutputImages . '
		</div>
		</div>';
    }

    /**
     * Autogenerate a news alias if it has not been set yet
     * @param mixed
     * @param object
     * @return string
     */
    public function generateAlias($varValue, DataContainer $dc) {
        $autoAlias = false;

        // Generate alias if there is none
        if (!strlen($varValue)) {
            $autoAlias = true;
            $key = $dc->activeRecord->title;
            if(strlen($dc->activeRecord->title) > 0) {
                $keyAlias = $key;
            }
            $varValue = standardize($keyAlias);
        }

        $objAlias = $this->Database->prepare("SELECT id FROM tl_jedoFlexSlider WHERE id=? OR alias=?")
                ->execute($dc->id, $varValue);

        // Check whether the page alias exists
        if ($objAlias->numRows > 1) {
            if (!$autoAlias) {
                throw new Exception(sprintf($GLOBALS['TL_LANG']['ERR']['aliasExists'], $varValue));
            }

            $varValue .= '-' . $dc->id;
        }

        return $varValue;
    }

    /**
     * Return the "toggle visibility" button
     * @param array
     * @param string
     * @param string
     * @param string
     * @param string
     * @param string
     * @return string
     */
    public function toggleIcon($row, $href, $label, $title, $icon, $attributes) {

        if (strlen($this->Input->get('tid'))) {

            $this->toggleVisibility($this->Input->get('tid'), ($this->Input->get('state') == 1));
            $this->redirect($this->getReferer());
        }

        $href .= '&amp;tid='.$row['id'].'&amp;state='.($row['published'] ? '' : 1);

        if (!$row['published']) {

            $icon = 'invisible.gif';
        }

        return '<a href="'.$this->addToUrl($href).'" title="'.specialchars($title).'"'.$attributes.'>'.$this->generateImage($icon, $label).'</a> ';
    }


    /**
     * Disable/enable a user group
     * @param integer
     * @param boolean
     */
    public function toggleVisibility($intId, $blnVisible) {

        $this->createInitialVersion('tl_jedoFlexSlider', $intId);

        // Trigger the save_callback
        if (is_array($GLOBALS['TL_DCA']['tl_jedoFlexSlider']['fields']['published']['save_callback'])) {

            foreach ($GLOBALS['TL_DCA']['tl_jedoFlexSlider']['fields']['published']['save_callback'] as $callback) {

                $this->import($callback[0]);
                $blnVisible = $this->$callback[0]->$callback[1]($blnVisible, $this);
            }
        }

        // Update the database
        $this->Database->prepare("UPDATE tl_jedoFlexSlider SET published='" . ($blnVisible ? 1 : '') . "' WHERE id=?")
                ->execute($intId);

        $this->createNewVersion('tl_jedoFlexSlider', $intId);

    }
}

?>