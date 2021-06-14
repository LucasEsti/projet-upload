<?php
namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Nucleos\UserBundle\Model\User as BaseUser;
use App\Entity\Group as Group;

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
     * @ORM\Column(type="integer")
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

    public function __construct()
    {
        parent::__construct();
        // your own logic
        $this->groups = new ArrayCollection();
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

    
    
}
