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
     * @return CustomerReview[]
     */
    public function getReviews($limit = 5, $page = 1)
    {
        /* @var $repo \Gamma|CustomerReview\CustomerReviewBundle\Repository\CustomerReviewRepository */ 
        $repo = $this->em->getRepository("GammaCustomerReviewBundle:CustomerReview"); 
        
        $count = $repo->getCountForEnabled();
        $paginator = new \LaMelle\AdminBundle\Helper\Paginate($count, $page, $limit);
        $offset = $paginator->getOffset();

        return array("reviews" => $repo->getReviews($limit, $offset), "paginator" => $paginator);
    }  
}
