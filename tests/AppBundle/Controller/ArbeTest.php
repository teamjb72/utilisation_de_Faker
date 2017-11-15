<?php

namespace AppBundle\Entity;
use PHPUnit\Framework\TestCase;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;


class ArbeTest extends WebTestCase
{
    public function testnewAction()
    {


        $client = static::createClient();

        $crawler = $client->request( 'POST', '/arbe/new' );

        $form = $crawler->selectButton( 'Create' )->form( array(
            'appbundle_arbe[denomination]' => 'Ryan', 'appbundle_arbe[poids]' => '111'
        ) );


        // submit that form
        $crawler = $client->submit( $form );


        $this->assertTrue( $client->getResponse()->isRedirect() );


    }
    public function testeditAction()
    {


        $client = static::createClient();

        $crawler = $client->request( 'GET', '/arbe/' );

        $link = $crawler
            ->filter('a:contains("edit")') // find all links with the text "edit"
            ->eq(1) // select the second link in the list
            ->link();

        // and click it
        $crawler = $client->click($link);

        $form = $crawler->selectButton( 'Edit' )->form( array(
            'appbundle_arbe[denomination]' => 'jai modfiie', 'appbundle_arbe[poids]' => '999'
        ) );


        // submit that form
        $crawler = $client->submit( $form );

        $this->assertTrue( $client->getResponse()->isRedirect() );


    }


    public function testdeleteAction()
    {


        $client = static::createClient();

        $crawler = $client->request( 'GET', '/arbe/' );

        $link = $crawler
            ->filter('a:contains("edit")') // find all links with the text "edit"
            ->eq(0) // select the second link in the list
            ->link();

        // and click it
        $crawler = $client->click($link);

        $form = $crawler->selectButton( 'Delete' )->form( array() );


        // submit that form
        $crawler = $client->submit( $form );

        $this->assertTrue( $client->getResponse()->isRedirect() );


    }

    public function testshowAction()
    {


        $client = static::createClient();

        $crawler = $client->request( 'GET', '/arbe/' );

        $link = $crawler
            ->filter('a:contains("show")') // find all links with the text "edit"
            ->eq(0) // select the second link in the list
            ->link()
        ;

        // and click it
        $crawler = $client->click($link);

        $this->assertContains(
            'Denomination',
            $client->getResponse()->getContent()
        );


    }

}

