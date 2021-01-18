<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFisxture extends Fixture
{
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {
        $user1 = new User();
        $user1 ->setUsername("martin");
        $user1 ->setEmail("martin@sfr.fr");
        $password1 = $this->encoder->encodePassword($user1, 'spyro1the1dragon');
        $user1 ->setPassword($password1);
        $user1 ->setRoles((array)'admin');
        $manager->persist($user1);
        $manager->flush();

        $user2 = new User();
        $user2 ->setUsername("carangue");
        $user2 ->setEmail("carangue@sfr.fr");
        $password2 = $this->encoder->encodePassword($user2,'caligula');
        $user2 ->setPassword($password2);
        $user2 ->setRoles((array)'redac');
        $manager->persist($user2);
        $manager->flush();

        $user3 = new User();
        $user3 ->setUsername("cata");
        $user3 ->setEmail("cata@sfr.fr");
        $password3 = $this->encoder->encodePassword($user3,'catastrophe');
        $user3 ->setPassword($password3);
        $user3 ->setRoles((array)'user');
        $manager->persist($user3);
        $manager->flush();

        $user4 = new User();
        $user4 ->setUsername("calash");
        $user4 ->setEmail("calash@sfr.fr");
        $password4 = $this->encoder->encodePassword($user4,'nikov');
        $user4 ->setPassword($password4);
        $user4 ->setRoles((array)'user');
        $manager->persist($user4);
        $manager->flush();

        $manager->flush();
    }
}
