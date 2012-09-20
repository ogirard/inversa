<?php

namespace OG\InversaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * OG\InversaBundle\Entity\GalleryItem
 */
class GalleryItem
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
   * @var OG\InversaBundle\Entity\Image
   */
  private $images;

  public function __construct()
  {
    $this->images = new \Doctrine\Common\Collections\ArrayCollection();
    $this->isactive = true;
  }

  /**
   * Add image
   *
   * @param OG\InversaBundle\Entity\Image $image
   */
  public function addImage(\OG\InversaBundle\Entity\Image $image)
  {
    $this->images[] = $images;
  }

  /**
   * Get images
   *
   * @return Doctrine\Common\Collections\Collection 
   */
  public function getImages()
  {
    return $this->images;
  }

  /**
   * Set images
   *
   * @param Doctrine\Common\Collections\Collection $images
   */
  public function setImages($images)
  {
    $this->images = $images;
  }
  /**
   * @var datetime $published
   */
  private $published;

  /**
   * @var boolean $isactive
   */
  private $isactive;

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
   * @ORM\PrePersist
   */
  public function setCreatedValue()
  {
    $this->published = new \DateTime();
  }
}