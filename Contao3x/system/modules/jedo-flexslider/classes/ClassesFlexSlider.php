<?php

/**
 * Contao Open Source CMS
 * 
 * Copyright (C) 2005-2012 Leo Feyer
 * 
 * @package Core
 * @link    http://www.contao.org
 * @license http://www.gnu.org/licenses/lgpl-3.0.html LGPL
 */


/**
 * Run in a custom namespace, so the class can be replaced
 */
namespace  FlexSlider;


class ClassFlexSlider extends \Frontend {

    /**
     * Compiles the data for the list template
     *
     * @access public
     * @return null
     */
    public function compileListPicturesTemplate($select_FlexSlider, $template) {

        // Test if the slideshow has pictures
        $ifPictures = true;

        $objSlider = \Database::getInstance()->prepare("SELECT * FROM tl_jedo_flexslider WHERE id=? AND published=1")
                ->limit(1)
                ->execute($select_FlexSlider);

        // Retrieve the current slideshow pictures
        $objPictures = \Database::getInstance()->prepare("SELECT * FROM tl_jedo_flexslider_items WHERE pid=? AND published=1 ORDER BY sorting")
                ->execute($select_FlexSlider);

        if ($objSlider->numRows > 0) {
            while ($objSlider->next()) {
                $arrSlider[] = $objSlider->row();
            }
            $preferences = array_values($arrSlider);
            $template->preferences = $preferences;

        }



	if ($objPictures->numRows > 0) {
		while ($objPictures->next()) 
		{
			if ($objPictures->itemtype == "imagetype")
			{
				$objFile = \FilesModel::findByPk($objPictures->singleSRC);
				if ($objFile === null || !is_file(TL_ROOT . '/' . $objFile->path))
				{
					return '';
				}
	
				$image 	= new \File($objFile->path);
				$imgSize 	= deserialize($objSlider->size);
	
				$srcImage 	= \Image::get($image->path, $imgSize[0], $imgSize[1], $imgSize[2]);
                			$arrPictures[$objPictures->id] = array(
					'sourcetype'	=> $objPictures->itemtype,
                    			'name' 	=> $objPictures->name,
					'description' 	=> $objPictures->description,
					'alt' 		=> $objPictures->alt,
					'imageUrl' 	=> $objPictures->imageUrl,
					'singleSRC' 	=> $srcImage
				);

            		}
			elseif ($objPictures->itemtype == "videotype")
			{
				$source = deserialize($objPictures->playerSRC);
				$objFile = \FilesModel::findByPk($source);

				if ($objFile === null || !is_file(TL_ROOT . '/' . $objFile->path))
				{
					return '';
				}
				$videoSize 	= deserialize($objSlider->size);

                			$arrPictures[$objPictures->id] = array(
					'sourcetype'	=> $objPictures->itemtype,
                    			'name' 	=> $objPictures->name,
					'playertype' 	=> $objPictures->playertype,
					'mime' 	=> $objFile->extension,
					'width'		=> $videoSize[0],
					'height'	=> $videoSize[1],
					'playerSRC' 	=> $objFile->path
				);

	            	}
		}
          	$pictures = array_values($arrPictures);
            	$template->pictures = $pictures;
            	$template->ifPictures = $ifPictures;
        } else {
            $ifPictures = false;
            $template->ifPictures = $ifPictures;
        }

    }
}

?>
