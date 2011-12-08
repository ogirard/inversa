<?php

/**
 * SyrinxCalendar
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    syrinx
 * @subpackage model
 * @author     Olivier Girard
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
class SyrinxCalendar extends BaseSyrinxCalendar {

    public function getFiles() {
        $result = array();
        if ($this->getFile1() !== null && $this->getFile1() !== "" && $this->getFile1Name() !== null) {
            $result[$this->getFile1Name()] = $this->getFile1();
        }
        if ($this->getFile2() !== null && $this->getFile2() !== "" && $this->getFile2Name() !== null) {
            $result[$this->getFile2Name()] = $this->getFile2();
        }
        if ($this->getFile3() !== null && $this->getFile3() !== "" && $this->getFile3Name() !== null) {
            $result[$this->getFile3Name()] = $this->getFile3();
        }
        if ($this->getFile4() !== null && $this->getFile4() !== "" && $this->getFile4Name() !== null) {
            $result[$this->getFile4Name()] = $this->getFile4();
        }
        return $result;
    }

    public function getLinks() {
        $result = array();
        if ($this->getLink1() !== null && $this->getLink1() !== "" && $this->getLink1Name() !== null) {
            $result[$this->getLink1Name()] = $this->getLink1();
        }
        if ($this->getLink2() !== null && $this->getLink2() !== "" && $this->getLink2Name() !== null) {
            $result[$this->getLink2Name()] = $this->getLink2();
        }
        return $result;
    }

    public function hasInfos() {
        return count($this->getLinks()) + count($this->getFiles()) > 0;
    }

    public function getThumbImage() {
        return 'thumb_'.$this->getImage();
    }

    public function postDelete($event) {      
        @unlink(sfConfig::get('sf_upload_dir').'/calendar/images/'.$this->getImage());
        @unlink(sfConfig::get('sf_upload_dir').'/calendar/images/'.$this->getThumbImage());
        foreach ($this->getFiles() as $name => $path) {
            @unlink(sfConfig::get('sf_upload_dir').'/calendar/files/'.$path);
        }
    }
}
