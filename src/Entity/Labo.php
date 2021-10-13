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
    public $id;

    /**
     * @var string
     * @ORM\Column(name="nom_labo", type="string")
     */
    public $nom;

    /**
     * @var string
     * @ORM\Column(name="type_labo", type="string")
     */
    public $type;

    // Inversion clé étrangère (liste des robots du laboratoire)
    /**
     * @var Collection
     * @ORM\OneToMany(targetEntity=Robot::class, mappedBy="idLabo")
     */
    public $listeRobot;

    // Inversion clé étrangère (liste des échantillons du laboratoire)
    /**
     * @var Collection
     * @ORM\OneToMany(targetEntity=Echantillon::class, mappedBy="idLabo")
     */
    public $listeEchantillon;

    /**
     * COnstructeur de la classe labo
     * @param $nom nom du laboratoire
     * @param $type type du laboratoire
     */
    public function __construct($nom, $type){
        $this->nom = $nom;
        $this->type = $type;

        // Inversion clé étrangère (liste des robots du laboratoire)
        $this->listeRobot = new ArrayCollection();
        // Inversion clé étrangère (liste des echantillons du laboratoire)
        $this->listeEchantillon = new ArrayCollection();

    }
}