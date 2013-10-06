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
$GLOBALS['TL_DCA']['tl_jedo_flexslider'] = array
(

	// Config
	'config' => array
	(
		'dataContainer'               => 'Table',
                'ctable'                      => array('tl_jedo_flexslider_items'),
                'switchToEdit'                => true,
		'enableVersioning'            => true,
		'sql' => array
		(
			'keys' => array
			(
				'id' => 'primary',
				'pid' => 'index'
			)
		)
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
            'child_record_callback' => array('tl_jedo_flexslider_items', 'listPictures')
		),
		'label' => array
		(
			'fields'                  => array('title'),
			'format'                  => '%s',
                        'label_callback'          => array('tl_jedo_flexslider', 'addPicturesNumber')
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
				'label'               => &$GLOBALS['TL_LANG']['tl_jedo_flexslider']['edit'],
				'href'                => 'table=tl_jedo_flexslider_items',
				'icon'                => 'edit.gif'
			),
			'editheader' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_slidegallery_categories']['editheader'],
				'href'                => 'act=edit',
				'icon'                => 'header.gif',
				'button_callback'     => array('tl_jedo_flexslider', 'editHeader'),
				'attributes'          => 'class="edit-header"'
			),
			'copy' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_jedo_flexslider']['copy'],
				'href'                => 'act=copy',
				'icon'                => 'copy.gif'
			),
			'delete' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_jedo_flexslider']['delete'],
				'href'                => 'act=delete',
				'icon'                => 'delete.gif',
				'attributes'          => 'onclick="if (!confirm(\'' . $GLOBALS['TL_LANG']['MSC']['deleteConfirm'] . '\')) return false; Backend.getScrollOffset();"'
			),
                        'toggle' => array
                        (
                                'label'               => &$GLOBALS['TL_LANG']['tl_jedo_flexslider']['toggle'],
                                'icon'                => 'visible.gif',
                                'attributes'          => 'onclick="Backend.getScrollOffset(); return AjaxRequest.toggleVisibility(this, %s);"',
                                'button_callback'     => array('tl_jedo_flexslider', 'toggleIcon')
                        ),
			'show' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_jedo_flexslider']['show'],
				'href'                => 'act=show',
				'icon'                => 'show.gif'
			)
		)
	),

	// Palettes
	'palettes' => array
	(
		'__selector__'                => array(''),
		'default'                     => '{title_legend},title, alias, size, caption;{special_properties_legend},asNavSlider,sync,asNavFor;
						{default_legend},animation, easing, direction, reverse, animationLoop, smoothHeight, startAt, slideshow, slideshowSpeed, animationSpeed, initDelay, randomize;
						{usability_features_legend:hide},pauseOnAction, pauseOnHover,useCSS,touch,video;
						{primary_control_legend:hide},controlNav,directionNav;
						{Secondary_legend:hide},keyboard,multipleKeyboard,mousewheel,pausePlay;
						{publish_legend},published'

	),

	// Subpalettes
	'subpalettes' => array
	(
		''                            => ''
	),

	// Fields
	'fields' => array
	(

		'id' => array
		(
			'sql'                     => "int(10) unsigned NOT NULL auto_increment"
		),
		'pid' => array
		(
			'sql'                     => "int(10) unsigned NOT NULL default '0'"
		),
		'sorting' => array
		(
			'sql'                     => "int(10) unsigned NOT NULL default '0'"
		),
		'tstamp' => array
		(
			'sql'                     => "int(10) unsigned NOT NULL default '0'"
		),


            	'title' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_jedo_flexslider']['title'],
			'exclude'                 => true,
			'search'                  => true,
			'sorting'                 => true,
			'flag'                    => 1,
			'inputType'               => 'text',
			'eval'                    => array('mandatory'=>true, 'maxlength'=>255, 'tl_class'=>'w50'),
			'sql'                     => "varchar(255) NOT NULL default ''"
		),

		'alias' => array
		(
                        'label'                   => &$GLOBALS['TL_LANG']['tl_jedo_flexslider']['alias'],
                        'exclude'                 => true,
                        'inputType'               => 'text',
                        'eval'                    => array('rgxp'=>'alnum', 'doNotCopy'=>true, 'spaceToUnderscore'=>true, 'maxlength'=>128, 'tl_class'=>'w50'),
                        'save_callback' => array
                        (
                                array('tl_jedo_flexslider', 'generateAlias')
                        ),
			'sql'                     => "varchar(255) NOT NULL default ''"
                ),
        'size' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_jedo_flexslider']['size'],
            'exclude'                 => true,
            'inputType'               => 'imageSize',
            'options'                 => (version_compare(VERSION.'.'.BUILD, '2.11.0', '>=') ? $GLOBALS['TL_CROP'] : array('crop', 'proportional', 'box')),
            'reference'               => &$GLOBALS['TL_LANG']['MSC'],
            'eval'                    => array('mandatory'=>true, 'rgxp'=>'digit', 'nospace'=>true, 'tl_class'=>'w50'),
			'sql'                     => "varchar(64) NOT NULL default ''"
        ),

                'caption' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_jedo_flexslider']['caption'],
                        'exclude'                 => true,
                        'inputType'               => 'checkbox',
                        'eval'                    => array('doNotCopy'=>true, 'tl_class'=>'w50 m12'),
			'sql' => "char(1) NOT NULL default ''"
		),

// Default Settings

                'animation' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_jedo_flexslider']['animation'],
			'exclude'                 => true,
                        	'default'                 => 'slide',
			'inputType'               => 'select',
                        	'options'                 => array('slide', 'fade'),
			'reference'               => &$GLOBALS['TL_LANG']['tl_jedo_flexslider'],
			'eval'                    => array('tl_class'=>'w50'),
			'sql'                     => "varchar(255) NOT NULL default ''"
		),
                'easing' => array
		(
	'label'                   => &$GLOBALS['TL_LANG']['tl_jedo_flexslider']['easing'],
	'exclude'                 => true,
	'inputType'               => 'select',
	'default'				  => 'quad',
	'options_callback'		  => array('tl_jedo_flexslider','getTransitions'),
	'eval'                    => array('mandatory'=>true,'tl_class'=>'w50'),
			'sql'                     => "varchar(255) NOT NULL default ''"
		),


                'direction' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_jedo_flexslider']['direction'],
			'exclude'                 => true,
                        	'default'                 => 'horizontal',
			'inputType'               => 'select',
                        	'options'                 => array('horizontal', 'vertical'),
			'reference'               => &$GLOBALS['TL_LANG']['tl_jedo_flexslider'],
			'eval'                    => array('tl_class'=>'w50'),
			'sql'                     => "varchar(128) NOT NULL default ''"
		),


                'reverse' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_jedo_flexslider']['reverse'],
			'exclude'                 => true,
                        	'default'                 => 'false',
			'inputType'               => 'select',
                        	'options'                 => array('true', 'false'),
			'reference'               => &$GLOBALS['TL_LANG']['tl_jedo_flexslider'],
			'eval'                    => array('tl_class'=>'w50'),
			'sql'                     => "varchar(128) NOT NULL default ''"
		),

                'animationLoop' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_jedo_flexslider']['animationLoop'],
			'exclude'                 => true,
                        	'default'                 => 'true',
			'inputType'               => 'select',
                        	'options'                 => array('true', 'false'),
			'reference'               => &$GLOBALS['TL_LANG']['tl_jedo_flexslider'],
			'eval'                    => array('tl_class'=>'w50'),
			'sql'                     => "varchar(128) NOT NULL default ''"
		),
                'smoothHeight' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_jedo_flexslider']['smoothHeight'],
			'exclude'                 => true,
                        	'default'                 => 'false',
			'inputType'               => 'select',
                        	'options'                 => array('true', 'false'),
			'reference'               => &$GLOBALS['TL_LANG']['tl_jedo_flexslider'],
			'eval'                    => array('tl_class'=>'w50'),
			'sql'                     => "varchar(128) NOT NULL default ''"
		),
		'startAt' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_jedo_flexslider']['startAT'],
			'exclude'                 => true,
                        'default'                 => '0',
			'inputType'               => 'text',
			'eval'                    => array('rgxp'=>'digit', 'mandatory'=>true, 'maxlength'=>255, 'tl_class'=>'w50'),
			'sql'                     => "varchar(128) NOT NULL default ''"
		),
                'slideshow' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_jedo_flexslider']['slideshow'],
			'exclude'                 => true,
                        	'default'                 => 'true',
			'inputType'               => 'select',
                        	'options'                 => array('true', 'false'),
			'reference'               => &$GLOBALS['TL_LANG']['tl_jedo_flexslider'],
			'eval'                    => array('tl_class'=>'w50'),
			'sql'                     => "varchar(128) NOT NULL default ''"
		),
                'slideshowSpeed' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_jedo_flexslider']['slideshowSpeed'],
			'exclude'                 => true,
                        'default'                 => '7000',
			'inputType'               => 'text',
			'eval'                    => array('rgxp'=>'digit', 'maxlength'=>255, 'tl_class'=>'w50'),
			'sql'                     => "varchar(128) NOT NULL default ''"
		),
                'animationSpeed' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_jedo_flexslider']['animationSpeed'],
			'exclude'                 => true,
                        'default'                 => '600',
			'inputType'               => 'text',
			'eval'                    => array('rgxp'=>'digit', 'maxlength'=>255, 'tl_class'=>'w50'),
			'sql'                     => "varchar(128) NOT NULL default ''"
		),
		'initDelay' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_jedo_flexslider']['initDelay'],
			'exclude'                 => true,
                        'default'                 => '0',
			'inputType'               => 'text',
			'eval'                    => array('rgxp'=>'digit', 'mandatory'=>true, 'maxlength'=>255, 'tl_class'=>'w50'),
			'sql'                     => "varchar(128) NOT NULL default ''"
		),
                'randomize' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_jedo_flexslider']['randomize'],
			'exclude'                 => true,
                        	'default'                 => 'false',
			'inputType'               => 'select',
                        	'options'                 => array('true', 'false'),
			'reference'               => &$GLOBALS['TL_LANG']['tl_jedo_flexslider'],
			'eval'                    => array('tl_class'=>'w50'),
			'sql'                     => "varchar(128) NOT NULL default ''"
		),

// Usability features

                'pauseOnAction' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_jedo_flexslider']['pauseOnAction'],
			'exclude'                 => true,
                        	'default'                 => 'true',
			'inputType'               => 'select',
                        	'options'                 => array('true', 'false'),
			'reference'               => &$GLOBALS['TL_LANG']['tl_jedo_flexslider'],
			'eval'                    => array('tl_class'=>'w50'),
			'sql'                     => "varchar(255) NOT NULL default ''"
		),
                'pauseOnHover' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_jedo_flexslider']['pauseOnHover'],
			'exclude'                 => true,
                        	'default'                 => 'false',
			'inputType'               => 'select',
                        	'options'                 => array('true', 'false'),
			'reference'               => &$GLOBALS['TL_LANG']['tl_jedo_flexslider'],
			'eval'                    => array('tl_class'=>'w50'),
			'sql'                     => "varchar(255) NOT NULL default ''"
		),
                'useCSS' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_jedo_flexslider']['useCSS'],
			'exclude'                 => true,
                        	'default'                 => 'true',
			'inputType'               => 'select',
                        	'options'                 => array('true', 'false'),
			'reference'               => &$GLOBALS['TL_LANG']['tl_jedo_flexslider'],
			'eval'                    => array('tl_class'=>'w50'),
			'sql'                     => "varchar(255) NOT NULL default ''"
		),
                'touch' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_jedo_flexslider']['touch'],
			'exclude'                 => true,
                        	'default'                 => 'true',
			'inputType'               => 'select',
                        	'options'                 => array('true', 'false'),
			'reference'               => &$GLOBALS['TL_LANG']['tl_jedo_flexslider'],
			'eval'                    => array('tl_class'=>'w50'),
			'sql'                     => "varchar(255) NOT NULL default ''"
		),
                'video' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_jedo_flexslider']['video'],
			'exclude'                 => true,
                        	'default'                 => 'false',
			'inputType'               => 'select',
                        	'options'                 => array('true', 'false'),
			'reference'               => &$GLOBALS['TL_LANG']['tl_jedo_flexslider'],
			'eval'                    => array('tl_class'=>'w50'),
			'sql'                     => "varchar(255) NOT NULL default ''"
		),


//Primary Controls

                'controlNav' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_jedo_flexslider']['controlNav'],
			'exclude'                 => true,
                        	'default'                 => 'true',
			'inputType'               => 'select',
                        	'options'                 => array('true', 'false'),
			'reference'               => &$GLOBALS['TL_LANG']['tl_jedo_flexslider'],
			'eval'                    => array('tl_class'=>'w50'),
			'sql'                     => "varchar(255) NOT NULL default ''"
		),
                'directionNav' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_jedo_flexslider']['directionNav'],
			'exclude'                 => true,
                        	'default'                 => 'true',
			'inputType'               => 'select',
                        	'options'                 => array('true', 'false'),
			'reference'               => &$GLOBALS['TL_LANG']['tl_jedo_flexslider'],
			'eval'                    => array('tl_class'=>'w50'),
			'sql'                     => "varchar(255) NOT NULL default ''"
		),


		'prevText' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_jedo_flexslider']['prevText'],
			'exclude'                 => true,
                        'default'                 => &$GLOBALS['TL_LANG']['tl_jedo_flexslider']['prevText'],
			'inputType'               => 'text',
			'eval'                    => array('maxlength'=>255, 'tl_class'=>'w50'),
			'sql'                     => "varchar(128) NOT NULL default ''"
		),
		'nextText' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_jedo_flexslider']['nextText'],
			'exclude'                 => true,
                        'default'                 => &$GLOBALS['TL_LANG']['tl_jedo_flexslider']['nextText'],
			'inputType'               => 'text',
			'eval'                    => array('maxlength'=>255, 'tl_class'=>'w50'),
			'sql'                     => "varchar(128) NOT NULL default ''"
		),

// Secondary Navigation

                'keyboard' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_jedo_flexslider']['keyboard'],
			'exclude'                 => true,
                        	'default'                 => 'true',
			'inputType'               => 'select',
                        	'options'                 => array('true', 'false'),
			'reference'               => &$GLOBALS['TL_LANG']['tl_jedo_flexslider'],
			'eval'                    => array('tl_class'=>'w50'),
			'sql'                     => "varchar(128) NOT NULL default ''"
		),
                'multipleKeyboard' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_jedo_flexslider']['multipleKeyboard'],
			'exclude'                 => true,
                        	'default'                 => 'false',
			'inputType'               => 'select',
                        	'options'                 => array('true', 'false'),
			'reference'               => &$GLOBALS['TL_LANG']['tl_jedo_flexslider'],
			'eval'                    => array('tl_class'=>'w50'),
			'sql'                     => "varchar(128) NOT NULL default ''"
		),
                'mousewheel' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_jedo_flexslider']['mousewheel'],
			'exclude'                 => true,
                        	'default'                 => 'false',
			'inputType'               => 'select',
                        	'options'                 => array('true', 'false'),
			'reference'               => &$GLOBALS['TL_LANG']['tl_jedo_flexslider'],
			'eval'                    => array('tl_class'=>'w50'),
			'sql'                     => "varchar(128) NOT NULL default ''"
		),
                'pausePlay' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_jedo_flexslider']['pausePlay'],
			'exclude'                 => true,
                        	'default'                 => 'false',
			'inputType'               => 'select',
                        	'options'                 => array('true', 'false'),
			'reference'               => &$GLOBALS['TL_LANG']['tl_jedo_flexslider'],
			'eval'                    => array('tl_class'=>'w50'),
			'sql'                     => "varchar(128) NOT NULL default ''"
		),
		'pauseText' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_jedo_flexslider']['pauseText'],
			'exclude'                 => true,
                        'default'                 => &$GLOBALS['TL_LANG']['tl_jedo_flexslider']['pauseText'],
			'inputType'               => 'text',
			'eval'                    => array('maxlength'=>255, 'tl_class'=>'w50'),
			'sql'                     => "varchar(128) NOT NULL default ''"
		),
		'playText' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_jedo_flexslider']['playText'],
			'exclude'                 => true,
                        'default'                 => &$GLOBALS['TL_LANG']['tl_jedo_flexslider']['playText'],
			'inputType'               => 'text',
			'eval'                    => array('maxlength'=>255, 'tl_class'=>'w50'),
			'sql'                     => "varchar(128) NOT NULL default ''"
		),

// Special properties

                'asNavSlider' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_jedo_flexslider']['asNavSlider'],
                        'exclude'                 => true,
                        'filter'                  => true,
                        'flag'                    => 2,
                        'inputType'               => 'checkbox',
                        'eval'                    => array('helpwizard'=>true, 'doNotCopy'=>true, 'tl_class'=>'m12'),
			'sql' => "char(1) NOT NULL default ''"
		),


		'sync' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_jedo_flexslider']['sync'],
			'exclude'                 => true,
                        'default'                 => "",
			'inputType'               => 'text',
			'eval'                    => array('helpwizard'=>true, 'maxlength'=>255, 'tl_class'=>'w50'),
			'sql'                     => "varchar(128) NOT NULL default ''"
		),
		'asNavFor' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_jedo_flexslider']['asNavFor'],
			'exclude'                 => true,
                        'default'                 => "",
			'inputType'               => 'text',
			'eval'                    => array('helpwizard'=>true, 'maxlength'=>255, 'tl_class'=>'w50'),
			'sql'                     => "varchar(128) NOT NULL default ''"
		),











                'published' => array
                (
                        'label'                   => &$GLOBALS['TL_LANG']['tl_jedo_flexslider']['published'],
                        'exclude'                 => true,
                        'filter'                  => true,
                        'flag'                    => 2,
                        'inputType'               => 'checkbox',
                        'eval'                    => array('doNotCopy'=>true, 'tl_class'=>'w50 m12'),
		'sql' => "char(1) NOT NULL default ''"
                )
	)
);


/**
 * Class tl_jedo_flexslider
 *
 * Provide miscellaneous methods that are used by the data configuration array.
 * @package Controller
 */
class tl_jedo_flexslider extends \Backend {
	public function __construct()
	{
		parent::__construct();
		$this->import('BackendUser', 'User');
	}


	public function getTransitions()
	{
		$arrResult = array();

		foreach(array('slide','linear','swing','quad','cubic','quart','quint','expo','circ','back','sine','bounce','elastic') as $t)
		{
			$arrResult[$t] = $t;
			if(($t == 'linear') || ($t == 'slide') || ($t == 'swing')) continue;

			$arrResult[$t.':in'] = $t.':in';
			$arrResult[$t.':out'] = $t.':out';
			$arrResult[$t.':in:out'] = $t.':in:out';
		}

		return $arrResult;
	}



    public function addPicturesNumber($row, $label) {

        $objElements = \Database::getInstance()->prepare("SELECT * FROM tl_jedo_flexslider_items WHERE pid=? ORDER by sorting")
                ->execute($row['id']);
	
		if ($objElements->numRows > 0)
		{
			while ($objElements->next())
			{
				if ($objElements->itemtype == "imagetype")
				{
				$objFile = \FilesModel::findByPk($objElements->singleSRC);

				if ($objFile === null || !is_file(TL_ROOT . '/' . $objFile->path))
				{
					return '';
				}

				$File = new \File($objFile->path);

					if ($File->isGdImage)
					{
						$x++;
						$arrElements[$x]['image'] = \Image::get($File->path, 100, 50, 'box');
					}
				} elseif ($objElements->itemtype == "videotype")
				{
					$File = new \File('system/modules/jedo-flexslider/assets/images/flex_video.jpg');

					if ($File->isGdImage)
					{
						$x++;
						$arrElements[$x]['image'] = \Image::get($File->path, 100, 50, 'box');
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
			$OutputImages = $GLOBALS['TL_LANG']['tl_jedo_flexslider']['misc_elements'];
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

        $objAlias = \Database::getInstance()->prepare("SELECT id FROM tl_jedo_flexslider WHERE id=? OR alias=?")
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

	public function editHeader($row, $href, $label, $title, $icon, $attributes)
	{
		return ($this->User->isAdmin) ? '<a href="'.$this->addToUrl($href.'&amp;id='.$row['id']).'" title="'.specialchars($title).'"'.$attributes.'>'.$this->generateImage($icon, $label).'</a> ' : $this->generateImage(preg_replace('/\.gif$/i', '_.gif', $icon)).' ';
	}

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

        $this->createInitialVersion('tl_jedo_flexslider', $intId);

        // Trigger the save_callback
        if (is_array($GLOBALS['TL_DCA']['tl_jedo_flexslider']['fields']['published']['save_callback'])) {

            foreach ($GLOBALS['TL_DCA']['tl_jedo_flexslider']['fields']['published']['save_callback'] as $callback) {

                $this->import($callback[0]);
                $blnVisible = $this->$callback[0]->$callback[1]($blnVisible, $this);
            }
        }

        // Update the database
        \Database::getInstance()->prepare("UPDATE tl_jedo_flexslider SET published='" . ($blnVisible ? 1 : '') . "' WHERE id=?")
                ->execute($intId);

        $this->createNewVersion('tl_jedo_flexslider', $intId);

    }
}

?>