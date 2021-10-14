<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Entity;

/**
 * @Entity
 * @ORM\Table(name="LesTechs")
 */
class Technicien
{
    /**
     * @var int
     * @ORM\GeneratedValue()
     * @ORM\Column(name="id_tech", type="integer")
     * @ORM\Id()
     */
    public $id;

    /**
     * @var string
     * @ORM\Column(name="prenom_tech", type="string")
     */
    public $prenom;

    /**
     * @var string
     * @ORM\Column(name="nom_tech", type="string")
     */
    public $nom;

    /**
     * @var Robot:null
     * @ORM\ManyToOne(targetEntity="App\Entity\Robot", fetch="EAGER", inversedBy="listeTechsEntretien")
     * @ORM\JoinColumn(name="entretien_robot", referencedColumnName="id")
     */
    public $entretienRobot;

    /**
     * Constructeur de la classe technicien
     * @param $prenomTech Prénom du technicien
     * @param $nomTech Nom du technicien
     * @param $entretienRobot Identifiant du robot que ce technicien entretient
     */
    public function __construct($nom, $prenom, $entretienRobot){
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->entretienRobot = $entretienRobot;
    }
}