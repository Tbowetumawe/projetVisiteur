<?php

namespace App\Repository;

use App\Entity\LigneFraisForfait;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method LigneFraisForfait|null find($id, $lockMode = null, $lockVersion = null)
 * @method LigneFraisForfait|null findOneBy(array $criteria, array $orderBy = null)
 * @method LigneFraisForfait[]    findAll()
 * @method LigneFraisForfait[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LigneFraisForfaitRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, LigneFraisForfait::class);
    }
    
    /**public function lingneffV($value){
        return $this->createQueryBuilder('ligneff')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery();
    }-*
    
    // /**
    //  * @return LigneFraisForfait[] Returns an array of LigneFraisForfait objects
    //  */
    
    public function findIdfff($id)
    {
        $idfff = $this->_em->createQueryBuilder();
        $idfff->select('l')
            ->from(LigneFraisForfait::class,'l')
            ->where('l.fichefrais = :id')
            ->setParameter('id', $id);
            $request = $idfff->getQuery();
            $result = $request->getResult();
        return $result;
    }
    
      public function getLffMois($mois, $id)
    {
        $qb = $this->_em->createQueryBuilder();
        $qb->select('lff')
            ->from(LigneFraisForfait::class, 'lff')
            ->where('lff.fraisforfait = :id')
            ->andWhere('lff.mois = :mois')
            ->setParameter('id', $id)
            ->setParameter('mois', $mois);
        $query = $qb->getQuery();
        $result = $query->getResult();
        return $result;
    }

    /*
    public function findOneBySomeField($value): ?LigneFraisForfait
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
