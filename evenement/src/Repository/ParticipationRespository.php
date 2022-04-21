<?php

namespace App\Repository;

use App\Entity\Participation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;









class ParticipationRespository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Participation::class);
    }


    public function selectbyevent($str)
    {
        
        return $this->getEntityManager()
        ->createQuery(
            'SELECT p.idevenement FROM APP\Entity\Participation p 
            WHERE p.iduser= :str '
        )->setParameter('str', $str)
        ->getResult();
 
    }

    public function delete($idevent,$iduser)
    {
        return $this->getEntityManager()
        ->createQuery(
            'DELETE FROM APP\Entity\Participation p 
            WHERE p.iduser= :field1 AND p.idevenement=:field2 '
        )        ->setParameters([
            'field1' => $iduser ,
            'field2' => $idevent,
        ])->execute();
       
       
            


    }

}