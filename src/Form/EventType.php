<?php

namespace App\Form;

use App\Entity\Event;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\DateType;



class EventType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('name', TextType::class, [
            'attr' => ['class' => 'input'],
            'label' => "Nom d'événement",
            'row_attr' => ['style' => 'margin-bottom: 10px;'],
            'label_attr' => ['class' => 'label'],
        ])
     
        ->add('date', DateType::class, [
            'attr' => ['class' => 'input'],
            'label' => "Date de l'événement",
            'label_attr' => ['class' => 'label'],
        ])
        ->add('nb_persones', NumberType::class, [
            'attr' => ['class' => 'input'],
            'label' => "Nombre de personnes réservées",
            'label_attr' => ['class' => 'label'],
        ])

    

        ->add('max_nb_persones', NumberType::class, [
            'attr' => ['class' => 'input'],
            'label' => "Nombre maximum de personnes",
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
            'data_class' => Event::class,
        ]);
    }
}
