<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ProjectMember
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class ProjectMember
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
     * @ORM\Column(name="role", type="string", length=255, nullable=true)
     */
    private $role;

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
     * @var User
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumns({
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     *})
     */
    private $user;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRole(): ?string
    {
        return $this->role;
    }

    public function setRole(?string $role): self
    {
        $this->role = $role;

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
     * @param User $user
     * @return ProjectMember
     */
    public function setUser(?User $user): ProjectMember
    {
        $this->user = $user;
        return $this;
    }

    /**
     * @return User
     */
    public function getUser(): ?User
    {
        return $this->user;
    }


}
