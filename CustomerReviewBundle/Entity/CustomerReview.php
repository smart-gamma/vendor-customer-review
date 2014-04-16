<?php

namespace Gamma\CustomerReview\CustomerReviewBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Table(name="customer_review", indexes={
 * @ORM\Index(name="search_idx", columns={"product", "enabled"}),
 * @ORM\Index(name="sort_idx", columns={"date"})
 * })
 */
class Gallery
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
	 * @ORM\Column(type="date", nullable=true)
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
     * @ORM\ManyToOne(targetEntity="LaMelle\ProductBundle\Entity\Product")
     */
    private $product;


    /**
     * Get id
     *
     * @return int $id
     */
    public function getId()
    {
        return $this->id;
    }

}