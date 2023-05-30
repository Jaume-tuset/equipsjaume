<?php

namespace App\Entity;
use Symfony\Component\Validator\Constraints as Assert;
use App\Repository\EquipRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EquipRepository::class)]
class Equip
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;
    
    #[Assert\NotBlank]
    #[ORM\Column(length: 50, unique:true)]
    private ?string $nom = null;

    #[Assert\NotBlank]
    #[ORM\Column(length: 10)]
    private ?string $cicle = null;

    #[Assert\NotBlank]
    #[ORM\Column(length: 10)]
    private ?string $curs = null;

    #[ORM\Column(length: 255)]
    private ?string $imatge = null;

    
    #[Assert\NotBlank] 
    #[Assert\Type(type: 'numeric',message:'El valor {{ value }} no es valido {{ type }}.')]
    #[Assert\LessThanOrEqual(10, message:'La nota ha de ser menor o igual que 10')]
    #[Assert\GreaterThanOrEqual(0, message:'La nota ha de ser major o igual que 0')]
    #[ORM\Column(nullable: true)]
    private ?float $nota = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getCicle(): ?string
    {
        return $this->cicle;
    }

    public function setCicle(string $cicle): self
    {
        $this->cicle = $cicle;

        return $this;
    }

    public function getCurs(): ?string
    {
        return $this->curs;
    }

    public function setCurs(string $curs): self
    {
        $this->curs = $curs;

        return $this;
    }

    public function getImatge(): ?string
    {
        return $this->imatge;
    }

    public function setImatge(string $imatge): self
    {
        $this->imatge = $imatge;

        return $this;
    }

    public function getNota(): ?float
    {
        return $this->nota;
    }

    public function setNota(?float $nota): self
    {
        $this->nota = $nota;

        return $this;
    }

    public function __toString(){
        return $this->imatge;
    }
}
