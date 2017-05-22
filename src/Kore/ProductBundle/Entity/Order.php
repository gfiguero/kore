<?php

namespace Kore\ProductBundle\Entity;

/**
 * Order
 */
class Order
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
    private $phone;

    /**
     * @var string
     */
    private $address;

    /**
     * @var string
     */
    private $comment;

    /**
     * @var string
     */
    private $code;

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
     * @var \Kore\ProductBundle\Entity\OrderStatus
     */
    private $orderstatus;

    /**
     * @var \Kore\ProductBundle\Entity\PaymentMethod
     */
    private $paymentmethod;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->productorders = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return Order
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
     * Set phone
     *
     * @param string $phone
     *
     * @return Order
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * Get phone
     *
     * @return string
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Set address
     *
     * @param string $address
     *
     * @return Order
     */
    public function setAddress($address)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * Get address
     *
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Set comment
     *
     * @param string $comment
     *
     * @return Order
     */
    public function setComment($comment)
    {
        $this->comment = $comment;

        return $this;
    }

    /**
     * Get comment
     *
     * @return string
     */
    public function getComment()
    {
        return $this->comment;
    }

    /**
     * Set code
     *
     * @param string $code
     *
     * @return Order
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
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return Order
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
     * @return Order
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
     * @return Order
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
     * @return Order
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
     * Set orderstatus
     *
     * @param \Kore\ProductBundle\Entity\OrderStatus $orderstatus
     *
     * @return Order
     */
    public function setOrderstatus(\Kore\ProductBundle\Entity\OrderStatus $orderstatus = null)
    {
        $this->orderstatus = $orderstatus;

        return $this;
    }

    /**
     * Get orderstatus
     *
     * @return \Kore\ProductBundle\Entity\OrderStatus
     */
    public function getOrderstatus()
    {
        return $this->orderstatus;
    }

    /**
     * Set paymentmethod
     *
     * @param \Kore\ProductBundle\Entity\PaymentMethod $paymentmethod
     *
     * @return Order
     */
    public function setPaymentmethod(\Kore\ProductBundle\Entity\PaymentMethod $paymentmethod = null)
    {
        $this->paymentmethod = $paymentmethod;

        return $this;
    }

    /**
     * Get paymentmethod
     *
     * @return \Kore\ProductBundle\Entity\PaymentMethod
     */
    public function getPaymentmethod()
    {
        return $this->paymentmethod;
    }
}

