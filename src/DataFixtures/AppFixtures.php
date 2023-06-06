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
            $user->setEmail($this->faker->email())
                ->setRoles(['ROLE_USER'])
                ->setPlainPasssword('password');

            $hashPassword = $this->hasher->hashPassword(
                $user,
                '123'
            );

            $user->setPassword($hashPassword);
    
            $manager->persist($user);
        }

        function generateText($lenght = 25) {
            $chara = '0123456789abcdefghijklmopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $charaLenght = strlen($chara);
            $randomString = '';
            for ($i = 0; $i < $lenght; $i++) { 
                $randomString = $chara[random_int(0, $charaLenght - 1)];
            }
            return $randomString;
        }

        //Fixtures for Rubrique, SousRubrique, Product et Photo
        for ($i = 1; $i <= 7; $i++) {
            $rubrique = new Rubrique();
            $rubrique->setNomRubrique('Rubrique # '.$i)
                ->setCodeRubrique(generateText());
    
            $manager->persist($rubrique);
    
            $manager->flush();

            for ($j = 1; $j <= mt_rand(8, 12); $j++) {

                $sousrubrique = new Sousrubrique();
                $sousrubrique->setNomSousrubrique('Sous-rubrique # '.$i . '-' .$j)
                    ->setCodeSousrubrique(generateText())
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
                            $photo->setphoto('product/250x400.jpeg');
                        } else {
                            $photo->setphoto('product/400x500.jpeg');
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
