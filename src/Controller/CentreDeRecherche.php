<?php

namespace App\Controller;

use App\Entity\Labo;
use App\Entity\Robot;
use App\Entity\Technicien;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CentreDeRecherche extends AbstractController
{
    /**
     * @return Response
     * @Route(path="CentreDeRecherche")
     */
    public function centreRecherche(EntityManagerInterface $em){

        echo"<h1> Centre de recherche </h1>";

        $robots = $this->getDoctrine()->getRepository(Robot::class);
        $bddRobot = $robots->findAll();
        echo"<h2> Robots </h2>";
        foreach ($bddRobot as $item){
            echo "<br> Robot ".$item->id." : ".$item->nom_robot."<br>";
            echo"Laboratoire ".$item->idLabo->idLabo." : ".$item->idLabo->nomLabo."<br>";
            echo"<br>";
        };

        $labos = $this->getDoctrine()->getRepository(Labo::class);
        $bddLabo = $labos->findAll();
        echo"<h2> Laboratoires </h2>";
        foreach ($bddLabo as $item){
            echo "<br> Laboratoire ".$item->idLabo." : ".$item->nomLabo."<br>";
        };

        $techs = $this->getDoctrine()->getRepository(Technicien::class);
        $bddTech = $techs->findAll();
        echo"<h2> Techniciens </h2>";
        foreach ($bddTech as $item){
            echo "<br> Technicien ".$item->idTech." : ".$item->nomTech." ".$item->prenomTech."<br>";
            echo"Ce technicien entretient le robot : ".$item->entretienRobot->nom_robot."<br>";
        };
        echo "<br>";

        return new Response("il y a ".count($bddRobot)." robots dans mon laboratoire.");
    }
}