<?php
/**
 * Created by PhpStorm.
 * User: floranpagliai
 * Date: 08/02/2017
 * Time: 16:21
 */

namespace BackBundle\DataFixtures\ORM;

use BackBundle\DBAL\ChallengeFrequencyType;
use BackBundle\Entity\Challenge;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class LoadChallengeData extends AbstractFixture implements FixtureInterface, ContainerAwareInterface
{
    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * Sets the container.
     *
     * @param ContainerInterface|null $container A ContainerInterface instance or null
     */
    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $challenge = new Challenge();
        $challenge->setName('Challenge de test mensuel');
        $challenge->setFrequency(ChallengeFrequencyType::MONTHLY);
        $challenge->setFeatured(true);

        $manager->persist($challenge);
        $this->setReference('challenge-monthly', $challenge);

        $manager->flush();
    }

    /**
     * Get the order of this fixture
     *
     * @return integer
     */
    public function getOrder()
    {
        return 2;
    }

    /**
     * Returns the environments the fixtures may be loaded in.
     *
     * @return array The name of the environments.
     */
    protected function getEnvironments()
    {
        return array('dev', 'test', 'preprod');
    }
}