<?php

namespace OG\InversaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * OG\InversaBundle\Entity\MediaItem
 */
class MediaItem
{
  /**
   * @var integer $id
   */
  private $id;

  /**
   * @var string $name
   */
  private $name;

  /**
   * @var text $description
   */
  private $description;

  /**
   * @var boolean $isactive
   */
  private $isactive;

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
   * Set isactive
   *
   * @param boolean $isactive
   */
  public function setIsactive($isactive)
  {
    $this->isactive = $isactive;
  }

  /**
   * Get isactive
   *
   * @return boolean 
   */
  public function getIsactive()
  {
    return $this->isactive;
  }

  public function __construct()
  {
    $this->isactive = true;
  }
  /**
   * @var string $doctype
   */
  private $doctype;

  /**
   * @var string $path
   */
  private $path;

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

  public function getMediaType()
  {
    return $this->getDoctype() == "mp3" || $this->getDoctype() == "wav" || $this->getDoctype() == "mpeg" ? "Audio" : "Video";
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

  private $mediafile;

  /**
   * Set media file
   *
   * @param string $file
   */
  public function setMediafile($mediafile)
  {
    $this->mediafile = $mediafile;
  }

  /**
   * Get media file
   *
   * @return string
   */
  public function getMediafile()
  {
    return $this->mediafile;
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
    return 'uploads/media/' . $this->doctype;
  }

  /**
   * @ORM\prePersist
   */
  public function preUpload()
  {
  	if (null === $this->mediafile) {
  	  return;
  	}
  	
  	if ($this->path !== null) {
  	  // delete existing (old) file
  	  $this->deleteFile();
  	}
  	
  	$originalName = $this->mediafile->getClientOriginalName();
  	$noSpecialCharsName = str_replace("\'", "", $originalName);
  	$noSpecialCharsName = str_replace("\"", "", $noSpecialCharsName);
  	$noSpecialCharsName = str_replace(" ", "_", $noSpecialCharsName);
  	$noSpecialCharsName = str_replace("è", "e", $noSpecialCharsName);
  	$noSpecialCharsName = str_replace("é", "e", $noSpecialCharsName);
  	$noSpecialCharsName = str_replace("ê", "e", $noSpecialCharsName);
  	$noSpecialCharsName = str_replace("ë", "e", $noSpecialCharsName);
  	$noSpecialCharsName = str_replace("à", "a", $noSpecialCharsName);
  	$noSpecialCharsName = str_replace("á", "a", $noSpecialCharsName);
  	$noSpecialCharsName = str_replace("ä", "a", $noSpecialCharsName);
  	$noSpecialCharsName = str_replace("â", "a", $noSpecialCharsName);
  	$noSpecialCharsName = str_replace("î", "i", $noSpecialCharsName);
  	$noSpecialCharsName = str_replace("ï", "i", $noSpecialCharsName);
  	$noSpecialCharsName = str_replace("ì", "i", $noSpecialCharsName);
  	$noSpecialCharsName = str_replace("í", "i", $noSpecialCharsName);
  	$noSpecialCharsName = str_replace("ô", "o", $noSpecialCharsName);
  	$noSpecialCharsName = str_replace("ò", "o", $noSpecialCharsName);
  	$noSpecialCharsName = str_replace("ó", "o", $noSpecialCharsName);
  	$noSpecialCharsName = str_replace("ö", "o", $noSpecialCharsName);
  	$noSpecialCharsName = str_replace("ù", "u", $noSpecialCharsName);
  	$noSpecialCharsName = str_replace("ú", "u", $noSpecialCharsName);
  	$noSpecialCharsName = str_replace("ü", "u", $noSpecialCharsName);
  	$noSpecialCharsName = str_replace("û", "u", $noSpecialCharsName);
  	$noSpecialCharsName = str_replace("É", "E", $noSpecialCharsName);
  	$noSpecialCharsName = str_replace("È", "E", $noSpecialCharsName);
  	$noSpecialCharsName = str_replace("Ë", "E", $noSpecialCharsName);
  	$noSpecialCharsName = str_replace("Ê", "E", $noSpecialCharsName);
  	$noSpecialCharsName = str_replace("À", "A", $noSpecialCharsName);
  	$noSpecialCharsName = str_replace("Á", "A", $noSpecialCharsName);
  	$noSpecialCharsName = str_replace("Ä", "A", $noSpecialCharsName);
  	$noSpecialCharsName = str_replace("Â", "A", $noSpecialCharsName);
  	$noSpecialCharsName = str_replace("Ì", "I", $noSpecialCharsName);
  	$noSpecialCharsName = str_replace("Î", "I", $noSpecialCharsName);
  	$noSpecialCharsName = str_replace("Ï", "I", $noSpecialCharsName);
  	$noSpecialCharsName = str_replace("Í", "I", $noSpecialCharsName);
  	$noSpecialCharsName = str_replace("Ô", "O", $noSpecialCharsName);
  	$noSpecialCharsName = str_replace("Ò", "O", $noSpecialCharsName);
  	$noSpecialCharsName = str_replace("Ó", "O", $noSpecialCharsName);
  	$noSpecialCharsName = str_replace("Ö", "O", $noSpecialCharsName);
  	$noSpecialCharsName = str_replace("Ü", "U", $noSpecialCharsName);
  	$noSpecialCharsName = str_replace("Û", "U", $noSpecialCharsName);
  	$noSpecialCharsName = str_replace("Ú", "U", $noSpecialCharsName);
  	$noSpecialCharsName = str_replace("Ù", "U", $noSpecialCharsName);
  	$noSpecialCharsName = str_replace("ç", "C", $noSpecialCharsName);
  	$noSpecialCharsName = str_replace("ç", "C", $noSpecialCharsName);
  	
  	$this->path = strtolower($noSpecialCharsName);
  	$this->doctype = $this->mediafile->guessExtension();
  }

  /**
   * @ORM\postPersist
   */
  public function upload()
  {
    if (null === $this->mediafile) {
      return;
    }

    $this->mediafile->move($this->getUploadRootDir(), $this->id . '_' . $this->path);

    unset($this->mediafile);
  }

  /**
   * @ORM\postRemove
   */
  public function removeUpload()
  {
    $this->deleteFile();
  }

  public function deleteFile()
  {
    if ($fileName = $this->getAbsolutePath()) {
      if (file_exists($fileName)) {
        unlink($fileName);
      }
    }
  }
  /**
   * @var OG\InversaBundle\Entity\Image
   */
  private $image;

  /**
   * Set image
   *
   * @param OG\InversaBundle\Entity\Image $image
   */
  public function setImage(\OG\InversaBundle\Entity\Image $image)
  {
    $this->image = $image;
  }

  /**
   * Get image
   *
   * @return OG\InversaBundle\Entity\Image 
   */
  public function getImage()
  {
    return $this->image;
  }

  public function getPlayerdoctype()
  {
    switch ($this->getDoctype()) {
    case "mp3":
    case "mpeg":
      return "mp3";
    case "wav":
      return "wav";
    case "avi":
      return "avi"; // porbably not supported
    case null: // handle unknown MIME type
    case "mp4":
    case "m4v":
      return "m4v";
    }
  }
}