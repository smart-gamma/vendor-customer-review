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
        $response['reviews'] = $this->customerReviewManager->getReviews($limit, $page);
        return $response;
    }
    
    /**
     * @Template()
     */
    public function latestAction($limit = 6)
    {
        $response['reviews'] = $this->customerReviewManager->getReviews($limit);
        return $response;
    }    
}
