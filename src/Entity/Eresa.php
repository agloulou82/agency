<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\EresaRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Eresa
{
    public const OFFER_LIFE_LIMIT = 30;
    public const OFFER_MAX_LIMIT_BY_USER = 1;
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var boolean
     *
     * @ORM\Column(type="boolean", options={"default"=true})
     */
    private $activated = true;

    /**
     * @ORM\Column(type="datetime")
     */
    private $expiresAt;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createAt;

    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="eresas")
     * @ORM\JoinColumn(nullable=false)
     *
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Offer", inversedBy="eresas")
     * @ORM\JoinColumn(nullable=false)
     */
    private $offer;

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return bool
     */
    public function getActivated(): bool
    {
        return $this->activated;
    }

    /**
     * @param bool $activated
     * @return self
     */
    public function setActivated(bool $activated): self
    {
        $this->activated = $activated;
        return $this;
    }

    public function getExpiresAt(): ?\DateTime
    {
        return $this->expiresAt;
    }

    public function setExpiresAt(\DateTime $expiresAt): self
    {
        $this->expiresAt = $expiresAt;

        return $this;
    }

    public function getCreateAt(): ?\DateTime
    {
        return $this->createAt;
    }

    public function setCreateAt(\DateTime $createAt): self
    {
        $this->createAt = $createAt;

        return $this;
    }
    /**
     * @ORM\PrePersist()
     */
    public function setCreateAtValue()
    {
        $this->createAt = new \DateTime();
    }

    /**
     * @ORM\PrePersist()
     */
    public function setExpiresAtValue()
    {
        $this->expiresAt = new \DateTime('+'.self::OFFER_LIFE_LIMIT.' day');
    }

    public function getUser(): User
    {
        return $this->user;
    }

    public function setUser(User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getOffer(): Offer
    {
        return $this->offer;
    }

    public function setOffer(Offer $offer): self
    {
        $this->offer = $offer;

        return $this;
    }
}
