<?php

namespace App\Form;

use App\Entity\User;
use App\Entity\ResetPasswordRequest;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ChangePasswordType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('old_password',PasswordType::class)
            ->add('password',RepeatedType::class,['invalid_message'=>'Password error',
                'type'=>PasswordType::class,'first_options'=>['label'=>'New password',],'second_options'=>['label'=>'Repeat password',]])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
        ]);
    }
}
