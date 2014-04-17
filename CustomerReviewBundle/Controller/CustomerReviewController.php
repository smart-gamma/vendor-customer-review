<?php

namespace Gamma\CustomerReview\CustomerReviewBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use JMS\DiExtraBundle\Annotation as DI;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Cache;

/**
 * @Route("/reviews")
 */
class CustomerReviewController extends Controller
{
    use \Gamma\CustomerReview\CustomerReviewBundle\Traits\SetCustomerReviewManagerTrait;
    
    /**
     * @Route("/list/{page}", name="reviews", defaults={"page"=1}, requirements={"page"="\d+"})
     * @Cache(smaxage="600")
     * @Template()
     */    
    public function listAction($limit = 20, $page)
    {        
        return $this->customerReviewManager->getReviews($limit, $page);
    }
    
    /**
     * @Cache(smaxage="600")
     * @Template()
     */
    public function latestAction($limit = 5)
    {
        return $this->customerReviewManager->getReviews($limit);
    }    
}
