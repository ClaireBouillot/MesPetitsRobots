<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Entity;

/**
 * @Entity
 * @ORM\Table(name="LesLabos")
 */
class Labo
{
    /**
     * @var int
     * @ORM\GeneratedValue()
     * @ORM\Column(name="id_labo", type="integer")
     * @ORM\Id()
     */
    public $idLabo;

    /**
     * @var string
     * @ORM\Column(name="nom_labo", type="string")
     */
    public $nomLabo;

    /**
     * @var string
     * @ORM\Column(name="type_labo", type="string")
     */
    public $typeLabo;

    // Inversion clé étrangère (liste des robots du laboratoire)
    /**
     * @var Collection
     * @ORM\OneToMany(targetEntity=Robot::class, mappedBy="Labo")
     */
    public $listeRobot;

    public function __construct($nomLabo, $typeLabo){
        $this->nomLabo = $nomLabo;
        $this->typeLabo = $typeLabo;

        // Inversion clé étrangère (liste des robots du laboratoire)
        $this->listeRobot = new ArrayCollection();

    }
}