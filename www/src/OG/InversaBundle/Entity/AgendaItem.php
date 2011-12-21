<?php

namespace OG\InversaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * OG\InversaBundle\Entity\AgendaItem
 */
class AgendaItem
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
     * @var datetime $eventdate
     */
    private $eventdate;

    /**
     * @var string $participants
     */
    private $participants;

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
     * Set eventdate
     *
     * @param datetime $eventdate
     */
    public function setEventdate($eventdate)
    {
        $this->eventdate = $eventdate;
    }

    /**
     * Get eventdate
     *
     * @return datetime 
     */
    public function getEventdate()
    {
        return $this->eventdate;
    }

    /**
     * Set participants
     *
     * @param string $participants
     */
    public function setParticipants($participants)
    {
        $this->participants = $participants;
    }

    /**
     * Get participants
     *
     * @return string 
     */
    public function getParticipants()
    {
        return $this->participants;
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

    public function __construct()
    {
        $this->documents = new \Doctrine\Common\Collections\ArrayCollection();
        $this->images = new \Doctrine\Common\Collections\ArrayCollection();
        $this->links = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
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
     * @var OG\InversaBundle\Entity\WebUrl
     */
    private $links;


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
     * @var OG\InversaBundle\Entity\Image
     */
    private $images;


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
     * @var OG\InversaBundle\Entity\Location
     */
    private $location;


    /**
     * Set location
     *
     * @param OG\InversaBundle\Entity\Location $location
     */
    public function setLocation(\OG\InversaBundle\Entity\Location $location)
    {
        $this->location = $location;
    }

    /**
     * Get location
     *
     * @return OG\InversaBundle\Entity\Location 
     */
    public function getLocation()
    {
        return $this->location;
    }
}