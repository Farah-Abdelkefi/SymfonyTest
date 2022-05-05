<?php

namespace App\DataFixtures;

use App\Entity\PFE;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory as factory ;

class PfeFixture extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for (int $i;$i<10;$i++){
        $faker = factory::create();
        $pfe = new PFE();
        $pfe->setTitle($faker->title )  ;
        $pfe->setStudent($faker->name);
        $manager->persist($pfe);}
        $manager->flush();
    }
}
