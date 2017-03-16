<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Advert
 *
 * @ORM\Table(name="project")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\AdvertRepository")
 */
class AppProject{

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="lang", type="string", length=3, nullable = true, unique = false)
     *
    */
    private $lang;


    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, nullable = true, unique = false)
     *
    */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255, nullable = true, unique = false)
    */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="bandeauproject", type="string", length=255, nullable = true, unique = false)
    */
    private $bandeauproject;

    /**
     * @var string
     *
     * @ORM\Column(name="logoproject", type="string", length=255, nullable = true, unique = false)
    */
    private $logoproject;

    /**
     * @var datetime
     *
     * @ORM\Column(name="date", type="date", nullable = true, unique = false)
    */
    private $date;

    /**
     * @ORM\ManyToMany(targetEntity="AppTechnology", cascade={"persist"})
     * @ORM\JoinTable(name="oc_project_technology")
     */
    private $technology;


    /**
     * @ORM\ManyToMany(targetEntity="AppTeam", cascade={"persist"})
     * @ORM\JoinTable(name="oc_project_team")
     */
    private $team;


    /**
     * @ORM\ManyToMany(targetEntity="AppScreenshot", cascade={"persist"})
     * @ORM\JoinTable(name="oc_project_screenshot")
     */
    private $screenshot;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->technology = new \Doctrine\Common\Collections\ArrayCollection();
        $this->team = new \Doctrine\Common\Collections\ArrayCollection();
        $this->screenshot = new \Doctrine\Common\Collections\ArrayCollection();
    }

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
     * Set lang
     *
     * @param string $lang
     *
     * @return AppProject
     */
    public function setLang($lang)
    {
        $this->lang = $lang;

        return $this;
    }

    /**
     * Get lang
     *
     * @return string
     */
    public function getLang()
    {
        return $this->lang;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return AppProject
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
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
     * @param string $description
     *
     * @return AppProject
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return AppProject
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Add technology
     *
     * @param \AppBundle\Entity\AppTechnology $technology
     *
     * @return AppProject
     */
    public function addTechnology(\AppBundle\Entity\AppTechnology $technology)
    {
        $this->technology[] = $technology;

        return $this;
    }

    /**
     * Remove technology
     *
     * @param \AppBundle\Entity\AppTechnology $technology
     */
    public function removeTechnology(\AppBundle\Entity\AppTechnology $technology)
    {
        $this->technology->removeElement($technology);
    }

    /**
     * Get technology
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTechnology()
    {
        return $this->technology;
    }

    /**
     * Add team
     *
     * @param \AppBundle\Entity\AppTeam $team
     *
     * @return AppProject
     */
    public function addTeam(\AppBundle\Entity\AppTeam $team)
    {
        $this->team[] = $team;

        return $this;
    }

    /**
     * Remove team
     *
     * @param \AppBundle\Entity\AppTeam $team
     */
    public function removeTeam(\AppBundle\Entity\AppTeam $team)
    {
        $this->team->removeElement($team);
    }

    /**
     * Get team
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTeam()
    {
        return $this->team;
    }

    /**
     * Add screenshot
     *
     * @param \AppBundle\Entity\AppScreenshot $screenshot
     *
     * @return AppProject
     */
    public function addScreenshot(\AppBundle\Entity\AppScreenshot $screenshot)
    {
        $this->screenshot[] = $screenshot;

        return $this;
    }

    /**
     * Remove screenshot
     *
     * @param \AppBundle\Entity\AppScreenshot $screenshot
     */
    public function removeScreenshot(\AppBundle\Entity\AppScreenshot $screenshot)
    {
        $this->screenshot->removeElement($screenshot);
    }

    /**
     * Get screenshot
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getScreenshot()
    {
        return $this->screenshot;
    }

    /**
     * Set bandeauproject
     *
     * @param string $bandeauproject
     *
     * @return AppProject
     */
    public function setBandeauproject($bandeauproject)
    {
        $this->bandeauproject = $bandeauproject;

        return $this;
    }

    /**
     * Get bandeauproject
     *
     * @return string
     */
    public function getBandeauproject()
    {
        return $this->bandeauproject;
    }

    /**
     * Set logoproject
     *
     * @param string $logoproject
     *
     * @return AppProject
     */
    public function setLogoproject($logoproject)
    {
        $this->logoproject = $logoproject;

        return $this;
    }

    /**
     * Get logoproject
     *
     * @return string
     */
    public function getLogoproject()
    {
        return $this->logoproject;
    }
}
