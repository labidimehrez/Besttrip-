<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of SignalisationRepository
 *
 * @author marwen
 */

namespace BestTripAdmin\AdministrateurBundle\Entity;

use \Doctrine\ORM\EntityRepository;

class SignalisationRepository extends EntityRepository {

    //put your code here
    

        public function findSignalisationItineraire() {
        $query = $this->getEntityManager()->createQuery("SELECT s FROM AdministrateurBundle:Signalisation s WHERE s.idItineraire IS NOT NULL GROUP BY s.idItineraire");
        return $query->getResult();
    }

    public function DeleteSignalisationItineraire($id) {
        $query = $this->getEntityManager()->createQuery("DELETE FROM AdministrateurBundle:Signalisation s WHERE s.idItineraire= :idI");
        $query->setParameter('idI', $id);
        return $query->execute();
    }

    public function DeleteSignalisationANDItineraire($idi) {
        $query = $this->getEntityManager()->createQuery("DELETE FROM AdministrateurBundle:Itineraire i WHERE i.idItineraire= :idI");
        $query->setParameter('idI', $idi);
        return $query->execute();
    }
     
    
    public function findNombreSignalisationItineraire($ids){
    $query = $this->getEntityManager()->createQuery("SELECT COUNT (s.idSignalisation)  FROM AdministrateurBundle:Signalisation s WHERE s.idItineraire= :idI");    
       $query->setParameter('idI', $ids); 
       return $query->getSingleScalarResult();
    }

    
        public function findSignalisationRecommandation() {
        $query = $this->getEntityManager()->createQuery("SELECT s FROM AdministrateurBundle:Signalisation s WHERE s.idRecommandation IS NOT NULL GROUP BY s.idRecommandation");
        return $query->getResult();
    }
    
    
    public function DeleteSignalisationRecommandation($id) {
        $query = $this->getEntityManager()->createQuery("DELETE FROM AdministrateurBundle:Signalisation s WHERE s.idRecommandation= :idD");
        $query->setParameter('idD', $id);
        return $query->execute();
    }
    
    public function DeleteSignalisationANDRecommandation($idr) {
        $query = $this->getEntityManager()->createQuery("DELETE FROM AdministrateurBundle:Recommandation i WHERE i.idRecommandation= :idR");
        $query->setParameter('idR', $idr);
        return $query->execute();
    }
    
    
    public function findNombreSignalisationRecommandation($idr){
    $query = $this->getEntityManager()->createQuery("SELECT COUNT (s.idSignalisation)  FROM AdministrateurBundle:Signalisation s WHERE s.idRecommandation= :idR");    
       $query->setParameter('idR', $idr); 
       return $query->getSingleScalarResult();
    }
    
    
    
     public function findSignalisationOffre() {
        $query = $this->getEntityManager()->createQuery("SELECT s FROM AdministrateurBundle:Signalisation s WHERE s.idOffrep IS NOT NULL GROUP BY s.idOffrep");
        return $query->getResult();
    }
    
    
     public function DeleteSignalisationOffre($id) {
        $query = $this->getEntityManager()->createQuery("DELETE FROM AdministrateurBundle:Signalisation s WHERE s.idOffrep= :idO");
        $query->setParameter('idO', $id);
        return $query->execute();
    }
    
    public function DeleteSignalisationANDOffre($ido) {
        $query = $this->getEntityManager()->createQuery("DELETE FROM AdministrateurBundle:OffrePersonnelle i WHERE i.idOffrep= :idO");
        $query->setParameter('idO', $ido);
        return $query->execute();
    }
    
    
     public function findNombreSignalisationOffre($ido){
    $query = $this->getEntityManager()->createQuery("SELECT COUNT (s.idSignalisation)  FROM AdministrateurBundle:Signalisation s WHERE s.idOffrep= :idO");    
       $query->setParameter('idO', $ido); 
       return $query->getSingleScalarResult();
    }
    
    public function  CountNbreSignalisationI(){
        $query = $this->getEntityManager()->createQuery("SELECT COUNT (s.idSignalisation)  FROM AdministrateurBundle:Signalisation s WHERE s.idItineraire IS NOT NULL GROUP BY s.idItineraire"); 
           return $query->getScalarResult();
        }
    
    
        public function  CountNbreSignalisationR(){
        $query = $this->getEntityManager()->createQuery("SELECT COUNT (s.idSignalisation)  FROM AdministrateurBundle:Signalisation s WHERE s.idRecommandation IS NOT NULL GROUP BY s.idRecommandation"); 
           return $query->getScalarResult();
        }
        
}
