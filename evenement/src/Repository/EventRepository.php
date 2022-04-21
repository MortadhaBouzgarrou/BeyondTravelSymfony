<?php

namespace App\Repository;

use App\Entity\Evenement;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

use App\Entity\Participation;







class EventRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Evenement::class);
    }
    

    public function selectbycapacite():array
    {
        return $this->getEntityManager()
        ->createQuery(
            'SELECT p FROM APP\Entity\Evenement p 
            WHERE p.capacite > 0'
        )
        ->getResult();
    }
    public function capaciteDOWNbyONE($str)
    {
        $conn = $this->getEntityManager()->getConnection();
       
        $sql = 
            'UPDATE EVENEMENT SET CAPACITE=CAPACITE-1 where id_event=:str ' ;
                $stmt = $conn->prepare($sql);
                $resultSet = $stmt->executeQuery(['str' => $str]);
       
    }
    public function delete($idevent,$iduser)
    {
        $conn = $this->getEntityManager()->getConnection();
       
        $sql = 
            'DELETE FROM PARTICIPATION WHERE idevenement=:idevent AND iduser=:iduser' ;
                $stmt = $conn->prepare($sql);
              $stmt->executeQuery(['idevent' => $idevent],['iduser' => $iduser]);
       
            


    }
    public function capaciteUPbyONE($str)
    {
        $conn = $this->getEntityManager()->getConnection();
       
        $sql = 
            'UPDATE EVENEMENT SET CAPACITE=CAPACITE+1 where id_event=:str ' ;
                $stmt = $conn->prepare($sql);
                $resultSet = $stmt->executeQuery(['str' => $str]);
       
            


    }
}