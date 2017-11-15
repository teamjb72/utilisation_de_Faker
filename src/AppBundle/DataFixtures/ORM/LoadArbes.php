<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Arbe;



use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;


class LoadArbes extends AbstractFixture implements ContainerAwareInterface, FixtureInterface, OrderedFixtureInterface
{
    private $container;

    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    public function load(ObjectManager $em)
    {
        // initialisation de l'objet Faker
        // on peut préciser en paramètre la localisation,
        // pour avoir des données qui semblent "françaises"
        $faker = Faker\Factory::create('fr_FR');


         for ($i=0; $i<100; $i++){
             $arbe = new Arbe();
             $arbe->setDenomination($faker->name());
             $arbe->setPoids($faker->numberBetween(1,1000));

             //voir d'autres exemple de données que l'on peut générer https://philipp-rieber.net/talks/2015-05-11-sfugmunich-Faker-and-Alice.pdf

             $em->persist($arbe);
         }

         $em->flush();
    }

    public function getOrder()
    {
        return 1;
    }
}