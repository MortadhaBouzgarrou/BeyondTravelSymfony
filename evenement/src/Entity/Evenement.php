<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Gedmo\Mapping\Annotation as Gedmo; // gedmo annotations
use Symfony\Component\Validator\Constraints as Assert;


/**
 * Evenement
 *
 * @ORM\Table(name="evenement")
 * @ORM\Entity
 * @Vich\Uploadable
 */
class Evenement
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_event", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idEvent;

     /**
     * @var string
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message=" nom doit etre non vide")
     * @Assert\Length(
     *      min = 5,
     *      minMessage=" Entrer un nom au mini de 5 caracteres"
     *
     *     )
     */
    private $nom;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_event", type="date", nullable=false)
     */
    private $dateEvent;

    /**
     * @var string
     *
     * @ORM\Column(name="type_event", type="string", length=30, nullable=false)
     */
    private $typeEvent;

    /**
     * @var int
     *
     * @ORM\Column(name="capacite", type="integer", nullable=false)
     */
    private $capacite;

    /**
     * @var float
     *
     * @ORM\Column(name="prix", type="float", precision=10, scale=0, nullable=false)
     */
    private $prix;

    /**
     * @var string
     *
     * @ORM\Column(name="image", type="string", length=255, nullable=false)
     */
    private $image;

    /**
     * @Vich\UploadableField(mapping="Evenement_images", fileNameProperty="image")
     * @var File
     */
    private $imageFile;
     /**
     * @var \DateTime
     *
     * @ORM\Column(name="updatedAt", type="datetime")
     * @Gedmo\Timestampable(on="update")

     */
    private $updatedAt;
   

    /**
     * Get the value of idEvent
     *
     * @return  int
     */ 
    public function getIdEvent()
    {
        return $this->idEvent;
    }


    /**
     * Get the value of nom
     *
     * @return  string
     */ 
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set the value of nom
     *
     * @param  string  $nom
     *
     * @return  self
     */ 
    public function setNom(string $nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get the value of dateEvent
     *
     * @return  \DateTime
     */ 
    public function getDateEvent()
    {
        return $this->dateEvent;
    }

    /**
     * Set the value of dateEvent
     *
     * @param  \DateTime  $dateEvent
     *
     * @return  self
     */ 
    public function setDateEvent(\DateTime $dateEvent)
    {
        $this->dateEvent = $dateEvent;

        return $this;
    }

    /**
     * Get the value of typeEvent
     *
     * @return  string
     */ 
    public function getTypeEvent()
    {
        return $this->typeEvent;
    }

    /**
     * Set the value of typeEvent
     *
     * @param  string  $typeEvent
     *
     * @return  self
     */ 
    public function setTypeEvent(string $typeEvent)
    {
        $this->typeEvent = $typeEvent;

        return $this;
    }

    /**
     * Get the value of capacite
     *
     * @return  int
     */ 
    public function getCapacite()
    {
        return $this->capacite;
    }

    /**
     * Set the value of capacite
     *
     * @param  int  $capacite
     *
     * @return  self
     */ 
    public function setCapacite(int $capacite)
    {
        $this->capacite = $capacite;

        return $this;
    }

    /**
     * Get the value of prix
     *
     * @return  float
     */ 
    public function getPrix()
    {
        return $this->prix;
    }

    /**
     * Set the value of prix
     *
     * @param  float  $prix
     *
     * @return  self
     */ 
    public function setPrix(float $prix)
    {
        $this->prix = $prix;

        return $this;
    }

    /**
     * Get the value of image
     *
     * @return  string
     */ 
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set the value of image
     *
     * @param  string  $image
     *
     * @return  self
     */ 
    public function setImage(?string $image)
    {
        $this->image = $image;

        return $this;
    }
    public function setImageFile(File $image = null)
    {
        $this->imageFile = $image;

        // VERY IMPORTANT:
        // It is required that at least one field changes if you are using Doctrine,
        // otherwise the event listeners won't be called and the file is lost
        if ($image) {
            // if 'updatedAt' is not defined in your entity, use another property
            $this->updatedAt = new \DateTime('now');
        }
    }

    public function getImageFile()
    {
        return $this->imageFile;
    }
}
