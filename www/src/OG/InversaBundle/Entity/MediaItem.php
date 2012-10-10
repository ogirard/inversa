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
      // delete existing (old) image
      $this->deleteFile();
    }

    $originalName = $this->mediafile->getClientOriginalName();
    $noSpecialCharsName = strtr($originalName, 'ŠŒŽšœžŸ¥µÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝßàáâãäåæçèéêëìíîïðñòóôõöøùúûüýÿ ',
        'SOZsozYYuAAAAAAACEEEEIIIIDNOOOOOOUUUUYsaaaaaaaceeeeiiiionoooooouuuuyy_');

    $this->path = strtolower($noSpecialCharsName);
    $this->doctype = $this->mediafile->guessExtension();

    if ($this->path && ($this->doctype == null || $this->doctype == "")) {
      $parts = explode('.', $this->path);
      if (count($parts) > 0) {
        $this->doctype = $parts[count($parts) - 1];
      }
    }
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