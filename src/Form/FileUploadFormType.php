<?php

namespace App\Form;


use App\Entity\Project;
use App\Entity\SampleFile;
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
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder("p");
                }
            ]);

        $builder->add('save', SubmitType::class, array(
            'attr' => array('class' => 'btn-primary'),
        ));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => FileUploadModel::class,
        ));
    }


}

