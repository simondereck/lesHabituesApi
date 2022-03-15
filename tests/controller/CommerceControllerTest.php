<?php


namespace App\Tests\controller;


use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class CommerceControllerTest extends WebTestCase
{

    /**
     * php ./vendor/bin/phpunit tests/controller/CommerceControllerTest.php
     */
    public function testCreate():void{
        $baseUrl = getenv('DATABASE_URL');

        $client = static::createClient();

        $crawler = $client->request('POST', '/commerce/create',[
            "name"=>"carrefour",
        ]);
        $result = $client->getResponse();
        $this->expectOutputString($result);

        $crawler = $client->request('POST', '/commerce/create',[
            "name"=>"ours",
        ]);
        $result = $client->getResponse();
        $this->expectOutputString($result);
        $crawler = $client->request('POST', '/commerce/create',[
            "name"=>"destiny",
        ]);
        $result = $client->getResponse();
        $this->expectOutputString($result);
        $crawler = $client->request('POST', '/commerce/create',[
            "name"=>"maria",
        ]);
        $result = $client->getResponse();
        $this->expectOutputString($result);
    }
}