<?php

namespace App\Controller;

use App\Entity\Echantillon;
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
     * Fonction qui affiche les données des différentes classes en html
     * @return Response
     * @Route(path="CentreDeRecherche")
     */
    public function afficheInfosCentre(EntityManagerInterface $em){

        echo"<h1> Centre de recherche </h1>";

        // Affichage des robots
        $robots = $this->getDoctrine()->getRepository(Robot::class);
        $bddRobot = $robots->findAll();
        echo"<h2> Robots </h2>";
        foreach ($bddRobot as $item){
            echo "<br> Robot ".$item->id." : ".$item->nom."<br>";
            echo"Laboratoire ".$item->labo->id." : ".$item->labo->nom."<br>";
            echo"<br>";
        };

        // Affichage des laboratoires
        $labos = $this->getDoctrine()->getRepository(Labo::class);
        $bddLabo = $labos->findAll();
        echo"<h2> Laboratoires </h2>";
        foreach ($bddLabo as $item){
            echo "<br> Laboratoire ".$item->id." : ".$item->nom."<br>";
        };

        // Affichage des techniciens
        $techs = $this->getDoctrine()->getRepository(Technicien::class);
        $bddTech = $techs->findAll();
        echo"<h2> Techniciens </h2>";
        foreach ($bddTech as $item){
            echo "<br> Technicien ".$item->id." : ".$item->nom." ".$item->prenom."<br>";
            echo"Ce technicien entretient le robot : ".$item->entretienRobot->nom."<br>";
        };
        echo "<br>";

        // Affichage des échantillons
        $echs = $this->getDoctrine()->getRepository(Echantillon::class);
        $bddEch = $echs->findAll();
        echo"<h2> Echantillons </h2>";
        foreach ($bddEch as $item){
            echo "<br> Echantillon ".$item->id." : ".$item->type."<br>";
            echo"Cet echantillon est dans le laboratoire : ".$item->labo->id."<br>";
        };
        echo "<br>";

        // Retourne le nombre de robots
        return new Response("il y a ".count($bddRobot)." robots dans mon centre de recherche.");
    }
}