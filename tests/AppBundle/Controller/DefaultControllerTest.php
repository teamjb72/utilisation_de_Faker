<?php

namespace Tests\AppBundle\Controller;

use PHPUnit\Framework\TestCase;
use AppBundle\Entity\Arbe;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use AppBundle\Controller\ArbeController;



class ArbeControllerTest extends WebTestCase
{




    public function testCompleteScenario()
    {

        $arbe = New Arbe();
        $arbe->setDenomination("Platane");
        $nom=$arbe->getDenomination();

        $this->assertEquals ($nom,"Platane");


        $arbe->setPoids("400");
        $poids=$arbe->getPoids();

        $this->assertEquals($poids, "400");

        $id=$arbe->getId();

        $this->assertNull($id);



    }

    public function testArbreController(){

        $client = self::createClient();

        $crawler = $client->request('GET', '/arbe/');

        $this->assertGreaterThan(
            0,
            $crawler->filter('html:contains("show")')->count()
        );


    }



    /**
     * @dataProvider urlProvider
     */
    public function testPageIsSuccessful($url)
    {
        $client = self::createClient();
        $client->request('GET', $url);

        $this->assertTrue($client->getResponse()->isSuccessful());
    }

    public function urlProvider()
    {
        return array(
            array('/'),
            array('/arbe/'),
            array('/arbe/new'),
          //  array('/arbe/0/edit'),
           // array('/arbe/0'),

        );
    }


}
