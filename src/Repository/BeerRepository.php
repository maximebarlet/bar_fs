<?php

namespace App\Repository;

use App\Entity\Beer;
use App\Entity\Country;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Book|null find($id, $lockMode = null, $lockVersion = null)
 * @method Book|null findOneBy(array $criteria, array $orderBy = null)
 * @method Book[]    findAll()
 * @method Book[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BeerRepository extends ServiceEntityRepository
{
  public function __construct(ManagerRegistry $registry)
  {
    parent::__construct($registry, Beer::class);
  }

  // /**
  //  * @return Book[] Returns an array of Book objects
  //  */
  /*
  public function findByExampleField($value)
  {
      return $this->createQueryBuilder('b')
          ->andWhere('b.exampleField = :val')
          ->setParameter('val', $value)
          ->orderBy('b.id', 'ASC')
          ->setMaxResults(10)
          ->getQuery()
          ->getResult()
      ;
  }
  */

  /*
  public function findOneBySomeField($value): ?Book
  {
      return $this->createQueryBuilder('b')
          ->andWhere('b.exampleField = :val')
          ->setParameter('val', $value)
          ->getQuery()
          ->getOneOrNullResult()
      ;
  }
  */
  /*
  public function search()//: ?Beer
  {
      return $this->createQueryBuilder('nom')
          ->select(Book, 'b')
          ->join(Auteur.nom, 'au')
          ->where('b.id_auteur = au.id')
          ->getQuery();
          //->getResult();
  }
  */


  public function findByCategory()
  {
    return $this->createQueryBuilder('b')
      ->orderBy('b.id', 'DESC')
      ->setMaxResults(3)
      ->getQuery()
      ->getResult();

      return getResult();
  }
}
