<?php

namespace Gamma\CustomerReview\CustomerReviewBundle\Repository;

use Doctrine\ORM\EntityRepository;

use Gamma\CustomerReview\CustomerReviewBundle\Interfaces\ProductInterface;

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
     * @param ProductInterface | int $product
     * 
     * @return CustomerReview[]
     */
    public function getReviews($max = 20, $offset = 0, $product = null)
    {
        $query = $this->createQueryBuilder("p")
            ->where('p.enabled = 1');
        
        if($product){
            $query = $this->resolveProductFilter($query, $product);
        }
        
        $query = $query->orderBy('p.date', 'DESC') 
            ->setMaxResults($max)
            ->setFirstResult($offset)
            ->getQuery();
        
        return $query->getResult();
    }
    
    private function resolveProductFilter($query, $product)
    {
        if($product instanceof ProductInterface){
            $query = $query->andWhere('p.product = :product')
                            ->setParameter('product', $product);
        } else {
            $query = $query->andWhere('p.ProductArticle = :product_id')
                            ->setParameter('product_id', $product);            
        }
        
        return $query;
    }
    
    /**
     * Returns the number of enabled reviews
     * 
     * @param ProductInterface | int $product
     * @return int
     */
    public function getCountForEnabled($product = null)
    {
        $query = $this->createQueryBuilder("p")
            ->select("COUNT(p.id)")
            ->where("p.enabled=1");
        
        if($product){
            $query = $this->resolveProductFilter($query, $product);
        }
        
        $query = $query->getQuery();
        $result = $query->getScalarResult();

        return $result[0][1];
    } 
    
    /**
     * Returns positive reviews
     *
     * @param int      $max
     * @param int      $offset
     * @param ProductInterface | int $product
     *
     * @return CustomerReview[]
     */
    public function getPositiveReviews($max = 20, $offset = 0,$product = null)
    {
        $query = $this->createQueryBuilder("p")
            ->where('p.enabled = 1');

        if($product){
            $query = $this->resolveProductFilter($query, $product);
        }
        
        $query = $query->andWhere('p.rating > 3')
            ->orderBy('p.date', 'DESC') 
            ->setMaxResults($max)
            ->setFirstResult($offset)
            ->getQuery();
        
        return $query->getResult();
    }
    
    /**
     * Returns the number of enabled reviews
     * 
     * @param ProductInterface | int
     * @return int
     */
    public function getCountForPositiveEnabled($product = null)
    {
        $query = $this->createQueryBuilder("p")
            ->select("COUNT(p.id)")
            ->where("p.enabled=1");

        if($product){
            $query = $this->resolveProductFilter($query, $product);
        }
        
        $query = $query->andWhere('p.rating > 3')
                       ->getQuery();
        $result = $query->getScalarResult();

        return $result[0][1];
    }

    /**
     * Returns the number of enabled reviews
     * 
     * @param ProductInterface | int
     * @return int
     */
    public function getAverageRate($product = null)
    {
        $query = $this->createQueryBuilder("p")
            ->select("AVG((p.rating) as rating_avg")
            ->where("p.enabled=1");

        if($product){
            $query = $this->resolveProductFilter($query, $product);
        }
        
        $query = $query->getQuery();
        $result = $query->getScalarResult();

        return $result[0]['rating_avg'];
    }    
    
}