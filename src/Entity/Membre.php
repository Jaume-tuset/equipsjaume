<?php

namespace App\Entity;
use Symfony\Component\Validator\Constraints as Assert;
use App\Repository\MembreRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MembreRepository::class)]
class Membre
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;
    
    #[Assert\NotBlank]
    #[ORM\Column(length: 50)]
    private ?string $nom = null;

    #[Assert\NotBlank]
    #[ORM\Column(length: 100)]
    private ?string $cognoms = null;

    #[Assert\NotBlank]
    #[Assert\Email(message: "L'email {{ value }} no es vàlid ")]
    #[ORM\Column(length: 150, unique:true)]
    private ?string $email = null;

    #[ORM\Column(length: 255)]
    private ?string $imatge_perfil = null;

    #[Assert\NotBlank]
    #[Assert\Range(min:'first day of January 1950')]
    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $data_naixement = null;

    
    #[Assert\NotBlank]
    #[Assert\Type(type: 'numeric',message:'El valor {{ value }} es no un valido {{ type }}.')]
    #[Assert\LessThanOrEqual(10, message:'La nota ha de ser menor o igual que 10')]
    #[Assert\GreaterThanOrEqual(0, message:'La nota ha de ser major o igual que 0')]
    #[ORM\Column(nullable: true)]
    private ?float $nota = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Equip $equip = null;

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

    public function getCognoms(): ?string
    {
        return $this->cognoms;
    }

    public function setCognoms(string $cognoms): self
    {
        $this->cognoms = $cognoms;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getImatgePerfil(): ?string
    {
        return $this->imatge_perfil;
    }

    public function setImatgePerfil(string $imatge_perfil): self
    {
        $this->imatge_perfil = $imatge_perfil;

        return $this;
    }

    public function getDataNaixement(): ?\DateTimeInterface
    {
        return $this->data_naixement;
    }

    public function setDataNaixement(\DateTimeInterface $data_naixement): self
    {
        $this->data_naixement = $data_naixement;

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

    public function getEquip(): ?Equip
    {
        return $this->equip;
    }

    public function setEquip(?Equip $equip): self
    {
        $this->equip = $equip;

        return $this;
    }
}
