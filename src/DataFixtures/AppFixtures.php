<?php

namespace App\DataFixtures;

use App\Entity\Chambres;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);

        $chambre = new Chambres();

        $chambre->setTitre('deux chambres');
        $chambre->setDescription('vue panoramique');
        $chambre->setPhoto('chambre.jpg');
        $chambre->setPrixJournalier('120');

        $manager->persist($chambre);
        $manager->flush();
    }
}
