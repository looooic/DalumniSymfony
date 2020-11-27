<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email')
            ->add('nom')
            ->add('prenom')
            ->add('photo', FileType::class,[
                'label'=>'Photo de profile',
                'mapped'=>false,
                'required'=>false,
                'constraints'=>[new File([
                    'maxSize'=>'1024k',
                    'mimeTypes'=>[
                        'application/jpg',
                        'application.png',
                        'application.jpeg'
                    ],
                    'mimeTypesMessage'=>'Inserer une photo au format PNG/JPG'])]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
