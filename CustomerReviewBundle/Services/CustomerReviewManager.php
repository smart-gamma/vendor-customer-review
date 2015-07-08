<?php

namespace Gamma\CustomerReview\CustomerReviewBundle\Services;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Localdev\FrameworkExtraBundle\Services\Service;

/**
 * Customer reviews service
 *
 * @author Evgeniy Kuzmin <jekccs@gmail.com>
 */
class CustomerReviewManager extends Service
{   
    use \Gamma\Framework\Traits\DI\SetEntityManagerTrait;
    
    /**
     * Get reviews from DB
     * @param int $limit
     * @param int $page
     * @param ProductInterface | int $product
     * @return CustomerReview[]
     */
    public function getReviews($limit = 5, $page = 1, $product = null)
    {
        /* @var $repo \Gamma|CustomerReview\CustomerReviewBundle\Repository\CustomerReviewRepository */ 
        $repo = $this->em->getRepository("GammaCustomerReviewBundle:CustomerReview"); 
        
        $count = $repo->getCountForEnabled($product);
        $paginator = new \LaMelle\AdminBundle\Helper\Paginate($count, $page, $limit);
        $offset = $paginator->getOffset();

        return array("reviews" => $repo->getReviews($limit, $offset, $product), "paginator" => $paginator);
    }
    
    /**
     * Get positive (4,5) reviews from DB
     * @param int $limit
     * @param int $page
     * @param ProductInterface | int $product
     * @return CustomerReview[]
     */
    public function getPositiveReviews($limit = 5, $page = 1, $product = null)
    {
        /* @var $repo \Gamma|CustomerReview\CustomerReviewBundle\Repository\CustomerReviewRepository */ 
        $repo = $this->em->getRepository("GammaCustomerReviewBundle:CustomerReview"); 
        
        $count = $repo->getCountForPositiveEnabled($product);
        $paginator = new \LaMelle\AdminBundle\Helper\Paginate($count, $page, $limit);
        $offset = $paginator->getOffset();

        return array("reviews" => $repo->getPositiveReviews($limit, $offset, $product), "paginator" => $paginator);
    }
    
    /**
     * @param ProductInterface | int $product
     * @return int
     */
    public function getPositiveReviewsCount($product = null)
    {
        /* @var $repo \Gamma|CustomerReview\CustomerReviewBundle\Repository\CustomerReviewRepository */ 
        $repo = $this->em->getRepository("GammaCustomerReviewBundle:CustomerReview");         
        return $repo->getCountForPositiveEnabled($product);
    }
    
    /**
     * @param ProductInterface | int $product
     * @return int
     */
    public function getAverageRate($product = null)
    {
        /* @var $repo \Gamma|CustomerReview\CustomerReviewBundle\Repository\CustomerReviewRepository */ 
        $repo = $this->em->getRepository("GammaCustomerReviewBundle:CustomerReview");         
        $avg = $repo->getAverageRate($product);
        return number_format($avg, 2);
    }     
}
