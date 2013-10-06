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
$GLOBALS['TL_DCA']['tl_jedo_flexslider_items'] = array
    (
    // Config
    'config' => array
        (
        'dataContainer'        => 'Table',
        'enableVersioning'     => true,
        'ptable'               => 'tl_jedo_flexslider',
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
            'mode' => 4,
            'fields' => array('sorting'),
            'filter' => true,
            'flag' => 11,
            'panelLayout' => 'search,limit',
            'headerFields' => array('title', 'size', 'animation', 'published'),
            'child_record_callback' => array('tl_jedo_flexslider_items', 'listPictures')
        ),
        'global_operations' => array
            (
            'all' => array
                (
                'label'           => &$GLOBALS['TL_LANG']['MSC']['all'],
                'href'            => 'act=select',
                'class'           => 'header_edit_all',
                'attributes'      => 'onclick="Backend.getScrollOffset();" accesskey="e"'
            )
        ),
        'operations' => array
            (
            'edit' => array
                (
                'label'           => &$GLOBALS['TL_LANG']['tl_jedo_flexslider_items']['edit'],
                'href'            => 'act=edit',
                'icon'            => 'edit.gif'
            ),
            'copy' => array
                (
                'label'           => &$GLOBALS['TL_LANG']['tl_jedo_flexslider_items']['copy'],
                'href'            => 'act=copy',
                'icon'            => 'copy.gif'
            ),
            'cut' => array
            (
                'label'           => &$GLOBALS['TL_LANG']['tl_jedo_flexslider_items']['cut'],
                'href'            => 'act=paste&amp;mode=cut',
                'icon'            => 'cut.gif'
            ),
            'delete' => array
                (
                'label'           => &$GLOBALS['TL_LANG']['tl_jedo_flexslider_items']['delete'],
                'href'            => 'act=delete',
                'icon'            => 'delete.gif',
                'attributes'      => 'onclick="if (!confirm(\'' . $GLOBALS['TL_LANG']['MSC']['deleteConfirm'] . '\')) return false; Backend.getScrollOffset();"'
            ),
            'toggle' => array
                (
                'label'           => &$GLOBALS['TL_LANG']['tl_jedo_flexslider_items']['toggle'],
                'icon'            => 'visible.gif',
                'attributes'      => 'onclick="Backend.getScrollOffset(); return AjaxRequest.toggleVisibility(this, %s);"',
                'button_callback' => array('tl_jedo_flexslider_items', 'toggleIcon')
            ),
            'show' => array
                (
                'label'           => &$GLOBALS['TL_LANG']['tl_jedo_flexslider_items']['show'],
                'href'            => 'act=show',
                'icon'            => 'show.gif'
            )
        )
    ),
    // Palettes
    'palettes' => array
        (
        '__selector__' => array('itemtype'),
        'imagetype' => '{name_legend},itemtype,title,alias;{picture_legend},singleSRC,description,alt,imageUrl;{publish_legend},published',
        'videotype' => '{name_legend},itemtype,title,alias;{picture_legend},singleSRC,description;{video_legend},playerSRC;{publish_legend},published'

    ),
    // Subpalettes
    'subpalettes' => array
        (
        '' => ''
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

        'itemtype' => array
	(
			'label'                   => &$GLOBALS['TL_LANG']['tl_jedo_flexslider_items']['ItemType'],
			'default'                 => 'imagetype',
			'exclude'                 => true,
			'inputType'               => 'select',
			'options'                 => array('imagetype', 'videotype'),
			'reference'               => &$GLOBALS['TL_LANG']['tl_content'],
			'eval'                    => array('helpwizard'=>true, 'submitOnChange'=>true),
			'sql'                     => "varchar(64) NOT NULL default ''"
	),

       'title' => array
            (
            'label'                   => &$GLOBALS['TL_LANG']['tl_jedo_flexslider_items']['title'],
            'exclude'                 => true,
            'search'                  => true,
            'inputType'               => 'text',
            'eval'                    => array('mandatory' => true, 'maxlength' => 255, 'tl_class' => 'w50'),
			'sql'                     => "varchar(64) NOT NULL default ''"
        ),
		'alias' => array
		(
                        'label'                   => &$GLOBALS['TL_LANG']['tl_jedo_flexslider']['alias'],
                        'exclude'                 => true,
                        'inputType'               => 'text',
                        'eval'                    => array('rgxp'=>'alnum', 'doNotCopy'=>true, 'spaceToUnderscore'=>true, 'maxlength'=>128, 'tl_class'=>'w50'),
                        'save_callback' => array
                        (
                                array('tl_jedo_flexslider_items', 'generateAlias')
                        ),
			'sql'                     => "varchar(255) NOT NULL default ''"
                ),
        'description' => array
            (
            'label'                   => &$GLOBALS['TL_LANG']['tl_jedo_flexslider_items']['description'],
            'exclude'                 => true,
            'search'                  => true,
            'inputType'               => 'textarea',
            'eval'                    => array('rte'=>'tinyMCE', 'helpwizard'=>true, 'mandatory' => false),
            'explanation'             => 'insertTags',
			'sql'                     => "text NULL"
        ),
        'singleSRC' => array
            (
            'label'                   => &$GLOBALS['TL_LANG']['tl_jedo_flexslider_items']['singleSRC'],
            'exclude'                 => true,
            'inputType'               => 'fileTree',
            'eval'                    => array('fieldType' => 'radio', 'files' => true, 'filesOnly' => true, 'mandatory' => true),
		'sql'	=> "varchar(255) NOT NULL default ''"
        ),
        'alt' => array
            (
            'label'                   => &$GLOBALS['TL_LANG']['tl_jedo_flexslider_items']['alt'],
            'exclude'                 => true,
            'inputType'               => 'text',
            'eval'                    => array('maxlength' => 255, 'tl_class' => 'w50'),
	'sql'		=> "varchar(255) NOT NULL default ''"
        ),
        'imageUrl' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_jedo_flexslider_items']['imageUrl'],
            'exclude'                 => true,
            'search'                  => true,
            'inputType'               => 'text',
            'eval'                    => array('rgxp'=>'url', 'decodeEntities'=>true, 'maxlength'=>255, 'tl_class'=>'w50 wizard'),
            'wizard' => array
            (
                    array('tl_jedo_flexslider_items', 'pagePicker')
            ),
	'sql'		=> "varchar(255) NOT NULL default ''"
        ),

		'playerSRC' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_content']['playerSRC'],
			'exclude'                 => true,
			'inputType'               => 'fileTree',
			'eval'                    => array('multiple'=>false, 'fieldType'=>'radio', 'files'=>true, 'mandatory'=>true),
			'sql'                     => "blob NULL"
		),

        'published' => array
            (
            'label'                   => &$GLOBALS['TL_LANG']['tl_jedo_flexslider_items']['published'],
            'exclude'                 => true,
            'filter'                  => true,
            'flag'                    => 2,
            'inputType'               => 'checkbox',
            'eval'                    => array('doNotCopy' => true, 'tl_class' => 'w50 m12'),
	'sql'	=> "char(1) NOT NULL default ''"
        )
    )
);

/**
 * Class tl_jedo_flexslider_items
 *
 * Provide miscellaneous methods that are used by the data configuration array.
 * @package Controller
 */
class tl_jedo_flexslider_items extends \Backend {

    /**
     * Add the type of input field
     *
     * @param array
     * @return string
     */
    public function listPictures($arrRow) {

        $key = ($arrRow['published']) ? 'published' : 'unpublished';

		if ($arrRow['itemtype'] == "imagetype")
		{
			$objFile = \FilesModel::findByPk($arrRow['singleSRC']);
			if ($objFile === null || !is_file(TL_ROOT . '/' . $objFile->path))
			{
				return '';
			}

			$arrRow['singleSRC'] = $objFile->path;
			$image = \Image::get($arrRow['singleSRC'], 150, 150, 'box');

 		}
		elseif ($arrRow['itemtype'] == "videotype")
		{
			$File = new \File('system/modules/jedo-flexslider/assets/images/flex_video.jpg');
			if ($File->isGdImage)
			{
				$image = \Image::get($File->path, 150, 150, 'box');
			}
		}

        return '
            <div class="cte_type ' . $key . '" style="color:#444;"> ' . $arrRow['title'] . '</div>
            <div class="limit_height h64 block' . (!$GLOBALS['TL_CONFIG']['doNotCollapse'] ? ' h52' : '') . ' block">'
            . '<div style="float: left; margin-right: 10px;"><img src="' . $image .'" /></div>'
            . '<strong>' . $GLOBALS['TL_LANG']['tl_jedo_flexslider_items']['descriptionBE'] . '</strong><br />' .  $arrRow['description'] .
            '</div>' . "\n";
    }

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

        $objAlias = \Database::getInstance()->prepare("SELECT id FROM tl_jedo_flexslider_items WHERE id=? OR alias=?")
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


    public function toggleIcon($row, $href, $label, $title, $icon, $attributes) {

        if (strlen($this->Input->get('tid'))) {

            $this->toggleVisibility($this->Input->get('tid'), ($this->Input->get('state') == 1));
            $this->redirect($this->getReferer());
        }

        $href .= '&amp;tid=' . $row['id'] . '&amp;state=' . ($row['published'] ? '' : 1);

        if (!$row['published']) {

            $icon = 'invisible.gif';
        }

        return '<a href="' . $this->addToUrl($href) . '" title="' . specialchars($title) . '"' . $attributes . '>' . $this->generateImage($icon, $label) . '</a> ';
    }

    /**
     * Disable/enable a user group
     * @param integer
     * @param boolean
     */
    public function toggleVisibility($intId, $blnVisible) {

        $this->createInitialVersion('tl_jedo_flexslider_items', $intId);

        // Trigger the save_callback
        if (is_array($GLOBALS['TL_DCA']['tl_jedo_flexslider_items']['fields']['published']['save_callback'])) {

            foreach ($GLOBALS['TL_DCA']['tl_jedo_flexslider_items']['fields']['published']['save_callback'] as $callback) {

                $this->import($callback[0]);
                $blnVisible = $this->$callback[0]->$callback[1]($blnVisible, $this);
            }
        }

        // Update the database
        \Database::getInstance()->prepare("UPDATE tl_jedo_flexslider_items SET published='" . ($blnVisible ? 1 : '') . "' WHERE id=?")
                ->execute($intId);

        $this->createNewVersion('tl_jedo_flexslider_items', $intId);
    }

    /**
     * Return the link picker wizard
     * @param object
     * @return string
     */
    public function pagePicker(DataContainer $dc)
    {
            $strField = 'ctrl_' . $dc->field . (($this->Input->get('act') == 'editAll') ? '_' . $dc->id : '');
            return ' ' . $this->generateImage('pickpage.gif', $GLOBALS['TL_LANG']['MSC']['pagepicker'], 'style="vertical-align:top; cursor:pointer;" onclick="Backend.pickPage(\'' . $strField . '\')"');
    }
}
?>