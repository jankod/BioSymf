<?php

namespace App\Util;


use App\Entity\SampleFile;

class MyConstants
{


    public static function fileTypes()
    {
        return [
            SampleFile::TAXONOMY_TYPE => SampleFile::TAXONOMY_TYPE,
            SampleFile::TAXONOMY_MERGED_TYPE => SampleFile::TAXONOMY_MERGED_TYPE,
            SampleFile::PATHWAY_TYPE => SampleFile::PATHWAY_TYPE,
            SampleFile::PATHWAY_MERGED_TYPE => SampleFile::PATHWAY_MERGED_TYPE,
        ];
    }

}