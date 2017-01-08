<?php
/**
 * User: floran
 * Date: 20/11/2016
 * Time: 18:20
 */

namespace BackBundle\DataFixtures\ORM;

use BackBundle\Entity\User;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class LoadUserData implements FixtureInterface, ContainerAwareInterface
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
        $userManager = $this->container->get('manager.user');

        $email = 'floran.pagliai@gmail.com';
        $user = $userManager->loadOneBy(array('email' => $email));
        if (!$user) {
            $user = new User();
            $password = $this->container->get('security.password_encoder')->encodePassword($user, 'password');
            $user->setPassword($password);
        }
        $user->setEmail($email);
        $user->setFirstName('Floran');
        $user->setLastName('Pagliai');
        $user->setRoles('ROLE_ADMIN');

        $userManager->save($user);
    }
}