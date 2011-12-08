<?php

require_once dirname(__FILE__) . '/../lib/calendarGeneratorConfiguration.class.php';
require_once dirname(__FILE__) . '/../lib/calendarGeneratorHelper.class.php';

/**
 * calendar actions.
 *
 * @package    syrinx
 * @subpackage calendar
 * @author     Olivier Girard
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class calendarActions extends autoCalendarActions {

    protected function updateCalendarFromRequest() {
        $calendar = $this->getRequestParameter('calendar');

        if (!$this->getRequest()->hasErrors() && isset($calendar['image_delete'])) {
            // remove thumbnails
            $currentFile = sfConfig::get('sf_upload_dir') . '/calendar/images/thumbs/' . $this->calendar->getImage();
            if (is_file($currentFile)) {
                unlink($currentFile);
            }
        }

        parent::updateProductFromRequest();

        if (!$this->getRequest()->hasErrors() && $this->getRequest()->getFileSize('calendar[image]')) {
            // create thumbnail
            $fileName = $this->calendar->getImage();
            $thumbnail = new sfThumbnail(150, 150, true, false);
            $thumbnail->loadFile(sfConfig::get('sf_upload_dir') . "/calendar/images/" . $fileName);
            $thumbnail->save(sfConfig::get('sf_upload_dir') . '/calendar/images/thumbs/' . $fileName, 'image/jpeg');
        }
    }

    public function WriteLog($message) {
        $myFile = "/home/ogirard/Desktop/syrinx.log";
        $fh = fopen($myFile, 'w') or die("can't open file");
        fwrite($fh, $message . '\n');
        fclose($fh);
    }

}
