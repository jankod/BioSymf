<?php

namespace App\Form;

use App\Entity\Project;

class FileUploadModel
{


    private $files;

    /**
     * @var Project
     */
    private $project;

    /**
     * @var $type string
     */
    private $type;

    /**
     * @Assert\NotBlank()
     * @return mixed
     */
    public function getFiles()
    {
        return $this->files;
    }

    /**
     * @param mixed $files
     */
    public function setFiles($files): void
    {
        $this->files = $files;
    }

    /**
     * @return Project
     */
    public function getProject(): ?Project
    {
        return $this->project;
    }

    /**
     * @param Project $project
     */
    public function setProject(?Project $project): void
    {
        $this->project = $project;
    }

    /**
     * @param string $type
     * @return FileUploadModel
     */
    public function setType(?string $type): FileUploadModel
    {
        $this->type = $type;
        return $this;
    }

    /**
     * @return string
     */
    public function getType(): ?string
    {
        return $this->type;
    }
}