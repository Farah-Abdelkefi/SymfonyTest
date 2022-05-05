<?php

namespace App\DataFixtures;

use App\Entity\PFE;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory as factory ;
use phpDocumentor\Reflection\Types\Integer;

class PfeFixture extends Fixture
{
    public function load(ObjectManager $manager, ): void
    {
        $faker = factory::create();
        for ( $i =0;$i<10;$i++){

        $pfe = new PFE();
        $pfe->setTitle($faker->title )  ;
        $pfe->setStudent($faker->name);
        $manager->persist($pfe);}
        $manager->flush();
    }
}
