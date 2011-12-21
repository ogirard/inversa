<?php

namespace OG\InversaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * OG\InversaBundle\Entity\Document
 */
class Document
{
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

    /**
     * Set path
     *
     * @param string $path
     */
    public function setPath($path)
    {
        $this->path = $path;
    }

    public function getAbsolutePath()
    {
        return null === $this->path ? null : $this->getUploadRootDir().'/'.$this->id.'_'.$this->path;
    }

    public function getWebPath()
    {
        return null === $this->path ? null : $this->getUploadDir().'/'.$this->id.'_'.$this->path;
    }

    protected function getUploadRootDir()
    {
        // the absolute directory path where uploaded documents should be saved
        return __DIR__.'/../../../../web/'.$this->getUploadDir();
    }

    protected function getUploadDir()
    {
        // get rid of the __DIR__ so it doesn't screw when displaying uploaded doc/image in the view.
        return 'uploads/documents/'.$this->doctype;
    }

    /**
    * @ORM\prePersist
    */
    public function preUpload()
    {
        if (null === $this->file) {
            return;
        }

        $this->path = $this->file->getClientOriginalName();
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

        $this->file->move($this->getUploadRootDir(), $this->id.'_'.$this->path);

        unset($this->file);
    }

    /**
    * @ORM\postRemove
    */
    public function removeUpload()
    {
        if ($file = $this->getAbsolutePath()) {
            unlink($file);
        }
    }
    /**
     * @var integer $id
     */
    private $id;

    /**
     * @var string $name
     */
    private $name;

    /**
     * @var string $doctype
     */
    private $doctype;

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
     * Get path
     *
     * @return string 
     */
    public function getPath()
    {
        return $this->path;
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
    * ToString representation
    * @return number
    */
    public function __toString()
    {
        return "DOC_".$this->id;
    }
}