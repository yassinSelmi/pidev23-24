<?php

namespace App\Repository;

use App\Entity\ReservationResto;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ReservationResto>
 *
 * @method ReservationResto|null find($id, $lockMode = null, $lockVersion = null)
 * @method ReservationResto|null findOneBy(array $criteria, array $orderBy = null)
 * @method ReservationResto[]    findAll()
 * @method ReservationResto[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ReservationRestoRepository extends ServiceEntityRepository
{     
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ReservationResto::class);
    }




    public function deletereservation()
    {

        $conn = $this->getEntityManager()->getConnection();

        $sql = '
           DELETE FROM `reservation_resto` WHERE date_reserv < CURRENT_DATE ';
        $stmt = $conn->prepare($sql);
        $stmt->execute();


    }








    

}
