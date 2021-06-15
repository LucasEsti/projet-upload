<?php

namespace App\Entity;

use App\Repository\FolderRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=FolderRepository::class)
 */
class Folder
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;


    /**
     * @ORM\OneToMany(targetEntity=Product::class, mappedBy="folder")
     */
    private $products;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $libelle;


    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="folders")
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity=Folder::class, inversedBy="folders")
     * @ORM\JoinColumn()
     */
    private $folder;

    /**
     * @ORM\OneToMany(targetEntity=Folder::class, mappedBy="folder")
     */
    private $folders;



    public function __construct()
    {
        $this->products = new ArrayCollection();
        $this->folders = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    
    /**
     * @return Collection|Product[]
     */
    public function getProducts(): Collection
    {
        return $this->products;
    }

    public function addProduct(Product $product): self
    {
        if (!$this->products->contains($product)) {
            $this->products[] = $product;
            $product->setFolder($this);
        }

        return $this;
    }

    public function removeProduct(Product $product): self
    {
        if ($this->products->removeElement($product)) {
            // set the owning side to null (unless already changed)
            if ($product->getFolder() === $this) {
                $product->setFolder(null);
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
    
    public function __toString() 
    {
        return (string) $this->libelle; 
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

    public function getFolder(): ?self
    {
        return $this->folder;
    }

    public function setFolder(?self $folder): self
    {
        $this->folder = $folder;

        return $this;
    }

    /**
     * @return Collection|self[]
     */
    public function getFolders(): Collection
    {
        return $this->folders;
    }

    public function addFolder(self $folder): self
    {
        if (!$this->folders->contains($folder)) {
            $this->folders[] = $folder;
            $folder->setFolder($this);
        }

        return $this;
    }

    public function removeFolder(self $folder): self
    {
        if ($this->folders->removeElement($folder)) {
            // set the owning side to null (unless already changed)
            if ($folder->getFolder() === $this) {
                $folder->setFolder(null);
            }
        }

        return $this;
    }

    

}
