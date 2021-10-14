<?php

namespace App\Controller;

use App\Entity\Echantillon;
use App\Entity\Labo;
use App\Entity\Robot;
use App\Entity\Technicien;
use App\Entity\Truc;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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

    /**
     * Affichage de la liste des laboratoires
     * @return Response
     * @Route(path="/Labos", methods={"GET"})
     */
    public function afficheListeLabos(Request $request,EntityManagerInterface $entityManager){
        $liste = $entityManager->getRepository(Labo::class)->findAll();
        return $this->render('labos.json.twig',['liste'=>$liste]);
    }

    /**
     * Ajout d'un technicien
     * @return Response
     * @Route(path="/Technicien/{idRobot}", methods={"POST"})
     */
    public function ajoutTechnicien(Request $request,EntityManagerInterface $entityManager, $idRobot){
        $robotNew = $entityManager->getRepository(Robot::class)->find($idRobot);
        $infoTech = json_decode($request->getContent());
        $Tech = new Technicien($infoTech->nom,$infoTech->prenom,$robotNew);
        $entityManager->persist($Tech);
        $entityManager->flush();
        return $this->render('tech.json.twig',['Technicien'=>$Tech]);
    }

    /**
     * Affichage d'un technicien à partir de son id
     * @return Response
     * @Route(path="/Technicien/{id}", methods={"GET"})
     */
    public function afficheTechnicien(Request $request,EntityManagerInterface $entityManager, $id){
        $tech = $entityManager->getRepository(Technicien::class)->find($id);
        return $this->render('tech.json.twig',['Technicien'=>$tech]);
    }

    /**
     * Modification d'un technicien à partir de son id
     * @return Response
     * @Route(path="/Technicien/{id}", methods={"PUT"})
     */
    public function modifTechnicien(Request $request,EntityManagerInterface $entityManager, $id){
        $infoTech = json_decode($request->getContent());
        $tech = $entityManager->getRepository(Technicien::class)->find($id);
        $tech->nom = $infoTech->nom;
        $tech->prenom = $infoTech->prenom;
        $entityManager->flush();
        return $this->render('tech.json.twig',['Technicien'=>$tech]);
    }

    /**
     * Suppression d'un technicien à partir de son id
     * @return Response
     * @Route(path="/Technicien/{id}", methods={"DELETE"})
     */
    public function suppTechnicien(Request $request,EntityManagerInterface $entityManager, $id){
        $tech = $entityManager->getRepository(Technicien::class)->find($id);
        $entityManager->remove($tech);
        $entityManager->flush();
        return new Response("ok");
    }

}