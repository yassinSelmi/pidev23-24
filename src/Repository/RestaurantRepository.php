<?php

namespace App\Repository;

use App\Entity\Restaurant;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Restaurant>
 *
 * @method Restaurant|null find($id, $lockMode = null, $lockVersion = null)
 * @method Restaurant|null findOneBy(array $criteria, array $orderBy = null)
 * @method Restaurant[]    findAll()
 * @method Restaurant[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RestaurantRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Restaurant::class);
    }

//    /**
//     * @return Restaurant[] Returns an array of Restaurant objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('r')
//            ->andWhere('r.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('r.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Restaurant
//    {
//        return $this->createQueryBuilder('r')
//            ->andWhere('r.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }




public function findProduitsBySujet($nomResto,$specialtie){
    $em = $this->getEntityManager();

    $query = $em->createQuery(
        'SELECT r FROM App\Entity\Restaurant r   where r.nomResto like :nomResto and r.specialtie like :specialtie '
    );

    $query->setParameter('nomResto', $nomResto . '%');
    $query->setParameter('specialtie', $specialtie . '%');

    return $query->getResult();
}



public function find_Nb_Rec_Par_Status($specialtie){

    $em = $this->getEntityManager();

    $query = $em->createQuery(
        'SELECT DISTINCT  count(r.id) FROM   App\Entity\Restaurant r  where r.specialtie = :specialtie   '
    );
    $query->setParameter('specialtie', $specialtie);
    return $query->getResult();
}





}
