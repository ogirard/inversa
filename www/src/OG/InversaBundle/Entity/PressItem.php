<?php

namespace OG\InversaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * OG\InversaBundle\Entity\PressItem
 */
class PressItem
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
     * @var datetime $published
     */
    private $published;

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
     * @var OG\InversaBundle\Entity\Document
     */
    private $documents;

    /**
     * @var OG\InversaBundle\Entity\Image
     */
    private $images;

    /**
     * @var OG\InversaBundle\Entity\WebUrl
     */
    private $links;

    public function __construct()
    {
        $this->documents = new \Doctrine\Common\Collections\ArrayCollection();
    $this->images = new \Doctrine\Common\Collections\ArrayCollection();
    $this->links = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Add documents
     *
     * @param OG\InversaBundle\Entity\Document $documents
     */
    public function addDocument(\OG\InversaBundle\Entity\Document $documents)
    {
        $this->documents[] = $documents;
    }

    /**
     * Get documents
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getDocuments()
    {
        return $this->documents;
    }

    /**
     * Add images
     *
     * @param OG\InversaBundle\Entity\Image $images
     */
    public function addImage(\OG\InversaBundle\Entity\Image $images)
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
     * Add links
     *
     * @param OG\InversaBundle\Entity\WebUrl $links
     */
    public function addWebUrl(\OG\InversaBundle\Entity\WebUrl $links)
    {
        $this->links[] = $links;
    }

    /**
     * Get links
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getLinks()
    {
        return $this->links;
    }
}