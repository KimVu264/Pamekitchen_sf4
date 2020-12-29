<?php

namespace App\Repository;

use App\Entity\Recette;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;

/**
 * @method Recette|null find($id, $lockMode = null, $lockVersion = null)
 * @method Recette|null findOneBy(array $criteria, array $orderBy = null)
 * @method Recette[]    findAll()
 * @method Recette[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RecetteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Recette::class);
    }

    // /**
    //  * @return Recettes[] Returns an array of Recettes objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Recettes
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    public function search($keyword)
    {
        // $keyword= $request->get('searchName');
        return $this->createQueryBuilder('r')
            ->andWhere('r.name LIKE :searchName')
            ->setParameter('searchName', '%'.$keyword.'%')
            ->orderBy('r.id', 'ASC')            
            ->getQuery()
            ->getResult();

    }

    public function category()
    {
        return $this->createQueryBuilder('r') 
            ->groupBy('r.category') 
            ->setMaxResults(3) 
            ->getQuery()
            ->getResult();
    }

}
