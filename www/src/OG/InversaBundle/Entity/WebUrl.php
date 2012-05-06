<?php

namespace OG\InversaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * OG\InversaBundle\Entity\WebUrl
 */
class WebUrl
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
     * @var string $url
     */
    private $url;

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
     * Set url
     *
     * @param string $url
     */
    public function setUrl($url)
    {
        $this->url = $url;
    }

    /**
     * Get url
     *
     * @return string 
     */
    public function getUrl()
    {
        if (!is_null($this->url)) {
            // if url does not contain :// and does not start with a /, add http:// automatically
            if (strpos($this->url, "://") === false && strpos($this->url, "/") !== 0) {
                return "http://" . $this->url;
            }
        }
        return $this->url;
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
}