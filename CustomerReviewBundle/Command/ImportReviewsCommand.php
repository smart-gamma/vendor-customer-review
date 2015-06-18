<?php

namespace Gamma\CustomerReview\CustomerReviewBundle\Command;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

use Localdev\FrameworkExtraBundle\Command\Command;

use Gamma\CustomerReview\CustomerReviewBundle\Entity\CustomerReview;

/**
 * Import reviews command
 * Argument "provider": gamma.trusted_shop.manager | gamma.ekomi.manager
 *
 * @author Evgen Kuzmin <jekccs@gmail.com>
 */
class ImportReviewsCommand extends Command
{
    /**
     * {@inheritDoc}
     */
    protected function configure()
    {
        $this
            ->setName('gamma:import:reviews')
            ->setDescription('Import new reviews')
            ->addArgument('provider', InputArgument::OPTIONAL, 'source service provider of reviews', 'gamma.trusted_shop.manager')
        ;
    }

    /**
     * {@inheritDoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {   
        if($provider = $this->get($input->getArgument('provider'))) {
            $reviews = $provider->getReviews();
            $output->writeln("<info>Parsed ".count($reviews)." reviews</info>");
            $em = $this->getManager();
            $repo = $em->getRepository('GammaCustomerReviewBundle:CustomerReview');
            $i = 0;
            foreach($reviews as $review) {
                if(!$repo->findByHash(md5($review['comment']))){
                    /* @var $customerReview Gamma\CustomerReview\CustomerReviewBundle\Entity\CustomerReview */
                    $customerReview = new CustomerReview();
                    $customerReview->setRating($review['rating']);
                    $customerReview->setDate(new \DateTime($review['date']));
                    $customerReview->setComment($review['comment']);
                    $customerReview->setReply($review['reply']);
                    $customerReview->setProvider($review['provider']);
                    if(isset($review['product_article'])) $customerReview->setProductArticle($review['product_article']);
                    $em->persist($customerReview);
                    $i++;
                }    
            }
            $em->flush();
            $output->writeln("<info>".$i." new reviews added</info>");
        } else {
            $output->writeln("<error>Unknown reviews provider: ".$input->getArgument('provider')."</error>");
        }
    }    
 }
