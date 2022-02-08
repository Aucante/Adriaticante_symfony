<?php

namespace App\DataFixtures;

use App\Entity\Address;
use App\Entity\Feature;
use App\Entity\File;
use App\Entity\Property;
use App\Entity\Status;
use App\Entity\Type;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{
    private UserPasswordEncoderInterface $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');



        // ADDRESS
        for ($i = 0; $i < 10; $i++)
        {
            $address = new Address();

            $address->setStreetNumber($faker->numberBetween(1, 99))
                    ->setStreetAddressLine1($faker->streetAddress)
                    ->setCity($faker->city())
                    ->setStateZipCode($faker->numberBetween(100, 950) . '00')
                    ->setCountry($faker->country())
                    ->setPhone('0' . $faker->numberBetween(600000001, 799999999))
                    ->setLongitude('0' . $faker->numberBetween(600000001, 799999999))
                    ->setLatitude('0' . $faker->numberBetween(600000001, 799999999));

            $manager->persist($address);

            //USER
            $user = new User();
            $user->setEmail('user' . $i .'@test.com')
                    ->setUsername($faker->userName())
                    ->setLastname($faker->lastName())
                    ->setFirstname($faker->firstName())
                    ->setCompany($faker->company())
                    ->setAddress($address)
                    ->setRoles(['ROLE_USER']);

            $password = $this->encoder->encodePassword($user, 'password');
            $user->setPassword($password);

            $manager->persist($user);

        }

        // PROPERTY + ADDRESS
        for ($k = 0; $k < 10; $k++)
        {
            // ADDRESS
            $addressProperty = new Address();

            $addressProperty->setStreetNumber($faker->numberBetween(1, 99))
                ->setStreetAddressLine1($faker->streetAddress)
                ->setCity($faker->city())
                ->setStateZipCode($faker->numberBetween(100, 950) . '00')
                ->setCountry($faker->country())
                ->setPhone('0' . $faker->numberBetween(600000001, 799999999))
                ->setLongitude('0' . $faker->numberBetween(600000001, 799999999))
                ->setLatitude('0' . $faker->numberBetween(600000001, 799999999));

            $manager->persist($addressProperty);

            //USER
            $userProperty = new User();
            $userProperty->setEmail('user1' . $k .'@test.com')
                ->setUsername($faker->userName())
                ->setLastname($faker->lastName())
                ->setFirstname($faker->firstName())
                ->setCompany($faker->company())
                ->setAddress($addressProperty)
                ->setRoles(['ROLE_USER']);

            $password = $this->encoder->encodePassword($userProperty, 'password');
            $userProperty->setPassword($password);

            $manager->persist($userProperty);

            // FEATURE

            $feature = new Feature();
            $feature->setName($faker->word());
            $manager->persist($feature);


            // PROPERTY

            $property = new Property();

            $property->setPrice($faker->numberBetween(40000, 10000000))
                ->setDescription($faker->text(500))
                ->setArea($faker->numberBetween(10, 500))
                ->setType($faker->word())
                ->setStatus($faker->word())
                ->setTotalRooms($faker->numberBetween(1, 10))
                ->setTotalBedrooms($faker->numberBetween(0, 8))
                ->setTotalBathrooms($faker->numberBetween(1, 4))
                ->setAddress($addressProperty)
                ->setUser($userProperty)
                ->setName($faker->text(20));

                for ($l = 0; $l < 5; $l++)
                {
                    $feature = new Feature();
                    $feature->setName($faker->word());
                    $manager->persist($feature);

                    $property->addFeature($feature);
                }



            $manager->persist($property);

            // FILE

            $file = new File();
            $file->setName($faker->word());
            $file->setProperty($property);
            $manager->persist($file);
        }

        $manager->flush();
    }
}
