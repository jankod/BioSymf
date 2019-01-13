<?php

namespace App\Util;

use App\Entity\TaxonomyAbundance;
use Doctrine\Common\Collections\ArrayCollection;
use function Sodium\add;
use function Stringy\create;
use Stringy\Stringy as S;


class FileParser
{


    /**
     * @var string
     */
    private $path;
    private $lines;
    private $fileName;

    public function __construct(string $path, string $fileName)
    {
        $this->path = $path;
        //  dump("REad", $path);
        $this->lines = str_getcsv(file_get_contents($this->path), "\n");
        $this->fileName = $fileName;
    }

    /**
     * @return bool
     */
    public function isTaxonomyType()
    {
        // Mora imati 1 ili vise non-commented redova kojima prvo polje (nakon \t splita) pocinje sa “k__” i to isto polje nema u sebi “PWY:” substring
        // Sve linije moraju imati dva polja nakon \t splitana, osim komentara
        // Commented redovi pocinju sa # - ti se ne parsaju

        $lines = $this->lines;
        $hasOneKandNonePWY = false;

        $hasMoreThanTwoSplitedFiled = false;

        foreach ($lines as $l) {
            $line = S::create($l)->trim();
            if ($line->startsWith("#")) {
                continue;
            }
            if ($line->countSubstr("\t") != 1) {
                $hasMoreThanTwoSplitedFiled = true;
            }


            if ($line->startsWith("k__")) {
                if (!$line->contains("PWY", false)) {
                    $hasOneKandNonePWY = true;
                    continue;
                }
            }
        }

        if ($hasOneKandNonePWY and !$hasMoreThanTwoSplitedFiled) {
            return true;
        }
        return false;


    }

    /**
     * @return TaxonomyAbundance[]
     */
    public function parseTaxonomy()
    {
        $taxonomyAbundanceArray = [];
        $lines = $this->lines; // str_getcsv(file_get_contents($this->path), "\n");
        // array_shift($lines);

        foreach ($lines as $l) {
            if (S::create($l)->startsWith("#")) {
                continue;
            }
            list($taxas, $ab) = explode("\t", $l);
            $taxonomyArray = explode("|", $taxas);
            //echo $ab . "  ";
            $taxonomy = new TaxonomyAbundance();
            $taxonomy->setAbundance($ab);
            $taxonomyAbundanceArray[] = $taxonomy;

            foreach ($taxonomyArray as $tax) {
                $stax = S::create($tax);
                $rank = $stax->substr(3);

                if ($stax->startsWith('k__')) {
                    $taxonomy->setRank1Kingdom($rank);
                }
                if ($stax->startsWith('p__')) {
                    $taxonomy->setRank2Phylum($rank);
                }
                if ($stax->startsWith('c__')) {
                    $taxonomy->setRank3Class($rank);
                }
                if ($stax->startsWith('o__')) {
                    $taxonomy->setRank4Order($rank);
                }
                if ($stax->startsWith('f__')) {
                    $taxonomy->setRank5Family($rank);
                }
                if ($stax->startsWith('g__')) {
                    $taxonomy->setRank6Genus($rank);
                }
                if ($stax->startsWith('s__')) {
                    $taxonomy->setRank7Species($rank);
                }
                if ($stax->startsWith('t__')) {
                    $taxonomy->setRank8Strain($rank);
                }
            }
        }

        return $taxonomyAbundanceArray;
    }

    public function getTaxonomySampleName()
    {
        $firstLine = $this->lines[0];
        list($s, $sampleName) = explode("\t", $firstLine);
        return $sampleName;
    }

}