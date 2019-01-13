<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation\Uploadable;
use Vich\UploaderBundle\Form\Type\VichFileType;
use Vich\UploaderBundle\Mapping\Annotation as Vich;


/**
 * SampleFile
 *
 * @ORM\Table(name="sample_file")
 * @ORM\Entity(repositoryClass="App\Repository\SampleFileRepository")
 * @Vich\Uploadable
 */
class SampleFile
{

    const TAXONOMY_TYPE = "Taxonomy";
    const TAXONOMY_MERGED_TYPE = "Taxonomy merged";
    const PATHWAY_TYPE = 'Pathway';
    const PATHWAY_MERGED_TYPE = 'Pathway merged';

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
     * NOTE: This is not a mapped field of entity metadata, just a simple property.
     *
     * @Vich\UploadableField(mapping="sample_file", fileNameProperty="fileName")
     *
     * @var File
     */
    private $sampleFile;


    /**
     * @ORM\Column(type="datetime")
     *
     * @var \DateTime
     */
    private $updatedAt;



    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=255, nullable=false)
     */
    private $type;

    /**
     * @var Sample
     *
     * @ORM\ManyToOne(targetEntity="Sample")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="sample_id", referencedColumnName="id")
     * })
     */
    private $sample;



    public function __toString()
    {
        return $this->getFileName();
    }


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

    /**
     * @param \DateTime $updatedAt
     * @return SampleFile
     */
    public function setUpdatedAt(\DateTime $updatedAt): SampleFile
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }

    /**
     * @param File $sampleFile
     * @return SampleFile
     * @throws \Exception
     */
    public function setSampleFile(?File $sampleFile): SampleFile
    {

        $this->sampleFile = $sampleFile;

        if (null !== $sampleFile) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->updatedAt = new \DateTimeImmutable();
        }

        $this->sampleFile = $sampleFile;
        return $this;
    }

    /**
     * @return File
     */
    public function getSampleFile(): ?File
    {
        return $this->sampleFile;
    }

    /**
     * @return \DateTime
     */
    public function getUpdatedAt(): ?\DateTime
    {
        return $this->updatedAt;
    }


}
