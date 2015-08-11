<?php
namespace Gamma\CustomerReview\CustomerReviewBundle\Listener;

use Symfony\Component\HttpKernel\HttpKernelInterface;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;

use Localdev\FrameworkExtraBundle\Services\Service;

class KernelEvents extends Service
{
	public function onKernelRequest(GetResponseEvent $event)
	{
		if (HttpKernelInterface::MASTER_REQUEST === $event->getRequestType())
		{
			/* @var  $globals \Twig_Environment */
			$globals = $this->container->get('twig');
            $vars = $globals->getGlobals();
            if(!isset($vars['_reviewAggregation'])) {
                /* @var $trustedShopManager \Gamma\TrustedShop\TrustedShopBundle\Services\TrustedShopManager */
                $manager = $this->container->get('gamma.customer_review.manager');
                $globals->addGlobal('_reviewAggregation', $manager->getReviewAggregation());
            }    
		}
	}
}
