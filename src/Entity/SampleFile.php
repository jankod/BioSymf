<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * SampleFile
 *
 * @ORM\Table(name="sample_file", indexes={@ORM\Index(name="FK5jtcqv3a7iat2spqlkltvwhkv", columns={"sample_id"})})
 * @ORM\Entity
 */
class SampleFile
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
     * @ORM\Column(name="file_name", type="string", length=255, nullable=true)
     */
    private $fileName;

    /**
     * @var string|null
     *
     * @ORM\Column(name="sample_name", type="string", length=255, nullable=true)
     */
    private $sampleName;

    /**
     * @var string|null
     *
     * @ORM\Column(name="type", type="string", length=255, nullable=true)
     */
    private $type;

    /**
     * @var \Sample
     *
     * @ORM\ManyToOne(targetEntity="Sample")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="sample_id", referencedColumnName="id")
     * })
     */
    private $sample;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFileName(): ?string
    {
        return $this->fileName;
    }

    public function setFileName(?string $fileName): self
    {
        $this->fileName = $fileName;

        return $this;
    }

    public function getSampleName(): ?string
    {
        return $this->sampleName;
    }

    public function setSampleName(?string $sampleName): self
    {
        $this->sampleName = $sampleName;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(?string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getSample(): ?Sample
    {
        return $this->sample;
    }

    public function setSample(?Sample $sample): self
    {
        $this->sample = $sample;

        return $this;
    }


}
