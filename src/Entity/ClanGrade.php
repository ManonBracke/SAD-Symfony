<?php

namespace App\Entity;

use App\Repository\ClanGradeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ClanGradeRepository::class)]
class ClanGrade
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column]
    private ?int $gradeOrder = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $updatedAt = null;

    #[ORM\OneToMany(mappedBy: 'grade', targetEntity: ClanMember::class)]
    private Collection $clanMembers;

    public function __construct()
    {
        $this->clanMembers = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getGradeOrder(): ?int
    {
        return $this->gradeOrder;
    }

    public function setGradeOrder(int $gradeOrder): self
    {
        $this->gradeOrder = $gradeOrder;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeImmutable $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * @return Collection<int, ClanMember>
     */
    public function getClanMembers(): Collection
    {
        return $this->clanMembers;
    }

    public function addClanMember(ClanMember $clanMember): self
    {
        if (!$this->clanMembers->contains($clanMember)) {
            $this->clanMembers->add($clanMember);
            $clanMember->setGrade($this);
        }

        return $this;
    }

    public function removeClanMember(ClanMember $clanMember): self
    {
        if ($this->clanMembers->removeElement($clanMember)) {
            // set the owning side to null (unless already changed)
            if ($clanMember->getGrade() === $this) {
                $clanMember->setGrade(null);
            }
        }

        return $this;
    }
}
