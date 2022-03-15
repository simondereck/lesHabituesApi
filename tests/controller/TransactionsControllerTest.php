<?php


namespace App\Tests\controller;


use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class TransactionsControllerTest extends WebTestCase
{

    /**
     * php ./vendor/bin/phpunit tests/controller/TransactionsControllerTest.php
     */

    public function testLists():void{
        $client = static::createClient();
        $crawler = $client->request('POST', '/transaction/lists',
            [

            ]);
        $response = $client->getResponse();
        $this->expectOutputString($response);
    }


    public function testDetail():void{
        $client = static::createClient();
        $crawler = $client->request('POST', '/transaction/detail',
            [
              "id"=>5
            ]);
        $response = $client->getResponse();
        $this->expectOutputString($response);
    }
}