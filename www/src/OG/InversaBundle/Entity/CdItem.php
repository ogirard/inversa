<?php

namespace OG\InversaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * OG\InversaBundle\Entity\CdItem
 */
class CdItem
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
   * @var text $songs
   */
  private $songs;

  /**
   * @var datetime $published
   */
  private $published;

  /**
   * @var boolean $isactive
   */
  private $isactive;

  /**
   * @var OG\InversaBundle\Entity\Image
   */
  private $image;

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
   * Set songs
   *
   * @param text $songs
   */
  public function setSongs($songs)
  {
    $this->songs = $songs;
  }

  /**
   * Get songs
   *
   * @return text 
   */
  public function getSongs()
  {
    return $this->songs;
  }

  /**
   * Set published
   *
   * @param datetime $published
   */
  public function setPublished($published)
  {
    $this->published = $published;
  }

  /**
   * Get published
   *
   * @return datetime 
   */
  public function getPublished()
  {
    return $this->published;
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

  public function __construct()
  {
    $this->isactive = true;
  }
}