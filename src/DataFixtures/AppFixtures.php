<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\User;
use Faker\Generator;
use App\Entity\Product;
use App\Entity\Rubrique;
use App\Entity\BanquePhoto;
use App\Entity\Sousrubrique;
use Doctrine\ORM\Mapping\Id;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasher;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{

    /**
     * @var Generator
     */
    private Generator $faker;

    private UserPasswordHasherInterface $hasher;
    
    public function __construct(UserPasswordHasherInterface $hasher) {
        $this->faker = Factory::create('fr_FR');
        $this->hasher = $hasher;
    }
    
    public function load(ObjectManager $manager): void
    {

        // fixtures for User
        for($i = 0; $i < 10; $i++)
        {
            $user = new User();
            
            $user
                ->setSurname($this->faker->name())
                ->setFirstname($this->faker->name())
                ->setEmail($this->faker->email())

                ->setDeliveryAddress($this->faker->address())
                ->setDeliveryPostCode($this->faker->postcode())
                ->setBillingAddress($this->faker->address())
                ->setBillingPostCode($this->faker->postcode())
                
                ->setRoles(['ROLE_USER'])
                ->setPlainPassword('password');
                
            
            $plainTextPassword = $user->getPlainPassword();

            $hashPassword = $this->hasher->hashPassword(
                $user,
                $plainTextPassword
            );

            
            $user->setPassword($hashPassword);
            $manager->persist($user);
        }

        //Fixtures for Rubrique, SousRubrique, Product et Photo
        for ($i = 1; $i <= 7; $i++) {
            $rubrique = new Rubrique();
            $rubrique
                ->setNomRubrique('Rubrique # '.$i)
                ->setCodeRubrique($this->faker->words(1, true));
    
            $manager->persist($rubrique);
    
            $manager->flush();

            for ($j = 1; $j <= mt_rand(8, 12); $j++) {

                $sousrubrique = new Sousrubrique();
                $sousrubrique
                    ->setNomSousrubrique('Sous-rubrique # '.$i . '-' .$j)
                    ->setCodeSousrubrique($this->faker->words(1, true))
                    ->setRubrique($rubrique);
        
                $manager->persist($sousrubrique);
        
                $manager->flush();

                for ($k = 1; $k <= mt_rand(10, 20); $k++) {
                    $product = new Product();
                    $product
                        ->setName('product # '.$i . '-' .$j. '-' .$k)
                        ->setLabel($this->faker->words(10, true))
                        ->setDescri($this->faker->words(25, true))
                        ->setDateCreate(new \DateTime('now'))
                        ->setPricePt(mt_rand(0,100))
                        ->setSousrubrique($sousrubrique);
            
                    $manager->persist($product);
                    $manager->flush();

                    for ($l = 1; $l <= 2; $l++) {

                        $photo = new BanquePhoto();

                        if ($l == 1) {
                            $photo->setphoto('250x400.jpeg');
                        } else {
                            $photo->setphoto('300x180.png');
                        }
                        $photo->setIdProduct($product);
                        
                        $manager->persist($photo);
                        $manager->flush();
                    }
                }
            }
        }

    }
}
