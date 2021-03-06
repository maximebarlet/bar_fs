<?php

namespace App\Repository;

use App\Entity\Category;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Category|null find($id, $lockMode = null, $lockVersion = null)
 * @method Category|null findOneBy(array $criteria, array $orderBy = null)
 * @method Category[]    findAll()
 * @method Category[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CategoryRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Category::class);
    }

    // /**
    //  * @return Category[] Returns an array of Category objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Category
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
  public function search()//: ?Category
  {
    $qb = $this->createQueryBuilder('a');
    $qb->innerJoin('a.beers', 'Category')
      ->addSelect('Category')
      ->where($qb->expr()->eq('Category.id', $qb->expr()->literal(1)));

    return $qb->getQuery()->getResult();
  }
  
  public function findByTerm($name)
  {
    return $this->createQueryBuilder('t')
      ->setParameter('val', $name)
      ->andWhere('t.name = :val')
      ->orderBy('t.term', 'ASC')
      ->setMaxResults(10)
      ->getQuery()
      ->getResult();

      return getResult();
  }

  public function findByCatId($id)
  {
    return $this->createQueryBuilder('c')
      ->setParameter('val', $id)
      ->andWhere('c.id = :val')
      ->orderBy('c.id', 'ASC')
      ->setMaxResults(10)
      ->getQuery()
      ->getResult();

    return getResult();
  }
}
