<?php
declare(strict_types=1);

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinTable;

/**
 * @ORM\Table(name="`group`")
 * @ORM\Entity
 */
class Group
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private int $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=40, nullable=false)
     */
    private string $name = '';

    /**
     * @var Asset[]|Collection
     *
     * @ORM\ManyToMany(
     *      targetEntity="Asset",
     *      mappedBy="groups"
     * )
     * @JoinTable(name="group_assets")
     */
    private $assets;

    /**
     * @var User[]|Collection
     *
     * @ORM\ManyToMany(
     *      targetEntity="User",
     *      mappedBy="groups"
     * )
     * @JoinTable(name="users_groups")
     */
    private $users;

    public function __construct()
    {
        $this->assets = new ArrayCollection();
        $this->users = new ArrayCollection();
    }


    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): self
    {
        $this->id = $id;
        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    public function getAssets(): Collection
    {
        return $this->assets;
    }

    public function setAssets(Collection $assets): self
    {
        $this->assets = $assets;
        return $this;
    }
    
    public function addAsset(Asset $asset): self
    {
        $this->assets->add($asset);

        return $this;
    }

    public function removeAsset(Asset $asset): self
    {
        if ($this->assets->contains($asset)) {
            $this->assets->removeElement($asset);
        }

        return $this;
    }

    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function setUsers(Collection $users): self
    {
        $this->users = $users;
        return $this;
    }

    public function addUser(User $user): self
    {
        $this->users->add($user);

        return $this;
    }

    public function removeUser(User $user): self
    {
        if ($this->users->contains($user)) {
            $this->users->removeElement($user);
        }

        return $this;
    }
}
