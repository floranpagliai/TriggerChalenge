<?php
/**
 * User: floran
 * Date: 14/11/2016
 * Time: 20:42
 */

namespace FrontBundle\Form;

use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AddPostType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('coverPicture', 'FrontBundle\Form\AddPictureType', array(
                'attr' => array('placeholder' => 'post.form.placeholder.cover')
            )
        );
        $builder->add('title', TextType::class, array(
                'attr' => array('placeholder' => 'post.form.placeholder.title')
            )
        );
        $builder->add('challengeSubject', EntityType::class, array(
                'class' => 'BackBundle:ChallengeSubject',
                'choice_label' => 'name',
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('cs')
                        ->andWhere('cs.startSubmissionDate <= :now')
                        ->andWhere('cs.endSubmissionDate >= :now')
                        ->setParameter('now', new \DateTime());
                },
            )
        );
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'BackBundle\Entity\Post',
        ));
    }
}