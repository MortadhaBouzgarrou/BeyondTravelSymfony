<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Participation
 *
 * @ORM\Table(name="participation", indexes={@ORM\Index(name="fk_idev", columns={"idevenement"}), @ORM\Index(name="iduser", columns={"iduser"})})
 * @ORM\Entity
 */
class Participation
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var int
     *
     * @ORM\Column(name="idevenement", type="integer", nullable=false)
     */
    private $idevenement;

    /**
     * @var int
     *
     * @ORM\Column(name="iduser", type="integer", nullable=false)
     */
    private $iduser;



    /**
     * Get the value of idevenement
     *
     * @return  int
     */ 
    public function getIdevenement()
    {
        return $this->idevenement;
    }

    /**
     * Set the value of idevenement
     *
     * @param  int  $idevenement
     *
     * @return  self
     */ 
    public function setIdevenement(int $idevenement)
    {
        $this->idevenement = $idevenement;

        return $this;
    }

    /**
     * Get the value of iduser
     *
     * @return  int
     */ 
    public function getIduser()
    {
        return $this->iduser;
    }

    /**
     * Set the value of iduser
     *
     * @param  int  $iduser
     *
     * @return  self
     */ 
    public function setIduser(int $iduser)
    {
        $this->iduser = $iduser;

        return $this;
    }
}
