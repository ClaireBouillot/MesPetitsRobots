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
    public $nom_robot;

    /**
     * @var int
     * @ORM\Column(name="age", type="integer")
     */
    public $age;

    /**
     * @var Labo:null
     * @ORM\ManyToOne(targetEntity="App\Entity\Labo", fetch="EAGER")
     * @ORM\JoinColumn(name="id_labo", referencedColumnName="id_labo")
     */
    public $idLabo;

    // Inversion clé étrangère (liste des techniciens qui entretiennent un robot)
    /**
     * @var Collection
     * @ORM\OneToMany(targetEntity=Technicien::class, mappedBy="Robot")
     */
    public $listeTechsEntretien;

    public function __construct($nom_robot, $age, $idLabo){
        $this->nom_robot = $nom_robot;
        $this->age = $age;
        $this->idLabo = $idLabo;
        // Inversion clé étrangère (liste des techniciens qui entretiennent un robot)
        $this->listeTechsEntretien = new ArrayCollection();
    }
}
