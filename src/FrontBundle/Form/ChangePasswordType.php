<?php

namespace FrontBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ChangePasswordType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('oldPassword', PasswordType::class, array(
                'label' => 'user.form.label.old_password'
            )
        );
        $builder->add('newPassword', RepeatedType::class, array(
                'type'           => PasswordType::class,
                'first_options'  => array('label' => 'user.form.label.new_password'),
                'second_options' => array('label' => 'user.form.label.new_password_repeat'),
            )
        );
    }

    public function configureOptions(OptionsResolver $resolver)
    {

    }

    public function getName()
    {
        return 'front_bundle_change_password_type';
    }
}
