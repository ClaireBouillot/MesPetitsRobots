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
    public $idTech;

    /**
     * @var string
     * @ORM\Column(name="prenom_tech", type="string")
     */
    public $prenomTech;

    /**
     * @var string
     * @ORM\Column(name="nom_tech", type="string")
     */
    public $nomTech;

    /**
     * @var Robot:null
     * @ORM\ManyToOne(targetEntity="App\Entity\Robot", fetch="EAGER")
     * @ORM\JoinColumn(name="entretien_robot", referencedColumnName="id")
     */
    public $entretienRobot;

    public function __construct($prenomTech, $nomTech, $entretienRobot){
        $this->prenomTech = $prenomTech;
        $this->nomTech = $nomTech;
        $this->entretienRobot = $entretienRobot;
    }
}