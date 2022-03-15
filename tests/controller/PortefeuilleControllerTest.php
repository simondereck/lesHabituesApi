<?php


namespace App\Tests\controller;


use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class PortefeuilleControllerTest extends WebTestCase
{
    /**
     * php ./vendor/bin/phpunit tests/controller/PortefeuilleControllerTest.php
     */
//
//    public function testCreate():void{
////        if the portefeuille is not exist create one
//
//    }

    public function testDetail():void{
//        /portefeuille/detail
        $client = static::createClient();
        $crawler = $client->request('GET', '/portefeuille/detail',[
            "cid"=>2,
        ]);
        $result = $client->getResponse();
        $this->expectOutputString($result);
    }


    public function testCrediter():void{
        $client = static::createClient();
        $crawler = $client->request('POST', '/portefeuille/crediter',[
            "amount"=>100,
            "cid"=>2,
            "title"=>"crediter pour account 2",
            "description" => "100 for 110"
        ]);
        $result = $client->getResponse();
        $this->expectOutputString($result);
    }

    public function testDebiter():void{
        $client = static::createClient();
        $crawler = $client->request('POST', '/portefeuille/debiter',[
            "amount"=>10,
            "cid"=>2,
            "title"=>"debiter pour account 2",
            "description" => "100 for 110"
        ]);
        $result = $client->getResponse();
        $this->expectOutputString($result);
    }

}