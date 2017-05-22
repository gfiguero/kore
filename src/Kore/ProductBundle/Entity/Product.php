<?php

namespace Kore\ProductBundle\Entity;

/**
 * Product
 */
class Product
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $code;

    /**
     * @var integer
     */
    private $price;

    /**
     * @var string
     */
    private $image;

    /**
     * @var boolean
     */
    private $enabled;

    /**
     * @var string
     */
    private $description;

    /**
     * @var \DateTime
     */
    private $createdAt;

    /**
     * @var \DateTime
     */
    private $updatedAt;

    /**
     * @var \DateTime
     */
    private $deletedAt;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $productorders;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $productimages;

    /**
     * @var \Kore\ProductBundle\Entity\Subcategory
     */
    private $subcategory;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->productorders = new \Doctrine\Common\Collections\ArrayCollection();
        $this->productimages = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set name
     *
     * @param string $name
     *
     * @return Product
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
     * Set code
     *
     * @param string $code
     *
     * @return Product
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * Get code
     *
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Set price
     *
     * @param integer $price
     *
     * @return Product
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return integer
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set image
     *
     * @param string $image
     *
     * @return Product
     */
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return string
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set enabled
     *
     * @param boolean $enabled
     *
     * @return Product
     */
    public function setEnabled($enabled)
    {
        $this->enabled = $enabled;

        return $this;
    }

    /**
     * Get enabled
     *
     * @return boolean
     */
    public function getEnabled()
    {
        return $this->enabled;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Product
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
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return Product
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     *
     * @return Product
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * Set deletedAt
     *
     * @param \DateTime $deletedAt
     *
     * @return Product
     */
    public function setDeletedAt($deletedAt)
    {
        $this->deletedAt = $deletedAt;

        return $this;
    }

    /**
     * Get deletedAt
     *
     * @return \DateTime
     */
    public function getDeletedAt()
    {
        return $this->deletedAt;
    }

    /**
     * Add productorder
     *
     * @param \Kore\ProductBundle\Entity\ProductOrder $productorder
     *
     * @return Product
     */
    public function addProductorder(\Kore\ProductBundle\Entity\ProductOrder $productorder)
    {
        $this->productorders[] = $productorder;

        return $this;
    }

    /**
     * Remove productorder
     *
     * @param \Kore\ProductBundle\Entity\ProductOrder $productorder
     */
    public function removeProductorder(\Kore\ProductBundle\Entity\ProductOrder $productorder)
    {
        $this->productorders->removeElement($productorder);
    }

    /**
     * Get productorders
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getProductorders()
    {
        return $this->productorders;
    }

    /**
     * Add productimage
     *
     * @param \Kore\ProductBundle\Entity\ProductImage $productimage
     *
     * @return Product
     */
    public function addProductimage(\Kore\ProductBundle\Entity\ProductImage $productimage)
    {
        $this->productimages[] = $productimage;

        return $this;
    }

    /**
     * Remove productimage
     *
     * @param \Kore\ProductBundle\Entity\ProductImage $productimage
     */
    public function removeProductimage(\Kore\ProductBundle\Entity\ProductImage $productimage)
    {
        $this->productimages->removeElement($productimage);
    }

    /**
     * Get productimages
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getProductimages()
    {
        return $this->productimages;
    }

    /**
     * Set subcategory
     *
     * @param \Kore\ProductBundle\Entity\Subcategory $subcategory
     *
     * @return Product
     */
    public function setSubcategory(\Kore\ProductBundle\Entity\Subcategory $subcategory = null)
    {
        $this->subcategory = $subcategory;

        return $this;
    }

    /**
     * Get subcategory
     *
     * @return \Kore\ProductBundle\Entity\Subcategory
     */
    public function getSubcategory()
    {
        return $this->subcategory;
    }
}

