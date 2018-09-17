<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * Class UserModel
 *
 * @ORM\Entity
 * @ORM\Table("user")
 */
class User implements UserInterface
{
    /**
     * @var integer
     *
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=45)
     */
    private $username;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255)
     */
    private $password;

    /**
     * @var string
     *
     * Unused   :D
     */
    private $salt;

    /**
     * @var array
     */
    private $roles = ['ROLE_ADMIN'];

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Eresa", mappedBy="user")
     */
    private $eresas;

    /**
     * User constructor.
     */
    public function __construct()
    {
        $this->eresas = new ArrayCollection();
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->username;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * @param string $username
     * @return User
     */
    public function setUsername(string $username): User
    {
        $this->username = $username;

        return $this;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @param string $password
     * @return User
     */
    public function setPassword(string $password): User
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @return string
     */
    public function getSalt()
    {
        return null;
    }

    /**
     * @param string $salt
     * @return User
     */
    public function setSalt(string $salt): User
    {
        $this->salt = $salt;

        return $this;
    }


    /**
     * @return array
     */
    public function getRoles(): array
    {
        return $this->roles;
    }

    /**
     * @param iterable $roles
     * @return User
     */
    public function setRoles(array $roles): User
    {
        $this->roles = $roles;

        return $this;
    }

    public function eraseCredentials()
    {
    }

    /**
     * @return Collection|Eresa[]
     */
    public function getEresas(): Collection
    {
        return $this->eresas;
    }

    public function addEresa(Eresa $eresa): self
    {
        if (!$this->eresas->contains($eresa)) {
            $this->eresas[] = $eresa;
            $eresa->setUser($this);
        }

        return $this;
    }

    public function removeEresa(Eresa $eresa): self
    {
        if ($this->eresas->contains($eresa)) {
            $this->eresas->removeElement($eresa);
            if ($eresa->getUser() === $this) {
                $eresa->setUser(null);
            }
        }

        return $this;
    }
}
