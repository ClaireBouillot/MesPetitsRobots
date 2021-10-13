<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Entity;

/**
 * @Entity
 * @ORM\Table(name="MesPetitsRobots")
 */
class Robot
{
    /**
     * @var int
     * @ORM\GeneratedValue()
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id()
     */
    public $id;

    /**
     * @var string
     * @ORM\Column(name="nom_robot", type="string")
     */
    public $nom;

    /**
     * @var int
     * @ORM\Column(name="age", type="integer")
     */
    public $age;

    /**
     * @var Labo:null
     * @ORM\ManyToOne(targetEntity="App\Entity\Labo", fetch="EAGER", inversedBy="listeRobot")
     * @ORM\JoinColumn(name="id_labo", referencedColumnName="id_labo")
     */
    public $labo;

    // Inversion clé étrangère (liste des techniciens qui entretiennent un robot)
    /**
     * @var Collection
     * @ORM\OneToMany(targetEntity=Technicien::class, mappedBy="entretienRobot")
     */
    public $listeTechsEntretien;

    /**
     * Constructeur de la classe Robot
     * @param $nom Nom du robot
     * @param $age Age du robot
     * @param $labo Laboratoire dans lequel se trouve le robot
     */
    public function __construct($nom, $age, $labo){
        $this->nom = $nom;
        $this->age = $age;
        $this->labo = $labo;
        // Inversion clé étrangère (liste des techniciens qui entretiennent un robot)
        $this->listeTechsEntretien = new ArrayCollection();
    }
}
