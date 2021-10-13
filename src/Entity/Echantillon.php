<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Entity;

/**
 * @Entity
 * @ORM\Table(name="LesEchantillons")
 */
class Echantillon
{
    /**
     * @var int
     * @ORM\GeneratedValue()
     * @ORM\Column(name="id_ech", type="integer")
     * @ORM\Id()
     */
    public $id;

    /**
     * @var string
     * @ORM\Column(name="type_ech", type="string")
     */
    public $type;

    /**
     * @var Labo:null
     * @ORM\ManyToOne(targetEntity="App\Entity\Labo", fetch="EAGER", inversedBy="listeEchantillon")
     * @ORM\JoinColumn(name="id_labo", referencedColumnName="id_labo")
     */
    public $labo;

    /**
     * Constructeur de la classe echantillon
     * @param $type type d'échantillon
     * @param $labo identifiant du laboratoire dans lequel est analysé l'échantillon
     */
    public function __construct($type, $labo){
        $this->type = $type;
        $this->labo = $labo;
    }
}
