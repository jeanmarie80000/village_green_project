<?php

namespace App\DataFixtures;

use App\Entity\Product;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{

    public function load(ObjectManager $manager): void
    {

        function generateText($lenght = 25) {
            $chara = '0123456789abcdefghijklmopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $charaLenght = strlen($chara);
            $randomString = '';
            for ($i=0; $i < $lenght; $i++) { 
                $randomString = $chara[random_int(0, $charaLenght - 1 )];
            }
            return $randomString;
        }

        for ($i=1; $i <= 50; $i++) {

            $product = new Product();
            $product->setId($i)
                ->setName('product # '.$i)
                ->setLabel(generateText())
                ->setDescri(generateText())
                ->setDateCreate(new \DateTime('06/06/2010'))
                ->setPricePt(mt_rand(0,100));
    
    
            $manager->persist($product);
    
            $manager->flush();
        }
    }
}
