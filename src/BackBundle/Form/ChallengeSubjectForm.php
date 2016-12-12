<?php
/**
 * User: floran
 * Date: 24/11/2016
 * Time: 17:38
 */

namespace BackBundle\Form;

use BackBundle\DBAL\ChallengeSubjectType;
use FrontBundle\Form\AddPictureType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\CallbackTransformer;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ChallengeSubjectForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $datetimeTransformer = new CallbackTransformer(
            function ($date) {
                if ($date instanceof \DateTime) {
                    return $date->format('Y-m-d H:i:s');
                }

                return (new \DateTime())->setTime(0, 0, 0)->format('Y-m-d H:i:s');
            },
            function ($dateString) {
                return new \DateTime($dateString);
            }
        );
        $builder->add('name', TextType::class, array(
                'attr' => array('placeholder' => 'challenge_subject.form.placeholder.name')
            )
        );
        $builder->add('coverPicture', AddPictureType::class);
        $builder->add('type', ChoiceType::class, array(
                'choices' => array(
                    'portrait'     => ChallengeSubjectType::PORTRAIT,
                    'landscape'    => ChallengeSubjectType::LANDSCAPE,
                    'artistic'     => ChallengeSubjectType::ARTISTIC,
                    'nature'       => ChallengeSubjectType::NATURE,
                    'architecture' => ChallengeSubjectType::ARCHITECTURE,
                    'street'       => ChallengeSubjectType::STREET
                )
            )
        );
        $builder->add('description', TextType::class, array(
                'attr' => array('placeholder' => 'challenge_subject.form.placeholder.description')
            )
        );
        $builder->add('subject', TextareaType::class, array(
                'attr' => array(
                    'placeholder' => 'challenge_subject.form.placeholder.subject',
                    'rows'         => '10'
                )
            )
        );
        $builder->add('startSubmissionDate', TextType::class);
        $builder->add('endSubmissionDate', TextType::class, array());
        $builder->get('startSubmissionDate')->addModelTransformer($datetimeTransformer);
        $builder->get('endSubmissionDate')->addModelTransformer($datetimeTransformer);

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'BackBundle\Entity\ChallengeSubject',
        ));
    }
}