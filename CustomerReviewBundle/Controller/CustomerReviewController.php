<?php

namespace Gamma\CustomerReview\CustomerReviewBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use JMS\DiExtraBundle\Annotation as DI;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * @Route("/reviews")
 */
class CustomerReviewController extends Controller
{
    use \Gamma\CustomerReview\CustomerReviewBundle\Traits\SetCustomerReviewManagerTrait;
    
    /**
     * @Route("/list/{page}", name="reviews", defaults={"page"=1}, requirements={"page"="\d+"})
     * @Template()
     */    
    public function listAction($limit = 20, $page)
    {        
        return $this->customerReviewManager->getReviews($limit, $page);
    }
    
    /**
     * @Template()
     */
    public function latestAction($limit = 5)
    {
        return $this->customerReviewManager->getReviews($limit);
    }    
}
