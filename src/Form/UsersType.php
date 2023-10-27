<?php

namespace App\Form;

use App\Entity\Users;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;














class UsersType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('firstname', TextType::class, [
                'attr' => ['class' => 'input'],
                'label' => "Prénom",
                'label_attr' => ['class' => 'label'],

    
             ] )
            ->add('lastname',TextType::class, [
                'attr' => ['class' => 'input'],
                'label' => "Nom",
                'label_attr' => ['class' => 'label'],

    
             ])
            ->add('email',EmailType::class, [
                'attr' => ['class' => 'input'],
                'label' => "Email",
                'label_attr' => ['class' => 'label'],

                
    
             ])





            ->add('password',PasswordType::class, [
                'attr' => ['class' => 'input'],
                'label' => "Password",
                'label_attr' => ['class' => 'label'],

    
            ])
            ->add('submit', SubmitType::class, [
                'attr' => ['class' => 'button'],
                'label' => "Comfirmer",
            ]);


            
            
       
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Users::class,
        ]);
    }
}
