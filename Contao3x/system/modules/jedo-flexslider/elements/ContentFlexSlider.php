<?php 
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

namespace FlexSlider;

class ContentFlexSlider extends \ContentElement {

    protected $strTemplate = 'ce_flexslider';

    public function generate() {

	if (TL_MODE == 'BE')
	{
		$objBackend  = \Database::getInstance()->prepare("SELECT * FROM tl_jedo_flexslider WHERE id=?")
			   ->execute($this->select_FlexSlider);

		$objElements = \Database::getInstance()->prepare("SELECT * FROM tl_jedo_flexslider_items WHERE pid=? AND published=1 ORDER by sorting ASC")
			   ->execute($objBackend->id);
					   
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
					$OutputImages .= '<img src="' . $element['image'] . '" alt="' . $element['alt'] . '" style="margin-right: 5px;" />';
				}
			}

		}
		else
		{
			$OutputImages = $GLOBALS['TL_LANG']['tl_jedoFlexSlider']['misc_elements'];
		}
		return '<div class="tl_gray" style="padding-bottom:6px;"><a href="contao/main.php?do=jedoflexslider&amp;table=tl_jedo_flexslider_items&amp;id='.$this->select_FlexSlider.'" title="Edit FlexSlider Pictures">' . $objBackend->title . ' (' . count($arrElements) . ' ' . $GLOBALS['TL_LANG']['tl_jedoflexslider']['misc_images'] . ')</a></div>
			' . $OutputImages;
						   
	}



	if (!$this->select_FlexSlider)
	{
		return '';
	}

        return parent::generate();
    }

    /**
     * Generate module
     */
    protected function compile() {
        $this->Template = new \FrontendTemplate('ce_flexslider');
        $FlexSlider = new ClassFlexSlider();
        $FlexSlider->compileListPicturesTemplate($this->select_FlexSlider, $this->Template);
    }
}
?>