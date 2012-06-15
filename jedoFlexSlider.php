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

class jedoFlexSlider extends Frontend {

    /**
     * Compiles the data for the list template
     *
     * @access public
     * @return null
     */
    public function compileListPicturesTemplate($database, $select_FlexSlider, $template) {

        // Test if the slideshow has pictures
        $ifPictures = true;

        $objSlider = $database->prepare("SELECT * FROM tl_jedoFlexSlider WHERE id=? AND published=1")
                ->limit(1)
                ->execute($select_FlexSlider);

        // Retrieve the current slideshow pictures
        $objPictures = $database->prepare("SELECT * FROM tl_jedoFlexSliderPictures WHERE pid=? AND published=1 ORDER BY sorting")
                ->execute($select_FlexSlider);

        if ($objSlider->numRows > 0) {
            while ($objSlider->next()) {
                $arrSlider[] = $objSlider->row();
            }
            $preferences = array_values($arrSlider);
            $template->preferences = $preferences;
        }
            $template->sliderdesign = $objSlider->theme;
        if ($objPictures->numRows > 0) {
            while ($objPictures->next()) {
                $imgSize = deserialize($objSlider->size);
                $srcImage = $this->getImage($this->urlEncode($objPictures->singleSRC), $imgSize[0], $imgSize[1], $imgSize[2]);
                $arrPictures[$objPictures->id] = array(
                    'name' => $objPictures->name,
                    'description' => $objPictures->description,
                    'alt' => $objPictures->alt,
                    'imageUrl' => $objPictures->imageUrl,
                    'singleSRC' => $srcImage
                );
            }

            $pictures = array_values($arrPictures);
            $template->pictures = $pictures;
            $template->ifPictures = $ifPictures;
        } else {
            $ifPictures = false;
            $template->ifPictures = $ifPictures;
        }
    }
    
    /**
     * Test if the jQuery extension is present or not
     * 
     * @access public
     * @return boolean
     */
    public function ifjQuery(){
        
        $this->import('Database');
        
        if($this->Database->fieldExists('usejquery','tl_layout')) {
            
            $ifjQuery = true;
        }
        else { 
	$ifjQuery = false;
        }
        return $ifjQuery;
    }
}

?>
