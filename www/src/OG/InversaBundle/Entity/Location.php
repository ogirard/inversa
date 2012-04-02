<?php

namespace OG\InversaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * OG\InversaBundle\Entity\Location
 */
class Location
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
     * @var text $address
     */
    private $address;

    /**
     * @var string $mapurl
     */
    private $mapurl;

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
     * Set address
     *
     * @param text $address
     */
    public function setAddress($address)
    {
        $this->address = $address;
    }

    /**
     * Get address
     *
     * @return text 
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Set mapurl
     *
     * @param string $mapurl
     */
    public function setMapurl($mapurl)
    {
        $this->mapurl = $mapurl;
    }

    /**
     * Get mapurl
     *
     * @return string 
     */
    public function getMapurl()
    {
        return $this->mapurl;
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
    
    /**
    * ToString representation
    * @return number
    */
    public function __toString()
    {
        return "LOCATION_".$this->id;
    }
}