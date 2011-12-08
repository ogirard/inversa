<?php

/**
 * Admin SyrinxProject form.
 *
 * @package    syrinx
 * @subpackage form
 * @author     Olivier Girard
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class AdminSyrinxProjectForm extends SyrinxProjectForm
{
    public function configure()
    {
        parent::configure();
 
 	     $this->validatorSchema['image'] = new sfValidatorFile(array(
                'required'   => false,
                'path'       => sfConfig::get('sf_upload_dir').'/project/images/',
                'mime_types' => 'web_images',
                'validated_file_class' => 'ProjectImageValidatedFile',
                ));     
                
        $this->widgetSchema['image'] = new sfWidgetFormInputFileEditable(array(
                'label'     => 'Bild',
                'file_src'  => '/uploads/project/images/'.$this->getObject()->getImage(),
                'is_image'  => true,
                'edit_mode' => !$this->isNew(),
                'template'  => '<div><div style="padding:0px; padding-top:5px; padding-bottom:10px; margin=0px"><img src="/uploads/project/images/thumb_'.$this->getObject()->getImage()
                                      . '" /></div><br />%input%<br />%delete% Bild enfernen</div>',
            ));
 
        $this->validatorSchema['image_delete'] = new CleanProjectImagesValidator();
        
        $cal = $this->getObject();
        $filenames = array($cal->getFile1(),$cal->getFile2(),$cal->getFile3(),$cal->getFile4());
        for($i = 0; $i < 4; $i++)
        {
				$file = 'file'.($i+1);
				$filename = ($filenames[$i] !== null && $filenames[$i] !== "") ? '/uploads/project/files/'.$filenames[$i] : '';
				$current = ($filename !== "") ? '<a href="'.$filename.'">Aktuelle Datei</a>' : 'Keine Datei';
				
            $this->validatorSchema[$file] = new sfValidatorFile(array(
                    'required'   => false,
                    'path'       => sfConfig::get('sf_upload_dir').'/project/files/',
                    'mime_types' => array ('application/pdf', 'application/zip'),
                    ));     
                    
            $this->widgetSchema[$file] = new sfWidgetFormInputFileEditable(array(
                    'label'     => 'Datei',
                    'file_src'  => $filename,
                    'is_image'  => false,
                    'edit_mode' => !$this->isNew(),
                    'template'  => '<div><b>'.$current .'</b><br/>%input%<br />%delete% Datei entfernen</div>',
                ));
 
            $this->validatorSchema[$file.'_delete'] = new sfValidatorPass();

        }
         
        $fields = $this->getWidgetSchema()->getFields();
        foreach ($fields as $f)
        {
        	  $c = get_class($f);
        	  if($c == 'sfWidgetFormInputText' || $c == 'sfWidgetFormTextarea')
        	  {
        	      $f->setAttribute("class", "formInput");
        	  }
        }
    }
}

class ProjectImageValidatedFile extends sfValidatedFile
{
  public function save($file = null, $fileMode = 0666, $create = true, $dirMode = 0777)
  {
    $fn = parent::save($file, $fileMode, $create, $dirMode);
    $this->WriteLog('Project Save...');

	$imagePath = sfConfig::get('sf_upload_dir')."/project/images/".$fn;
	$this->WriteLog('  Image = '.$imagePath);
	
	$thumbImagePath = sfConfig::get('sf_upload_dir')."/project/images/thumb_".$fn;
	$this->WriteLog('  Thumb Image = '.$thumbImagePath);
	
	$this->CreateThumbnail($imagePath, $thumbImagePath);
    return $fn;
  }

  function getFileMimeType($file) {
	if($this->endsWith($file, '.png'))
	{
	  return 'image/png';
	}
	if($this->endsWith($file, '.gif'))
	{
	  return 'image/gif';
	}

    return 'image/jpeg';
  }
  
  function endsWith($haystack, $needle) {
	return strrpos($haystack, $needle) === strlen($haystack)-strlen($needle);
  }
  
  private function WriteLog($message) {
     if (sfConfig::get('sf_logging_enabled')) {
        sfContext::getInstance()->getLogger()->info("##LOG: ".$message);
     }
  }
  
  function CreateThumbnail($imagePath, $thumbImagePath, $targetWidth = 180, $targetHeight = 240)
  {
    $this->WriteLog('Create Thumbnail');
	  
    $mimeType = $this->getFileMimeType($imagePath);
    $this->WriteLog('  MIME-Type = '.$mimeType);
	
    if($mimeType == "image/jpeg") { 
      $img = imagecreatefromjpeg($imagePath); 
    }
    else if($mimeType == "image/png") {  
      $img = imagecreatefrompng($imagePath); 
    }
    else if($mimeType == "image/gif") { 
      $img = imagecreatefromgif($imagePath); 
    }
  	
  	/* See if it failed */
    if(!$img)
    {
        /* Create a blank image */
        $img  = imagecreatetruecolor($targetWidth, $targetHeight);
        $bgc = imagecolorallocate($img, 255, 255, 255);
        $tc  = imagecolorallocate($img, 255, 0, 0);
    
        imagefilledrectangle($img, 0, 0, 300, 30, $bgc);
    
        /* Output an error message */
        imagestring($img, 1, 5, 5, 'Error loading image!', $tc);
    }
    
    $width = imagesx($img); 
    $height = imagesy($img);
    $imgRatio = ($width / $height);
    
    if ($imgRatio>1) { 
      $newWidth = (int)$targetWidth; 
      $newHeight = (int)($targetWidth / $imgRatio); 
    } else { 
      $newHeight = (int)$targetHeight; 
      $newWidth = (int)($targetHeight * $imgRatio); 
    } 
	
    $thumbImg = imagecreatetruecolor($newWidth, $newHeight);
    imagecopyresized($thumbImg, $img, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height); 
  	
  	if($mimeType == "image/jpeg") { 
      imagejpeg($thumbImg, $thumbImagePath);
    }
    else if($mimeType == "image/png") {  
      imagepng($thumbImg, $thumbImagePath);
    }
    else if($mimeType == "image/gif") { 
      imagegif($thumbImg, $thumbImagePath);
    }
  	
    imagedestroy($img); 
    imagedestroy($thumbImg); 
  }
}

class CleanProjectImagesValidator extends sfValidatorPass
{
  /**
  * @see sfValidatorBase
  */
  public function clean($value)
  {
    $res = parent::clean($value);
    $this->WriteLog("Clean ".$res);
    
    $dhandle = opendir(sfConfig::get('sf_upload_dir').'/project/images/');
    $neededthumbs = array();
    $thumbs = array();
    
    if ($dhandle) {
       // loop through all of the files
       while (false !== ($fname = readdir($dhandle))) {
          if (($fname != '.') && ($fname != '..') &&
    	  ($fname != basename($_SERVER['PHP_SELF']))) {
            if(!is_dir("./$fname")) {
              if($this->startsWith($fname, "thumb_")) {
                $thumbs[] = $fname;
              } else {
                $neededthumbs[] = "thumb_".$fname;
              }
            }
          }
       }
       // close the directory
       closedir($dhandle);
    }

    foreach($thumbs as $thumb) {
      if(!in_array($thumb, $neededthumbs)) {
        $this->WriteLog("Delete " . $thumb);
        unlink(sfConfig::get('sf_upload_dir').'/project/images/'.$thumb);
      }
    }
    return $res;
  }

  private function WriteLog($message) {
     if (sfConfig::get('sf_logging_enabled')) {
        sfContext::getInstance()->getLogger()->info("##LOG: ".$message);
     }
  }

  function startsWith($haystack, $needle)
  {
      $length = strlen($needle);
      return (substr($haystack, 0, $length) === $needle);
  }
  
  function endsWith($haystack, $needle)
  {
      $length = strlen($needle);
      $start =  $length *-1; //negative
      return (substr($haystack, $start, $length) === $needle);
  }

}
