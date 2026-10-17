<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', null, ['label' => 'form.email'])
            ->add('roles', ChoiceType::class, [
                'choices' => [
                    'Użytkownik' => 'ROLE_USER',
                    'Administrator' => 'ROLE_ADMIN'
                ],
            'multiple' => true,
            'expanded' => true,
            'label' => 'form.role'
            ])
            ->add('firstName', null, ['label' => 'form.firstName'])
            ->add('lastName', null, ['label' => 'form.lastName'])
        ;

        if ($options['is_new']) {
            $builder->add('plainPassword', TextType::class, [
                'label' => 'form.password',
                'mapped' =>false
            ]);
        }
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
            'is_new' =>false,
        ]);
    }
}
