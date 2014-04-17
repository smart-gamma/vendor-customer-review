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
            ->orderBy('p.date', 'DESC') 
            ->setMaxResults($max)
            ->setFirstResult($offset)
            ->getQuery();
        
        return $query->getResult();
    }
    
    /**
     * Returns the number of enabled reviews
     * @return int
     */
    public function getCountForEnabled()
    {
        $query = $this->createQueryBuilder("p")
            ->select("COUNT(p.id)")
            ->where("p.enabled=1")
            ->getQuery();
        $result = $query->getScalarResult();

        return $result[0][1];
    }    
}