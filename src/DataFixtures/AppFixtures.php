<?php

namespace App\DataFixtures;

use App\Entity\Address;
use App\Entity\Asset;
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

        // TEST 1 EXAMPLE

        $address = new Address();

        $address->setStreetNumber(1)
            ->setStreetAddressLine1('rue de Trieste')
            ->setCity('Trieste')
            ->setStateZipCode(01000)
            ->setCountry('Italy')
            ->setPhone(0700000000)
            ->setLongitude(0700000000)
            ->setLatitude(0700000000);

        $manager->persist($address);

        //USER
        $user = new User();
        $user->setEmail('usertest@test.com')
            ->setUsername('testusername')
            ->setLastname('testlastname')
            ->setFirstname('testfirstname')
            ->setCompany('testcompany')
            ->setAddress($address)
            ->setRoles(['ROLE_USER'])
            ->setFile('adriatic.jpg')
            ->setUpdatedAt(new \DateTimeImmutable());

        $password = $this->encoder->encodePassword($user, 'password');
        $user->setPassword($password);

        $manager->persist($user);


        // PROPERTY

        $property = new Property();

        $property->setPrice($faker->numberBetween(40000, 10000000))
            ->setDescription('testproperty')
            ->setArea($faker->numberBetween(10, 500))
            ->setType($faker->word())
            ->setStatus($faker->word())
            ->setTotalRooms($faker->numberBetween(1, 10))
            ->setTotalBedrooms($faker->numberBetween(0, 8))
            ->setTotalBathrooms($faker->numberBetween(1, 4))
            ->setAddress($address)
            ->setUser($user)
            ->setName('testproperty')
            ->setAdvertType($faker->word())
            ->setPhoneContact(0)
            ->setNameContact($faker->word());

        $manager->persist($property);

        for ($k = 0; $k < 3; $k++)
        {
            // asset

            $asset = new Asset();
            $asset->setName('view');
            $manager->persist($asset);
            $property->addasset($asset);

            $manager->persist($asset);
            $manager->persist($property);

        }


        // FILE

        $file = new File();
        $file->setName('adriaticante.png');
        $file->setProperty($property);
        $manager->persist($file);



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
                    ->setRoles(['ROLE_USER'])
                    ->setFile('adriatic.jpg')
                   ->setUpdatedAt(new \DateTimeImmutable());

            $password = $this->encoder->encodePassword($user, 'password');
            $user->setPassword($password);

            $manager->persist($user);


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
                ->setAddress($address)
                ->setUser($user)
                ->setName($faker->text(20))
                ->setAdvertType($faker->word())
                ->setPhoneContact(0)
                ->setNameContact($faker->word());

            $manager->persist($property);

            for ($k = 0; $k < 5; $k++)
            {
                // asset

                $asset = new Asset();
                $asset->setName($faker->word());
                $manager->persist($asset);
                $property->addasset($asset);

                $manager->persist($asset);
                $manager->persist($property);

                // FILE

                $file = new File();
                $file->setName('adriatic.jpg');
                $file->setProperty($property);
                $manager->persist($file);
            }




        }


        $manager->flush();
    }
}
