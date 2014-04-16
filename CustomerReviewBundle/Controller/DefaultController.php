<?php

namespace Gamma\CustomerReview\CustomerReviewBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('GammaCustomerReviewBundle:Default:index.html.twig', array('name' => $name));
    }
}
