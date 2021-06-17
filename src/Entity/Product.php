<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\JoinColumn;
use App\Entity\User;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Entity
 * @Vich\Uploadable
 */
class Product
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    
    /**
     * @ORM\Column(type="string")
     */
    private $brochureFilename;
    
    /**
     * @ORM\Column(type="string", name="imageOriginal", nullable=true)
     */
    private $imageOriginal;
    
    /**
     * @ORM\Column(type="string", name="fileExtra", nullable=true)
     */
    private $fileExtra;


    /**
     * @ORM\Column(type="datetime", nullable=true)
     * @var \DateTime
     */
    private $updatedAt;
    
    /**
     * Many Product have one user. This is the owning side.
     * @ORM\ManyToOne(targetEntity="User", inversedBy="products")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $user;


    /**
     * @ORM\ManyToOne(targetEntity=Folder::class, inversedBy="products")
     */
    private $folder;

    /**
     * @ORM\ManyToMany(targetEntity=Categorie::class, inversedBy="products")
     */
    private $categorie;

    /**
     * @ORM\OneToMany(targetEntity=UserDownload::class, mappedBy="product")
     */
    private $userDownloads;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $libelle;

    public function __construct()
    {
        $this->categorie = new ArrayCollection();
        $this->userDownloads = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBrochureFilename()
    {
        return $this->brochureFilename;
    }

    public function setBrochureFilename($brochureFilename)
    {
        $this->brochureFilename = $brochureFilename;

        return $this;
    }
    
    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getImageOriginal(): ?string
    {
        return $this->imageOriginal;
    }

    public function setImageOriginal(string $imageOriginal): self
    {
        $this->imageOriginal = $imageOriginal;

        return $this;
    }

    public function getFileExtra(): ?string
    {
        return $this->fileExtra;
    }

    public function setFileExtra(string $fileExtra): self
    {
        $this->fileExtra = $fileExtra;

        return $this;
    }


    public function getFolder(): ?Folder
    {
        return $this->folder;
    }

    public function setFolder(?Folder $folder): self
    {
        $this->folder = $folder;

        return $this;
    }

    /**
     * @return Collection|Categorie[]
     */
    public function getCategorie(): Collection
    {
        return $this->categorie;
    }

    public function addCategorie(Categorie $categorie): self
    {
        if (!$this->categorie->contains($categorie)) {
            $this->categorie[] = $categorie;
        }

        return $this;
    }

    public function removeCategorie(Categorie $categorie): self
    {
        $this->categorie->removeElement($categorie);

        return $this;
    }

    /**
     * @return Collection|UserDownload[]
     */
    public function getUserDownloads(): Collection
    {
        return $this->userDownloads;
    }

    public function addUserDownload(UserDownload $userDownload): self
    {
        if (!$this->userDownloads->contains($userDownload)) {
            $this->userDownloads[] = $userDownload;
            $userDownload->setProduct($this);
        }

        return $this;
    }

    public function removeUserDownload(UserDownload $userDownload): self
    {
        if ($this->userDownloads->removeElement($userDownload)) {
            // set the owning side to null (unless already changed)
            if ($userDownload->getProduct() === $this) {
                $userDownload->setProduct(null);
            }
        }

        return $this;
    }

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(string $libelle): self
    {
        $this->libelle = $libelle;

        return $this;
    }
    
    
}
