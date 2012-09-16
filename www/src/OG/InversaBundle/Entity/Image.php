<?php

namespace OG\InversaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * OG\InversaBundle\Entity\Image
 */
class Image
{
  /**
   * @var integer $id
   */
  private $id;

  /**
   * @var string $name
   */
  private $name = "";

  /**
   * @var text $description
   */
  private $description;

  /**
   * @var string $path
   */
  private $path;

  /**
   * @var string $doctype
   */
  private $doctype = "";

  public function isValid()
  {
  	// image type is valid if none or both values name and path are set
    return false && (empty($this->name) && empty($this->path) || !empty($this->name) && !empty($this->path));
  }

  /**
   * Get id
   *
   * @return integer 
   */
  public function getId()
  {
    return $this->id;
  }

  /**
   * Set name
   *
   * @param string $name
   */
  public function setName($name)
  {
    $this->name = $name;
  }

  /**
   * Get name
   *
   * @return string 
   */
  public function getName()
  {
    return $this->name;
  }

  /**
   * Set description
   *
   * @param text $description
   */
  public function setDescription($description)
  {
    $this->description = $description;
  }

  /**
   * Get description
   *
   * @return text 
   */
  public function getDescription()
  {
    return $this->description;
  }

  /**
   * Set path
   *
   * @param string $path
   */
  public function setPath($path)
  {
    $this->path = $path;
  }

  /**
   * Get path
   *
   * @return string 
   */
  public function getPath()
  {
    return $this->path;
  }

  /**
   * Set doctype
   *
   * @param string $doctype
   */
  public function setDoctype($doctype)
  {
    $this->doctype = $doctype;
  }

  /**
   * Get doctype
   *
   * @return string
   */
  public function getDoctype()
  {
    return $this->doctype;
  }

  /**
   * @var OG\InversaBundle\Entity\AgendaItem
   */
  private $agendaitem;

  /**
   * Set agendaitem
   *
   * @param OG\InversaBundle\Entity\AgendaItem $agendaitem
   */
  public function setAgendaitem(\OG\InversaBundle\Entity\AgendaItem $agendaitem)
  {
    $this->agendaitem = $agendaitem;
  }

  /**
   * Get agendaitem
   *
   * @return OG\InversaBundle\Entity\AgendaItem 
   */
  public function getAgendaitem()
  {
    return $this->agendaitem;
  }
  /**
   * @var OG\InversaBundle\Entity\ProjectItem
   */
  private $projectitem;

  /**
   * Set projectitem
   *
   * @param OG\InversaBundle\Entity\ProjectItem $projectitem
   */
  public function setProjectitem(\OG\InversaBundle\Entity\ProjectItem $projectitem)
  {
    $this->projectitem = $projectitem;
  }

  /**
   * Get projectitem
   *
   * @return OG\InversaBundle\Entity\ProjectItem 
   */
  public function getProjectitem()
  {
    return $this->projectitem;
  }
  /**
   * @var OG\InversaBundle\Entity\PressItem
   */
  private $pressitem;

  /**
   * @var OG\InversaBundle\Entity\GalleryItem
   */
  private $galleryitem;

  /**
   * Set pressitem
   *
   * @param OG\InversaBundle\Entity\PressItem $pressitem
   */
  public function setPressitem(\OG\InversaBundle\Entity\PressItem $pressitem)
  {
    $this->pressitem = $pressitem;
  }

  /**
   * Get pressitem
   *
   * @return OG\InversaBundle\Entity\PressItem 
   */
  public function getPressitem()
  {
    return $this->pressitem;
  }

  /**
   * Set galleryitem
   *
   * @param OG\InversaBundle\Entity\GalleryItem $galleryitem
   */
  public function setGalleryitem(\OG\InversaBundle\Entity\GalleryItem $galleryitem)
  {
    $this->galleryitem = $galleryitem;
  }

  /**
   * Get galleryitem
   *
   * @return OG\InversaBundle\Entity\GalleryItem 
   */
  public function getGalleryitem()
  {
    return $this->galleryitem;
  }

  private $file;

  /**
   * Set file
   *
   * @param string $file
   */
  public function setFile($file)
  {
    $this->file = $file;
  }

  /**
   * Get file
   *
   * @return string
   */
  public function getFile()
  {
    return $this->file;
  }

  public function getAbsolutePath()
  {
    return null === $this->path ? null : $this->getUploadRootDir() . '/' . $this->id . '_' . $this->path;
  }

  public function getWebPath()
  {
    return null === $this->path ? null : $this->getUploadDir() . '/' . $this->id . '_' . $this->path;
  }

  protected function getUploadRootDir()
  {
    // the absolute directory path where uploaded documents should be saved
    return __DIR__ . '/../../../../web/' . $this->getUploadDir();
  }

  protected function getUploadDir()
  {
    // get rid of the __DIR__ so it doesn't screw when displaying uploaded doc/image in the view.
    return 'uploads/images/' . $this->doctype;
  }

  /**
   * @ORM\prePersist
   */
  public function preUpload()
  {
    if (null === $this->file) {
      return;
    }

    if ($this->path !== null) {
      // delete existing (old) image
      $this->deleteImage();
    }

    $originalName = $this->file->getClientOriginalName();
    $noSpecialCharsName = strtr($originalName, 'ŠŒŽšœžŸ¥µÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝßàáâãäåæçèéêëìíîïðñòóôõöøùúûüýÿ ',
        'SOZsozYYuAAAAAAACEEEEIIIIDNOOOOOOUUUUYsaaaaaaaceeeeiiiionoooooouuuuyy_');

    $this->path = strtolower($noSpecialCharsName);
    $this->doctype = $this->file->guessExtension();
  }

  /**
   * @ORM\postPersist
   */
  public function upload()
  {
    if (null === $this->file) {
      return;
    }

    $this->saveImage();

    unset($this->file);
  }

  /**
   * @ORM\preRemove
   */
  public function removeUpload()
  {
    $this->deleteImage();
  }

  public function deleteImage()
  {
    if ($fileName = $this->getAbsolutePath()) {
      if (file_exists($fileName)) {
        unlink($fileName);
      }
    }
  }

  private function saveImage($maxWidth = 1280, $maxHeight = 1280)
  {
    $dir = $this->getUploadRootDir();
    $tempPath = 'temp_' . $this->id . '_' . $this->path;
    $absoluteTempPath = $dir . '/' . $tempPath;
    $finalPath = $this->id . '_' . $this->path;
    $absoluteFinalPath = $dir . '/' . $finalPath;

    $this->file->move($dir, $tempPath);

    // Get image size.
    list($oldWidth, $oldHeight, $imageType) = getimagesize($absoluteTempPath);

    if ($oldWidth <= $maxWidth && $oldHeight <= $maxHeight || !extension_loaded('gd') && !extension_loaded('gd2')) {
      // save original file to final path
      rename($absoluteTempPath, $absoluteFinalPath);
      return false;
    }

    switch ($imageType) {
    case IMAGETYPE_GIF:
      $srcImg = imagecreatefromgif($absoluteTempPath);
      break;
    case IMAGETYPE_JPEG:
      $srcImg = imagecreatefromjpeg($absoluteTempPath);
      break;
    case IMAGETYPE_PNG:
      $srcImg = imagecreatefrompng($absoluteTempPath);
      break;
    case IMAGETYPE_BMP:
    case IMAGETYPE_WBMP:
      $srcImg = imagecreatefromwbmp($absoluteTempPath);
      break;
    default:
      trigger_error('Unsupported filetype.', E_USER_WARNING);
      break;
    }

    if (!$srcImg) {
      // delete temp file    	
      if (file_exists($absoluteTempPath)) {
        unlink($absoluteTempPath);
      }

      return false;
    }

    if ($oldHeight > $oldWidth) {
      $newHeight = $maxHeight;
      $newWidth = round($oldWidth / $oldHeight * $maxHeight);
    } else {
      $newWidth = $maxWidth;
      $newHeight = round($oldHeight / $oldWidth * $maxWidth);
    }

    $newImg = imagecreatetruecolor($newWidth, $newHeight);

    // If this image is a PNG or GIF set alpha channel.
    if ($imageType == IMAGETYPE_GIF || $imageType == IMAGETYPE_PNG) {
      imagealphablending($newImg, false);
      imagesavealpha($newImg, true);
      $alpha = imagecolorallocatealpha($newImg, 255, 255, 255, 127);
      imagefilledrectangle($newImg, 0, 0, $newWidth, $newHeight, $alpha);
    }

    // copy and resize
    imagecopyresized($newImg, $srcImg, 0, 0, 0, 0, $newWidth, $newHeight, $oldWidth, $oldHeight);

    // create and save the file
    switch ($imageType) {
    case IMAGETYPE_GIF:
      imagegif($newImg, $absoluteFinalPath);
      break;
    case IMAGETYPE_JPEG:
      imagejpeg($newImg, $absoluteFinalPath);
      break;
    case IMAGETYPE_PNG:
      imagepng($newImg, $absoluteFinalPath);
      break;
    case IMAGETYPE_BMP:
    case IMAGETYPE_WBMP:
      imagewbmp($newImg, $absoluteFinalPath);
      break;
    default:
      trigger_error('Failed to create scaled image.', E_USER_WARNING);
      break;
    }

    // delete temp file
    if (file_exists($absoluteTempPath)) {
      unlink($absoluteTempPath);
    }

    return true;
  }

  /**
   * ToString representation
   * @return number
   */
  public function __toString()
  {
    return "IMAGE_" . $this->id;
  }
}