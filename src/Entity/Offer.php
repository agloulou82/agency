<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\OfferRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Offer
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $introduction;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="boolean", options={"default":true})
     */
    private $isActivated;

    /**
     * @ORM\Column(type="datetime", nullable=true )
     */
    private $expiresAt;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $createAt;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Eresa", mappedBy="offer", orphanRemoval=true)
     */
    private $eresas;


    public function __construct()
    {
        $this->eresas = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->getTitle();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getIntroduction(): ?string
    {
        return $this->introduction;
    }

    public function setIntroduction(string $introduction): self
    {
        $this->introduction = $introduction;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getIsActivated(): ?bool
    {
        return $this->isActivated;
    }

    public function setIsActivated(bool $isActivated): self
    {
        $this->isActivated = $isActivated;

        return $this;
    }

    public function getExpiresAt(): ?\DateTimeInterface
    {
        return $this->expiresAt;
    }

    public function setExpiresAt(?\DateTimeInterface $expiresAt): self
    {
        $this->expiresAt = $expiresAt;

        return $this;
    }

    public function getCreateAt(): ?\DateTimeInterface
    {
        return $this->createAt;
    }

    public function setCreateAt(?\DateTimeInterface $createAt): self
    {
        $this->createAt = $createAt;

        return $this;
    }

    /**
     * @ORM\PrePersist
     */
    public function setCreateAtValue()
    {
        $this->createAt = new \DateTime();
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
            $eresa->setOffer($this);
        }

        return $this;
    }

    public function removeEresa(Eresa $eresa): self
    {
        if ($this->eresas->contains($eresa)) {
            $this->eresas->removeElement($eresa);
            // set the owning side to null (unless already changed)
            if ($eresa->getOffer() === $this) {
                $eresa->setOffer(null);
            }
        }

        return $this;
    }
}
