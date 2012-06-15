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
class ContentFlexSlider extends ContentElement {

    protected $strTemplate = 'FlexSlider';

    public function generate() {

	if (TL_MODE == 'BE')
	{
		$objBackend  = $this->Database->prepare("SELECT * FROM tl_jedoFlexSlider WHERE id=?")
			   ->execute($this->select_FlexSlider);

		$objElements = $this->Database->prepare("SELECT * FROM tl_jedoFlexSliderPictures WHERE pid=? AND published=1 ORDER by sorting ASC")
			   ->execute($objBackend->id);
					   
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
					$OutputImages .= '<img src="' . $element['image'] . '" alt="' . $element['alt'] . '" style="margin-right: 5px;" />';
				}
			}

		}
		else
		{
			$OutputImages = $GLOBALS['TL_LANG']['tl_jedoFlexSlider']['misc_elements'];
		}
		return '<div class="tl_gray" style="padding-bottom:6px;"><a href="contao/main.php?do=jedojQueryFlexSlider&amp;table=tl_jedoFlexSliderPictures&amp;id='.$this->select_FlexSlider.'" title="Edit FlexSlider Pictures">' . $objBackend->title . ' (' . count($arrElements) . ' ' . $GLOBALS['TL_LANG']['tl_jedoFlexSlider']['misc_images'] . ')</a></div>
			' . $OutputImages;
						   
	}



	if (!$this->select_FlexSlider)
	{
		return '';
	}

        if (TL_MODE == 'FE') {
            $FlexSlider = new jedoFlexSlider();
            if(!$FlexSlider->ifjQuery())
            $GLOBALS['TL_JAVASCRIPT'][jedoFlexSlider] = 'system/modules/jedoFlexSlider/html/jquery-1.7.2.min.js';
        }

        return parent::generate();
    }

    /**
     * Generate module
     */
    protected function compile() {
        $this->Template = new FrontendTemplate('FlexSlider');
        $this->import('Database');
        $FlexSlider = new jedoFlexSlider();
        $FlexSlider->compileListPicturesTemplate($this->Database,$this->select_FlexSlider, $this->Template);
    }
}
?>