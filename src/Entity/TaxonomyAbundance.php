<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TaxonomyAbundance
 *
 * @ORM\Table(name="taxonomy_abundance")
 * @ORM\Entity(repositoryClass="TaxonomyAbundanceRepository")
 */
class TaxonomyAbundance
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
     * @var float|null
     *
     * @ORM\Column(name="abundance", type="float", precision=10, scale=0, nullable=true)
     */
    private $abundance;

    /**
     * @var string|null
     *
     * @ORM\Column(name="rank1_kingdom", type="string", length=255, nullable=true)
     */
    private $rank1Kingdom;

    /**
     * @var string|null
     *
     * @ORM\Column(name="rank2_phylum", type="string", length=255, nullable=true)
     */
    private $rank2Phylum;

    /**
     * @var string|null
     *
     * @ORM\Column(name="rank3_class", type="string", length=255, nullable=true)
     */
    private $rank3Class;

    /**
     * @var string|null
     *
     * @ORM\Column(name="rank4_order", type="string", length=255, nullable=true)
     */
    private $rank4Order;

    /**
     * @var string|null
     *
     * @ORM\Column(name="rank5_family", type="string", length=255, nullable=true)
     */
    private $rank5Family;

    /**
     * @var string|null
     *
     * @ORM\Column(name="rank6_genus", type="string", length=255, nullable=true)
     */
    private $rank6Genus;

    /**
     * @var string|null
     *
     * @ORM\Column(name="rank6_species", type="string", length=255, nullable=true)
     */
    private $rank7Species;

    /**
     * @var string|null
     *
     * @ORM\Column(name="rank8_strain", type="string", length=255, nullable=true)
     */
    private $rank8Strain;


    public function __toString()
    {
        return "taxon ". $this->getId();
    }

    /**
     * @var SampleFile
     *
     * @ORM\ManyToOne(targetEntity="SampleFile")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="file_id", referencedColumnName="id")
     * })
     */
    private $file;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAbundance(): ?float
    {
        return $this->abundance;
    }

    public function setAbundance(?float $abundance): self
    {
        $this->abundance = $abundance;

        return $this;
    }

    public function getRank1Kingdom(): ?string
    {
        return $this->rank1Kingdom;
    }

    public function setRank1Kingdom(?string $rank1Kingdom): self
    {
        $this->rank1Kingdom = $rank1Kingdom;

        return $this;
    }

    public function getRank2Phylum(): ?string
    {
        return $this->rank2Phylum;
    }

    public function setRank2Phylum(?string $rank2Phylum): self
    {
        $this->rank2Phylum = $rank2Phylum;

        return $this;
    }

    public function getRank3Class(): ?string
    {
        return $this->rank3Class;
    }

    public function setRank3Class(?string $rank3Class): self
    {
        $this->rank3Class = $rank3Class;

        return $this;
    }

    public function getRank4Order(): ?string
    {
        return $this->rank4Order;
    }

    public function setRank4Order(?string $rank4Order): self
    {
        $this->rank4Order = $rank4Order;

        return $this;
    }

    public function getRank5Family(): ?string
    {
        return $this->rank5Family;
    }

    public function setRank5Family(?string $rank5Family): self
    {
        $this->rank5Family = $rank5Family;

        return $this;
    }

    public function getRank6Genus(): ?string
    {
        return $this->rank6Genus;
    }

    public function setRank6Genus(?string $rank6Genus): self
    {
        $this->rank6Genus = $rank6Genus;

        return $this;
    }

    public function getFile(): ?SampleFile
    {
        return $this->file;
    }

    public function setFile(?SampleFile $file): self
    {
        $this->file = $file;

        return $this;
    }

    /**
     * @param string|null $rank7Species
     * @return TaxonomyAbundance
     */
    public function setRank7Species(?string $rank7Species): TaxonomyAbundance
    {
        $this->rank7Species = $rank7Species;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getRank7Species(): ?string
    {
        return $this->rank7Species;
    }

    /**
     * @param string|null $rank8Strain
     * @return TaxonomyAbundance
     */
    public function setRank8Strain(?string $rank8Strain): TaxonomyAbundance
    {
        $this->rank8Strain = $rank8Strain;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getRank8Strain(): ?string
    {
        return $this->rank8Strain;
    }


}
