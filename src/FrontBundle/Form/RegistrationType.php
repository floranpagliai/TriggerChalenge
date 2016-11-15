<?php
/**
 * User: floran
 * Date: 24/10/2016
 * Time: 17:58
 */

namespace FrontBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RegistrationType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('email', EmailType::class, array(
                'attr' => array('placeholder' => 'user.form.placeholder.email')
            )
        );
        $builder->add('firstName', TextType::class, array(
                'attr' => array('placeholder' => 'user.form.placeholder.first_name')
            )
        );
        $builder->add('lastName', TextType::class, array(
                'attr' => array('placeholder' => 'user.form.placeholder.last_name')
            )
        );
        $builder->add('password', RepeatedType::class, array(
                'type'           => PasswordType::class,
                'first_options'  => array('attr' => array('placeholder' => 'user.form.placeholder.password')),
                'second_options' => array('attr' => array('placeholder' => 'user.form.placeholder.password_repeat')),
            )
        );
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'BackBundle\Entity\User',
        ));
    }
}