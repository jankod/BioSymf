<?php

namespace App\Form;

use App\Entity\SampleFile;
use App\Util\MyConstants;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichFileType;

class SampleFileType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('fileName')
            // ->add('updatedAt')
            ->add('type', ChoiceType::class, [
                'choices' => MyConstants::fileTypes()
            ])
            ->add('sample')
            ->add('sampleFile', VichFileType::class, [
                'required' => false,
                'allow_delete' => false,
                //'download_uri' => '...',
                //'download_label' => '...',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => SampleFile::class,
        ]);
    }
}
