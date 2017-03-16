<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * skills
 *
 * @ORM\Table(name="experience")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\AdvertRepository")
 */
class AppExperience{

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var int
     *
     * @ORM\Column(name="category", type="integer", length=4, nullable = true, unique = false)
     *
    */
    private $category;

    /**
     * @ORM\ManyToMany(targetEntity="AppCompany", cascade={"persist"})
     * @ORM\JoinTable(name="oc_experience_company")
     */
    private $company;

    /**
     * @var dateTime
     *
     * @ORM\Column(name="dateStart", type="datetime",nullable = true, unique = false)
     *
    */
    private $dateStart;

    /**
     * @var dateTime
     *
     * @ORM\Column(name="dateEnd", type="datetime",nullable = true, unique = false)
     *
    */
    private $dateEnd;

    /**
     * @var int
     *
     * @ORM\Column(name="type", type="integer", length=4, nullable = true, unique = false)
     *
    */
    private $type;

    /**
     * @var int
     *
     * @ORM\Column(name="order", type="integer", length=4, nullable = true, unique = false)
     *
    */
    private $order;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", unique = false)
     *
    */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="workplace", type="string", length=255, nullable = true, unique = false)
     *
    */
    private $workplace;


    /**
     * @var string
     *
     * @ORM\Column(name="city", type="string", length=150, nullable = true, unique = false)
     *
    */
    private $city;



    /**
     * Constructor
     */
    public function __construct()
    {
        $this->technology = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set category
     *
     * @param integer $category
     *
     * @return AppExperience
     */
    public function setCategory($category)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return integer
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Set order
     *
     * @param integer $order
     *
     * @return AppExperience
     */
    public function setOrder($order)
    {
        $this->order = $order;

        return $this;
    }

    /**
     * Get order
     *
     * @return integer
     */
    public function getOrder()
    {
        return $this->order;
    }

    /**
     * Add technology
     *
     * @param \AppBundle\Entity\AppTechnology $technology
     *
     * @return AppExperience
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
     * Set dateStart
     *
     * @param \DateTime $dateStart
     *
     * @return AppExperience
     */
    public function setDateStart($dateStart)
    {
        $this->dateStart = $dateStart;

        return $this;
    }

    /**
     * Get dateStart
     *
     * @return \DateTime
     */
    public function getDateStart()
    {
        return $this->dateStart;
    }

    /**
     * Set dateEnd
     *
     * @param \DateTime $dateEnd
     *
     * @return AppExperience
     */
    public function setDateEnd($dateEnd)
    {
        $this->dateEnd = $dateEnd;

        return $this;
    }

    /**
     * Get dateEnd
     *
     * @return \DateTime
     */
    public function getDateEnd()
    {
        return $this->dateEnd;
    }

    /**
     * Set type
     *
     * @param integer $type
     *
     * @return AppExperience
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return integer
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Add company
     *
     * @param \AppBundle\Entity\AppCompany $company
     *
     * @return AppExperience
     */
    public function addCompany(\AppBundle\Entity\AppCompany $company)
    {
        $this->company[] = $company;

        return $this;
    }

    /**
     * Remove company
     *
     * @param \AppBundle\Entity\AppCompany $company
     */
    public function removeCompany(\AppBundle\Entity\AppCompany $company)
    {
        $this->company->removeElement($company);
    }

    /**
     * Get company
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCompany()
    {
        return $this->company;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return AppExperience
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
     * Set workplace
     *
     * @param string $workplace
     *
     * @return AppExperience
     */
    public function setWorkplace($workplace)
    {
        $this->workplace = $workplace;

        return $this;
    }

    /**
     * Get workplace
     *
     * @return string
     */
    public function getWorkplace()
    {
        return $this->workplace;
    }

    /**
     * Set city
     *
     * @param string $city
     *
     * @return AppExperience
     */
    public function setCity($city)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * Get city
     *
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }
}
