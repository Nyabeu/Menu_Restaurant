<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use App\Entity\Contact;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstName', TextType::class)
            ->add('lastName', TextType::class)
            ->add('email', EmailType::class)
            ->add('phone', TelType::class, [
                'attr' => [ 'maxlength' => '20'],
            ])
            ->add('address', TextType::class)
            ->add('city', TextType::class)
            ->add('country', ChoiceType::class, [
                  'choices' => [
                    'France' => null,
                    'Angleterre' => false,
                    'Usa' => true,
                    'Cameroun' => true,
                    'belgique' => false,
                  ],
                ])
            ->add('postalCode', IntegerType::class)
            ->add('message', TextareaType::class,[
                'attr' => [ 'rows' => '3'],
            ])
            ->add('check', CheckboxType::class,
              [
                  'label'    => 'Show this entry publicly?',
                  'required' => false,
            ])
            ->add('save', SubmitType::class)
        ;

    }
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Contact::class,
        ]);
    }
}
