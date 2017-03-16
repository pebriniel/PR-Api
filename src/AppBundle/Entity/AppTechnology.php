<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Advert
 *
 * @ORM\Table(name="technology")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\AdvertRepository")
 */
class AppTechnology{

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
     * @ORM\Column(name="name", type="string", length=255, nullable = true, unique = false)
     *
    */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="urllogo", type="string", length=255, nullable = true, unique = false)
     *
    */
    private $urllogo;

    /**
     * @var int
     *
     * @ORM\Column(name="category", type="integer", length=4, nullable = true, unique = false)
     *
    */
    private $category;

    /**
     * @var int
     *
     * @ORM\Column(name="order", type="integer", length=4, nullable = true, unique = false)
     *
    */
    private $order;

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
     *
     * @return AppTechnology
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
     * Set urllogo
     *
     * @param string $urllogo
     *
     * @return AppTechnology
     */
    public function setUrllogo($urllogo)
    {
        $this->urllogo = $urllogo;

        return $this;
    }

    /**
     * Get urllogo
     *
     * @return string
     */
    public function getUrllogo()
    {
        return $this->urllogo;
    }

    /**
     * Set category
     *
     * @param integer $category
     *
     * @return AppTechnology
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
     * @return AppTechnology
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
}
