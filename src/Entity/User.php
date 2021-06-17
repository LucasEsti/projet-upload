<?php
namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Nucleos\UserBundle\Model\User as BaseUser;
use App\Entity\Group as Group;
use App\Entity\Product;

/**
 * @ORM\Entity
 * @ORM\Table(name="nucleos_user__user")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $down_compt;
    
    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Group")
     * @ORM\JoinTable(name="nucleos_user_user_group",
     *      joinColumns={@ORM\JoinColumn(name="user_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="group_id", referencedColumnName="id")}
     * )
     */
    protected $groups;
    
    /**
     * One User has many Products. This is the inverse side.
     * @ORM\OneToMany(targetEntity="App\Entity\Product", mappedBy="user")
     */
    private $products;

    /**
     * @ORM\OneToMany(targetEntity=Subscription::class, mappedBy="user")
     */
    private $subscriptions;

    /**
     * @ORM\OneToMany(targetEntity=Folder::class, mappedBy="user")
     */
    private $folders;

    /**
     * @ORM\OneToMany(targetEntity=UserDownload::class, mappedBy="user")
     */
    private $userDownloads;

    

    public function __construct()
    {
        parent::__construct();
        // your own logic
        $this->groups = new ArrayCollection();
        $this->products = new ArrayCollection();
        $this->subscriptions = new ArrayCollection();
        $this->folders = new ArrayCollection();
        $this->userDownloads = new ArrayCollection();
    }

    public function getDownCompt(): ?int
    {
        return $this->down_compt;
    }

    public function setDownCompt(int $down_compt): self
    {
        $this->down_compt = $down_compt;

        return $this;
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
            $product->setUser($this);
        }

        return $this;
    }

    public function removeProduct(Product $product): self
    {
        if ($this->products->removeElement($product)) {
            // set the owning side to null (unless already changed)
            if ($product->getUser() === $this) {
                $product->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Subscription[]
     */
    public function getSubscriptions(): Collection
    {
        return $this->subscriptions;
    }

    public function addSubscription(Subscription $subscription): self
    {
        if (!$this->subscriptions->contains($subscription)) {
            $this->subscriptions[] = $subscription;
            $subscription->setUser($this);
        }

        return $this;
    }

    public function removeSubscription(Subscription $subscription): self
    {
        if ($this->subscriptions->removeElement($subscription)) {
            // set the owning side to null (unless already changed)
            if ($subscription->getUser() === $this) {
                $subscription->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Folder[]
     */
    public function getFolders(): Collection
    {
        return $this->folders;
    }

    public function addFolder(Folder $folder): self
    {
        if (!$this->folders->contains($folder)) {
            $this->folders[] = $folder;
            $folder->setUser($this);
        }

        return $this;
    }

    public function removeFolder(Folder $folder): self
    {
        if ($this->folders->removeElement($folder)) {
            // set the owning side to null (unless already changed)
            if ($folder->getUser() === $this) {
                $folder->setUser(null);
            }
        }

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
            $userDownload->setUser($this);
        }

        return $this;
    }

    public function removeUserDownload(UserDownload $userDownload): self
    {
        if ($this->userDownloads->removeElement($userDownload)) {
            // set the owning side to null (unless already changed)
            if ($userDownload->getUser() === $this) {
                $userDownload->setUser(null);
            }
        }

        return $this;
    }


    
    
}
