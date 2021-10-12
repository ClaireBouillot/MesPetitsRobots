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
class Echantillon
{
    /**
     * @var int
     * @ORM\GeneratedValue()
     * @ORM\Column(name="id_ech", type="integer")
     * @ORM\Id()
     */
    public $idEch;

    /**
     * @var string
     * @ORM\Column(name="type_ech", type="string")
     */
    public $typeEch;

    /**
     * @var Labo:null
     * @ORM\ManyToOne(targetEntity="App\Entity\Labo", fetch="EAGER")
     * @ORM\JoinColumn(name="id_labo", referencedColumnName="id_labo")
     */
    public $idLabo;

    public function __construct($typeEch, $idLabo){
        $this->typeEch = $typeEch;
        $this->idLabo = $idLabo;
    }
}
