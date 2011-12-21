<?php

namespace OG\InversaBundle\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * OG\InversaBundle\Entity\ProjectItem
 */
class ProjectItem
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
     * Add link
     *
     * @param OG\InversaBundle\Entity\WebUrl $link
     */
    public function addWebUrl(\OG\InversaBundle\Entity\WebUrl $link)
    {
        $this->links[] = $link;
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
    /**
     * @var OG\InversaBundle\Entity\Document
     */
    private $documents;

    /**
     * @var OG\InversaBundle\Entity\Image
     */
    private $images;

    /**
     * Add document
     *
     * @param OG\InversaBundle\Entity\Document $document
     */
    public function addDocument(\OG\InversaBundle\Entity\Document $document)
    {
        $this->documents[] = $document;
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
     * Add image
     *
     * @param OG\InversaBundle\Entity\Image $image
     */
    public function addImage(\OG\InversaBundle\Entity\Image $image)
    {
        $this->images[] = $image;
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
    * ToString representation
    * @return number
    */
    public function __toString()
    {
        return "PROJECT_".$this->id;
    }
}
