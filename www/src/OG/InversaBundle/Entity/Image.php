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
    private $name;

    /**
     * @var text $description
     */
    private $description;

    /**
     * @var string $path
     */
    private $path;


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
     * @ORM\prePersist
     */
    public function preUpload()
    {
        // Add your code here
    }

    /**
     * @ORM\postPersist
     */
    public function upload()
    {
        // Add your code here
    }

    /**
     * @ORM\postRemove
     */
    public function removeUpload()
    {
        // Add your code here
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
}