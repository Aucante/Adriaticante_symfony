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
                    ->setPhone('0' . $faker->numberBetween(600000001, 799999999));

            $manager->persist($address);

            //USER
            $user = new User();
            $user->setEmail('user' . $i .'@test.com')
                    ->setUsername($faker->userName())
                    ->setLastname($faker->lastName())
                    ->setFirstname($faker->firstName())
                    ->setCompany($faker->company())
                    ->setAddress($address);

            $password = $this->encoder->encodePassword($user, 'password');
            $user->setPassword($password);

            $manager->persist($user);

        }
        // STATUS

        $status1 = new Status();
        $status1->setName('Available');
        $manager->persist($status1);


        // TYPE

        $type1 = new Type();
        $type1->setName('Flat');
        $manager->persist($type1);



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
                ->setPhone('0' . $faker->numberBetween(600000001, 799999999));

            $manager->persist($addressProperty);

            //USER
            $userProperty = new User();
            $userProperty->setEmail('user1' . $k .'@test.com')
                ->setUsername($faker->userName())
                ->setLastname($faker->lastName())
                ->setFirstname($faker->firstName())
                ->setCompany($faker->company())
                ->setAddress($addressProperty);

            $password = $this->encoder->encodePassword($userProperty, 'password');
            $userProperty->setPassword($password);

            $manager->persist($userProperty);

            // FEATURE

            $feature = new Feature();
            $feature->setFeature1($faker->word());
            $manager->persist($feature);

            // FILE

            $file = new File();
            $file->setFile1('img/img/adriatic1.jpg');
            $file->setFile2('img/img/adriatic2.jpg');
            $file->setFile3('img/img/contact.jpg');
            $manager->persist($file);

            // PROPERTY

            $property = new Property();

            $property->setPrice($faker->numberBetween(40000, 10000000))
                ->setDescription($faker->text(500))
                ->setArea($faker->numberBetween(10, 500))
                ->setTotalRooms($faker->numberBetween(1, 10))
                ->setTotalBedrooms($faker->numberBetween(0, 8))
                ->setTotalBathrooms($faker->numberBetween(1, 4))
                ->setFeatures($feature)
                ->setType($type1)
                ->setStatus($status1)
                ->setAddress($addressProperty)
                ->setFiles($file)
                ->setUser($userProperty)
                ->setName($faker->text(20));

            $manager->persist($property);
        }

        $manager->flush();
    }
}
