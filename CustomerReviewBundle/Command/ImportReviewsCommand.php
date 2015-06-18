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
    private $limit;
    private $em; 

    /**
     * {@inheritDoc}
     */
    protected function configure()
    {
        $this
            ->setName('gamma:import:reviews')
            ->setDescription('Import new reviews')
            ->addArgument('provider', InputArgument::OPTIONAL, 'source service provider of reviews', 'gamma.trusted_shop.manager')
            ->addArgument('limit', InputArgument::OPTIONAL, 'limit to parse reviews')
        ;
    }

    /**
     * {@inheritDoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {                   
        if($provider = $this->get($input->getArgument('provider'))) {
            $this->em = $this->getManager();
            $reviews = $provider->getReviews();
            $this->limit = $input->getArgument('limit');
            $output->writeln("<info>Parsed ".count($reviews)." reviews</info>");
            $amount = $this->importReviews($reviews);
            $output->writeln("<info>".$amount." new reviews added</info>");
        } else {
            $output->writeln("<error>Unknown reviews provider: ".$input->getArgument('provider')."</error>");
        }
    } 
    
    private function importReviews($reviews)
    {
       // $em = $this->getManager();
        $repo = $this->em->getRepository('GammaCustomerReviewBundle:CustomerReview');
        $i = 0;
        foreach($reviews as $review) {
            if(!$repo->findByHash(md5($review['comment']))){
                if($this->limit && $i >= $this->limit) break;
                $customerReview = $this->buildCustomerReview($review);
                $i++;
            }    
        }
        $this->em->flush(); 
        
        return $i;
    }
    
    private function buildCustomerReview($review)
    {
        /* @var $customerReview Gamma\CustomerReview\CustomerReviewBundle\Entity\CustomerReview */
        $customerReview = new CustomerReview();
        $customerReview->setRating($review['rating']);
        $customerReview->setDate(new \DateTime($review['date']));
        $customerReview->setComment($review['comment']);
        $customerReview->setReply($review['reply']);
        if(isset($review['product_article'])) $customerReview->setProductArticle($review['product_article']); 
        $this->em->persist($customerReview);
        
        return $customerReview;
    }
 }
