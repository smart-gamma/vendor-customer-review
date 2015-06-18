<?php

namespace Gamma\CustomerReview\CustomerReviewBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use \Gamma\CustomerReview\CustomerReviewBundle\Interfaces\ProductInterface;

/**
 * @ORM\Entity(repositoryClass="Gamma\CustomerReview\CustomerReviewBundle\Repository\CustomerReviewRepository")
 * @ORM\Table(name="customer_review", indexes={
 * @ORM\Index(name="enabled_idx", columns={"enabled"}),
 * @ORM\Index(name="rating_idx", columns={"enabled", "rating"}),
 * @ORM\Index(name="sort_idx", columns={"date"})
 * })
 */
class CustomerReview
{
    /**
     * ID of the Gallery
     *
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     * @var int
     */
    protected $id;

    /**
     * Rating
     *
     * @ORM\Column(type="integer")
     * @Assert\NotBlank()
     * @var int
     */
    private $rating;    

    /**
     * Rating
     *
	 * @ORM\Column(type="datetime", nullable=true)
	 * @var \DateTime
     */
    private $date;  
    
    /**
     * Name
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     * @var string
     */
    private $customerName = '';

    /**
     * Title
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     * @var string
     */
    private $title = '';
    
    /**
     * Comment
     *
     * @ORM\Column(type="text")
     * @Assert\NotBlank()
     * @var string
     */
    private $comment;

    /**
     * Reply
     *
     * @ORM\Column(type="text")
     * @var string
     */
    private $reply = '';
    
    /**
     * Show gallery in shop
     *
     * @ORM\Column(type="boolean")
     * @var bool
     */
    private $enabled = true;

    /**
     * Product
     *
     * @ORM\ManyToOne(targetEntity="Gamma\CustomerReview\CustomerReviewBundle\Interfaces\ProductInterface")
     */
    private $product;

    /**
     * Product article number
     *
     * @ORM\Column(type="string", length=100)
     * @var string
     */
    private $ProductArticle;
    
    /**
     * Hash
     *
     * @ORM\Column(type="string", length=255)
     * @var string
     */
    private $hash;    

    /**
     * Get id
     *
     * @return int $id
     */
    public function getId()
    {
        return $this->id;
    }


    /**
     * Set rating
     *
     * @param integer $rating
     * @return CustomerReview
     */
    public function setRating($rating)
    {
        $this->rating = $rating;
    
        return $this;
    }

    /**
     * Get rating
     *
     * @return integer 
     */
    public function getRating()
    {
        return $this->rating;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     * @return CustomerReview
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
     * Set customerName
     *
     * @param string $customerName
     * @return CustomerReview
     */
    public function setCustomerName($customerName)
    {
        $this->customerName = $customerName;
    
        return $this;
    }

    /**
     * Get customerName
     *
     * @return string 
     */
    public function getCustomerName()
    {
        return $this->customerName;
    }

    /**
     * Set title
     *
     * @param string $title
     * @return CustomerReview
     */
    public function setTitle($title)
    {
        $this->title = $title;
    
        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set comment
     *
     * @param string $comment
     * @return CustomerReview
     */
    public function setComment($comment)
    {
        $this->comment = $comment;
        $this->setHash(md5($comment));
        
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
     * Set reply
     *
     * @param string $reply
     * @return CustomerReview
     */
    public function setReply($reply)
    {
        $this->reply = $reply;
    
        return $this;
    }

    /**
     * Get reply
     *
     * @return string 
     */
    public function getReply()
    {
        return $this->reply;
    }

    /**
     * Set enabled
     *
     * @param boolean $enabled
     * @return CustomerReview
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
     * Set product
     *
     * @param \Gamma\CustomerReview\CustomerReviewBundle\Interfaces\ProductInterface $product
     * @return CustomerReview
     */
    public function setProduct(\Gamma\CustomerReview\CustomerReviewBundle\Interfaces\ProductInterface $product = null)
    {
        $this->product = $product;
    
        return $this;
    }

    /**
     * Get product
     *
     * @return \Gamma\CustomerReview\CustomerReviewBundle\Interfaces\ProductInterface 
     */
    public function getProduct()
    {
        return $this->product;
    }

    /**
     * Set hash
     *
     * @param string $hash
     * @return CustomerReview
     */
    public function setHash($hash)
    {
        $this->hash = $hash;
    
        return $this;
    }

    /**
     * Get hash
     *
     * @return string 
     */
    public function getHash()
    {
        return $this->hash;
    }

    /**
     * Set ProductArticle
     *
     * @param string $productArticle
     * @return CustomerReview
     */
    public function setProductArticle($productArticle)
    {
        $this->ProductArticle = $productArticle;

        return $this;
    }

    /**
     * Get ProductArticle
     *
     * @return string 
     */
    public function getProductArticle()
    {
        return $this->ProductArticle;
    }
}
