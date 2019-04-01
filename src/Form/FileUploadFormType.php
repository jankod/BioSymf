<?php

namespace App\Form;


use App\Entity\Project;
use App\Entity\ProjectMember;
use App\Entity\SampleFile;
use App\Entity\User;
use App\Repository\ProjectMemberRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\AbstractType;

class FileUploadFormType extends AbstractType
{

    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('files', FileType::class, array(
                'label' => 'Mupltiple files (same type)',
                // 'attr' => ['placeholder' => 'PLACEHOLDER'],
                'multiple' => true,
                //'mapped' => false
            ))
            ->add('type', ChoiceType::class, [
                'label' => 'File type: ',
                'choices' => [
                    SampleFile::TAXONOMY_TYPE => SampleFile::TAXONOMY_TYPE,
                    SampleFile::TAXONOMY_MERGED_TYPE => SampleFile::TAXONOMY_MERGED_TYPE,
                    SampleFile::PATHWAY_TYPE => SampleFile::PATHWAY_TYPE,
                    SampleFile::PATHWAY_MERGED_TYPE => SampleFile::PATHWAY_MERGED_TYPE,
                ]
            ])
            ->add('project', EntityType::class, [
                'label' => 'Project',
                'class' => Project::class,
//                'query_builder' => function (EntityRepository  $entityRepo) use ($options) {
//                    $repository =  $this->entityManager->getRepository(ProjectMember::class);
//                    //return $repository->findProjectsOfUser($options['user']);
//                    return $entityRepo->createNamedQuery("")
//                }
                'choices' => $this->entityManager->getRepository(ProjectMember::class)->findProjectsOfUser($options['user'])
            ]);

        $builder->add('save', SubmitType::class, array(
            'attr' => array('class' => 'btn-primary'),
        ));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setRequired('user');
        $resolver->setDefaults(array(
            'data_class' => FileUploadModel::class,
        ));
    }


}

