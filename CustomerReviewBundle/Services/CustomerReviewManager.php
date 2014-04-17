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
     * @return CustomerReview[]
     */
    public function getReviews($limit = 6)
    {
        $repo = $this->em->getRepository("GammaCustomerReviewBundle:CustomerReview"); 
        return $repo->getReviews($limit);
    }  
}
