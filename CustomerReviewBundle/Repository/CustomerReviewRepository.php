<?php

namespace Gamma\CustomerReview\CustomerReviewBundle\Repository;

use Doctrine\ORM\EntityRepository;


/**
 * CaustomerReview Repository
 *
 * @author Evgen Kuzmin <jekccs@gmail.com>
 */
class CustomerReviewRepository extends EntityRepository
{     
    /**
     * Returns reviews
     *
     * @param int      $max
     * @param int      $offset
     *
     * @return CustomerReview[]
     */
    public function getReviews($max = 20, $offset = 0)
    {
        $query = $this->createQueryBuilder("p")
            ->where('p.enabled = 1')
            ->orderBy('p.date', 'ASC') 
            ->setMaxResults($max)
            ->setFirstResult($offset)
            ->getQuery();
        
        return $query->getResult();
    }
}