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
    
    const FIRST_PAGE = 1;
    
    /**
     * @Route("/list/{page}", name="reviews", defaults={"page"=1}, requirements={"page"="\d+"})
     * @Cache(smaxage="3600")
     * @Template()
     */    
    public function listAction($limit = 20, $page, $product = null)
    {        
        return $this->customerReviewManager->getReviews($limit, $page, $product);
    }
    
    /**
     * @Cache(smaxage="3600")
     * @Template()
     */
    public function latestAction($limit = 5, $product = null)
    {
        return $this->customerReviewManager->getReviews($limit, self::FIRST_PAGE, $product);
    }
    
    /**
     * @Cache(smaxage="3600")
     * @Template("GammaCustomerReviewBundle:CustomerReview:latest.html.twig")
     */
    public function latestPositiveAction($limit = 5, $product = null)
    {
        return $this->customerReviewManager->getPositiveReviews($limit, self::FIRST_PAGE, $product);
    }

    /**
     * Cache(smaxage="3600")
     * @Template("GammaCustomerReviewBundle:CustomerReview:latestSlider.html.twig")
     */
    public function latestPositiveSliderAction($limit = 15, $product = null)
    {
        return $this->customerReviewManager->getPositiveReviews($limit, self::FIRST_PAGE, $product);
    }    
}
