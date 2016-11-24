<?php
/**
 * User: floran
 * Date: 23/11/2016
 * Time: 18:57
 */

namespace BackBundle\Form;

use BackBundle\DBAL\ChallengeFrequencyType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ChallengeForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('name', TextType::class, array(
                'attr' => array('placeholder' => 'challenge.form.placeholder.name')
            )
        );
        $builder->add('frequency', ChoiceType::class, array(
                'choices' => array(
                    'daily' => ChallengeFrequencyType::DAILY,
                    'monthly' => ChallengeFrequencyType::MONTHLY,
                    'weekly' => ChallengeFrequencyType::WEEKLY
                )
            )
        );
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'BackBundle\Entity\Challenge',
        ));
    }
}