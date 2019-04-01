<?php

namespace App\Entity;

use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Column;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Project
 *
 * @ORM\Table(name="project")
 * @ORM\Entity
 */
class Project
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string|null
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=false)
     * @Assert\NotBlank()
     * @Assert\NotNull()
     */
    private $name;


    /**
     * @var string|null
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    private $description;

    /**
     * @var DateTime
     * @ORM\Column(name="start_date", type="datetime", nullable=true)
     */
    private $startDate;


    /**
     * @var DateTime
     * @ORM\Column(name="end_date", type="datetime", nullable=true)
     */
    private $endDate;

    /**
     * @var boolean
     * @ORM\Column(name="is_public", type="boolean", nullable=false, options={"default": false})
     */
    private $isPublic;

    /**
     * @var string
     * @ORM\Column(name="status", type="string", columnDefinition="ENUM('started', 'ongoing', 'ended')", nullable=true)
     */
    private $status;

    /**
     * @var ArrayCollection|Sample[]
     * @ORM\OneToMany(targetEntity="App\Entity\Sample", mappedBy="project", orphanRemoval=true)
     */
    private $samples;

    public function __construct()
    {
        $this->samples = new ArrayCollection();
    }


    public function __toString()
    {
        return $this->getName();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @param string|null $description
     * @return Project
     */
    public function setDescription(?string $description): Project
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @param DateTime $startDate
     * @return Project
     */
    public function setStartDate(?DateTime $startDate): Project
    {
        $this->startDate = $startDate;
        return $this;
    }

    /**
     * @return DateTime
     */
    public function getStartDate(): ?DateTime
    {
        return $this->startDate;
    }

    /**
     * @param DateTime $endDate
     * @return Project
     */
    public function setEndDate(?DateTime $endDate): Project
    {
        $this->endDate = $endDate;
        return $this;
    }

    /**
     * @return DateTime
     */
    public function getEndDate(): ?DateTime
    {
        return $this->endDate;
    }

    /**
     * @param bool $isPublic
     * @return Project
     */
    public function setIsPublic(?bool $isPublic): Project
    {
        $this->isPublic = $isPublic;
        return $this;
    }

    /**
     * @return bool
     */
    public function isPublic(): ?bool
    {
        return $this->isPublic;
    }

    /**
     * @param mixed $status
     * @return Project
     */
    public function setStatus(?string $status)
    {
        $this->status = $status;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getStatus(): ?string
    {
        return $this->status;
    }

    /**
     * @param Sample[]|ArrayCollection $samples
     * @return Project
     */
    public function setSamples($samples)
    {
        $this->samples = $samples;
        return $this;
    }

    /**
     * @return Sample[]|ArrayCollection
     */
    public function getSamples()
    {
        return $this->samples;
    }

}
