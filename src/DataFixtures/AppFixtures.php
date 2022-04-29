<?php

namespace App\DataFixtures;

use App\Entity\Address;
use App\Entity\Asset;
use App\Entity\City;
use App\Entity\Country;
use App\Entity\Feature;
use App\Entity\Image;
use App\Entity\Message;
use App\Entity\Property;
use App\Entity\Thread;
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
            ->setStateZipCode('01000')
            ->setCountry('Italy')
            ->setDialCode('+33')
            ->setPhone('700000000');

        $manager->persist($address);

        // ADMIN

        $admin = new User();
        $admin->setEmail('admin@admin.com')
            ->setUsername('admin')
            ->setLastname('admin')
            ->setFirstname('admin')
            ->setCompany('admin')
            ->setAddress($address)
            ->setRoles(['ROLE_ADMIN'])
            ->setUpdatedAt(new \DateTimeImmutable())
            ->setProfessional(false);

        $password = $this->encoder->encodePassword($admin, 'password');
        $admin->setPassword($password);

        $manager->persist($admin);

        // USER
        $user1 = new User();
        $user1->setEmail('usertest@test.com')
            ->setUsername('testusername')
            ->setLastname('testlastname')
            ->setFirstname('testfirstname')
            ->setCompany('testcompany')
            ->setAddress($address)
            ->setRoles(['ROLE_USER'])
            ->setFile('adriaticXS.jpg')
            ->setUpdatedAt(new \DateTimeImmutable())
            ->setProfessional(true);

        $password = $this->encoder->encodePassword($user1, 'password');
        $user1->setPassword($password);

        $manager->persist($user1);

        // USER
        $user2 = new User();
        $user2->setEmail('usertest2@test.com')
            ->setUsername('testusername2')
            ->setLastname('testlastname2')
            ->setFirstname('testfirstname2')
            ->setCompany('testcompany2')
            ->setAddress($address)
            ->setRoles(['ROLE_USER'])
            ->setFile('adriaticXS.jpg')
            ->setUpdatedAt(new \DateTimeImmutable())
            ->setProfessional(true);

        $password = $this->encoder->encodePassword($user2, 'password');
        $user2->setPassword($password);

        $manager->persist($user2);
        // CITY

        $city1 = new City();

        $city1->setName('Trieste')
            ->setLatitude(42.430000)
            ->setLongitude(18.700000);

        $city2 = new City();

        $city2->setName('Ljubljana')
            ->setLatitude(46.056946)
            ->setLongitude(14.505751);

        $city3 = new City();

        $city3->setName('Dubrovnik')
            ->setLatitude(46.056947)
            ->setLongitude(14.505752);

        // COUNTRY

        $country1 = new Country();

        $country1->setName('Italy')
                ->addCity($city1)
                ->setFile('triesteM.jpg');

        $country2 = new Country();

        $country2->setName('Slovenia')
            ->addCity($city2)
            ->setFile('ljubljana1.jpg');

        $country3 = new Country();

        $country3->setName('Croatia')
            ->addCity($city3)
            ->setFile('dubrovnik1.jpg');

        $manager->persist($country1);
        $manager->persist($country2);
        $manager->persist($country3);

        // COUNTRY

        $country4 = new Country();

        $country4->setName('Montenegro')
            ->setFile('kotor1.jpg');

        $manager->persist($country4);

        // PROPERTY

        $property1 = new Property();

        $property1->setPrice($faker->numberBetween(40000, 10000000))
            ->setDescription('testproperty1')
            ->setArea(50)
            ->setType('flat')
            ->setTotalRooms(4)
            ->setTotalBedrooms(2)
            ->setTotalBathrooms(1)
            ->setUser($user1)
            ->setName('testproperty1')
            ->setAdvertType('Purchase')
            ->setType('Apartment')
            ->setDialCode('+33')
            ->setPhoneContact('0700000000')
            ->setNameContact('Nom')
            ->setLinkWebsite('www.test.com')
            ->setSlug('test-property1')
            ->setCreatedAt(new \DateTimeImmutable())
            ->setCity($city1);

        $manager->persist($property1);

        // PROPERTY

        $property2 = new Property();

        $property2->setPrice(200000)
            ->setDescription('testproperty2')
            ->setArea(100)
            ->setType('villa')
            ->setTotalRooms(4)
            ->setTotalBedrooms(2)
            ->setTotalBathrooms(1)
            ->setUser($user1)
            ->setName('testproperty2')
            ->setAdvertType('Purchase')
            ->setType('Villa')
            ->setDialCode('+33')
            ->setPhoneContact('0600000000')
            ->setNameContact('Nom')
            ->setLinkWebsite('www.test.com')
            ->setSlug('test-property2')
            ->setCreatedAt(new \DateTimeImmutable())
            ->setCity($city2);

        $manager->persist($property2);

        // FEATURE

        $feature = new feature();
        $feature->setName('balcony');
        $manager->persist($feature);
        $property1->addfeature($feature);
        $property2->addfeature($feature);

        $manager->persist($feature);
        $manager->persist($property1);
        $manager->persist($property2);

        // THREAD

        $thread1 = new Thread();
        $thread1->setTitle('contact1')
                ->setSender($user1)
                ->setProperty($property2);

        $manager->persist($thread1);

        // MESSAGE

        $message1 = new Message();
        $message1->setSender($user1)
                ->setRecipient($user2)
                ->setMessage('message1')
                ->setThread($thread1);

        $manager->persist($message1);

        $message2 = new Message();
        $message2->setSender($user2)
                ->setRecipient($user1)
                ->setMessage('message2')
                ->setThread($thread1);

        $manager->persist($message2);

        // FILE

        $file1 = new Image();
        $file1->setName('adriaticante.png');
        $file1->setProperty($property1);
        $manager->persist($file1);

        // FILE

        $file2 = new Image();
        $file2->setName('adriaticante.png');
        $file2->setProperty($property2);
        $manager->persist($file2);

        // ADDRESS
        for ($i = 0; $i < 10; ++$i) {
            $address = new Address();

            $address->setStreetNumber($faker->numberBetween(1, 99))
                    ->setStreetAddressLine1($faker->streetAddress)
                    ->setCity($faker->city())
                    ->setStateZipCode('01000')
                    ->setCountry($faker->country())
                    ->setDialCode('+3'.$i)
                    ->setPhone('752323641');

            $manager->persist($address);

            // USER
            $user = new User();
            $user->setEmail('user'.$i.'@test.com')
                    ->setUsername($faker->userName())
                    ->setLastname($faker->lastName())
                    ->setFirstname($faker->firstName())
                    ->setCompany($faker->company())
                    ->setAddress($address)
                    ->setRoles(['ROLE_USER'])
                    ->setUpdatedAt(new \DateTimeImmutable())
                    ->setProfessional(false);

            $password = $this->encoder->encodePassword($user, 'password');
            $user->setPassword($password);

            $manager->persist($user);

            // CITY

            $city = new City();

            $city->setName($faker->city())
                ->setLatitude($faker->latitude())
                ->setLongitude($faker->longitude());

            $country4->addCity($city);

            // PROPERTY

            $property = new Property();

            $property->setPrice($faker->numberBetween(40000, 10000000))
                ->setDescription($faker->text(500))
                ->setArea($faker->numberBetween(10, 500))
                ->setType($faker->word())
                ->setTotalRooms($faker->numberBetween(1, 10))
                ->setTotalBedrooms($faker->numberBetween(0, 8))
                ->setTotalBathrooms($faker->numberBetween(1, 4))
                ->setUser($user)
                ->setName($faker->text(20))
                ->setAdvertType('Rental')
                ->setType('Penthouse')
                ->setDialCode('+3'.$i)
                ->setPhoneContact('87412589')
                ->setNameContact($faker->word())
                ->setLinkWebsite('www.test.com')
                ->setSlug($faker->word().'-'.$faker->word().'-'.$faker->word())
                ->setCreatedAt(new \DateTimeImmutable())
                ->setCity($city);

            $manager->persist($property);

            for ($k = 0; $k < 5; ++$k) {
                // asset

                $feature = new feature();
                $feature->setName($faker->word());
                $manager->persist($feature);
                $property->addfeature($feature);

                $manager->persist($feature);
                $manager->persist($property);

                // FILE

                $file = new Image();
                $file->setName('adriatic.jpg');
                $file->setProperty($property);
                $manager->persist($file);
            }

            // THREAD

            $thread = new Thread();
            $thread->setTitle($faker->word())
                ->setSender($user)
                ->setProperty($property1);

            $manager->persist($thread);

            // MESSAGE

            $message = new Message();
            $message->setSender($user)
                ->setRecipient($property1->getUser())
                ->setMessage($faker->realText)
                ->setThread($thread);

            $manager->persist($message);
        }

        $manager->flush();
    }
}
