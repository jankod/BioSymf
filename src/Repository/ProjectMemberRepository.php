<?php

namespace App\Repository;


use App\Entity\Project;
use App\Entity\ProjectMember;
use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

class ProjectMemberRepository extends ServiceEntityRepository
{

    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, ProjectMember::class);
    }

    public function findProjectsOfUser(User $user)
    {

        //SELECT pm, p FROM App\Entity\ProjectMember pm LEFT JOIN pm.project p where pm.user = :user
        // SELECT p FROM App\Entity\Project p where p.id in ( select  pro.id from App\Entity\ProjectMember pm LEFT JOIN pm.project pro where pm.user = :user)
        $dql = <<<DQL
        SELECT p FROM App\Entity\Project p where p.id in ( select  pro.id from App\Entity\ProjectMember pm LEFT JOIN pm.project pro where pm.user = :user)
DQL;


        $projects = [];
        $result = $this->getEntityManager()->createQuery($dql)
            ->setParameter('user', $user)
            ->getResult();

        /** @var ProjectMember $pm */
//        foreach ($result as $pm) {
//            $result[] = $pm->getProject();
//        }
        dump($result);
        return $result;
    }

    /**
     * @param Project $project
     * @param User $user
     * @return bool
     */
    public function isUserProjectAdmin(Project $project, User $user)
    {
        $dql = <<<DQL
SELECT pm from App\Entity\ProjectMember pm where pm.user = :user and pm.project = :project and pm.role = :role
DQL;

        $result = $this->getEntityManager()->createQuery($dql)
            ->setParameter('user', $user)
            ->setParameter('project', $project)
            ->setParameter('role', 'ADMIN')
            ->execute();

        if ($result == null) {
            return false;
        }
        return true;
    }

    /**
     * @param int $userId
     * @param int $projectId
     * @return ProjectMember|null
     */
    public function getProjectMember(int $userId, int $projectId)
    {
        $dql = <<<DQL
SELECT pm from App\Entity\ProjectMember pm where pm.user.id = :uid and pm.project.id = :pid
DQL;
        $result = $this->getEntityManager()->createQuery($dql)
            ->setParameter('uid', $userId)
            ->setParameter('pid', $projectId)
            ->execute();
        return $result;
    }

}