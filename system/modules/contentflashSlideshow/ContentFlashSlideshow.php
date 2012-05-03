<?php
if (!defined('TL_ROOT')) die('You cannot access this file directly!');

/**
 * Contao Open Source CMS
 * Copyright (C) 2005-2011 Leo Feyer
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
 * @copyright  MEN AT WORK 2012
 * @package    ContentFlashSlideshow
 * @license    GNU/LGPL
 * @filesource
 */

/**
 * Class ContentFlashSlideshow
 *
 * Frontend content element flash.
 * @copyright  MEN AT WORK 2012
 * @package    ContentFlashSlideshow
 */
class ContentFlashSlideshow extends Frontend
{

    public function addSlideShow($arrFlashVars, $objCeFlash)
    {

        $arrImages = deserialize($objCeFlash->fl_multiSRC);
        //add an image, if only one image was selected
        if (count($arrImages) == 1)
        {
            $objCeFlash->Template->useAltImg = true;
            $objCeFlash->Template->altImg = $arrImages[0];
        }

        //add a slideshow, if more than one image was selected
        if (count($arrImages) > 1)
        {
            $objCeFlash->Template->useAltImg = false;
            $objCeFlash->Template->useSlideShow = true;
            $objFile = new File($arrImages[0]);
            $arrAttributes = array(
                // ID of the slider container
                'containerId' => 'ce_slider_' . $objCeFlash->id,
                'itemsDimension' => array($objFile->width, $objFile->height),
                'templateDefault' => TRUE,
                'autoSlideDefault' => TRUE,
                'autoSlide' => 2000,
                'itemsMargin' => array('top' => 0, 'right' => 0, 'bottom' => 0, 'left' => 0, 'unit' => 'px')
            );

            $objSlider = new slideItMoo($arrAttributes);
            $objCeFlash->Template->arrSlideShowImages = $arrImages;
            $objCeFlash->Template->slideShow = $objSlider->parse();
            $objCeFlash->Template->containerId = 'ce_slider_' . $objCeFlash->id;
        }
        
        return;
    }

}

?>