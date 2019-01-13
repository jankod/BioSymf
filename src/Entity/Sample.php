<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Sample
 *
 * @ORM\Table(name="sample")
 * @ORM\Entity
 */
class Sample
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue()
     */
    private $id;

    /**
     * @var string|null
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=true)
     */
    private $name;

    /**
     * @var Project
     *
     * @ORM\ManyToOne(targetEntity="Project")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="project_id", referencedColumnName="id")
     * })
     */
    private $project;

    /**
     * @var ArrayCollection|SampleFile[]
     * @ORM\OneToMany(targetEntity="App\Entity\SampleFile", mappedBy="sample", orphanRemoval=true)
     */
    private $sampleFiles;




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

    public function getProject(): ?Project
    {
        return $this->project;
    }

    public function setProject(?Project $project): self
    {
        $this->project = $project;

        return $this;
    }

    /**
     * @param SampleFile[]|ArrayCollection $sampleFiles
     * @return Sample
     */
    public function setSampleFiles($sampleFiles)
    {
        $this->sampleFiles = $sampleFiles;
        return $this;
    }

    /**
     * @return SampleFile[]|ArrayCollection
     */
    public function getSampleFiles()
    {
        return $this->sampleFiles;
    }


}
