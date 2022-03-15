<?php


namespace App\Tests\controller;


use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class UserControllerTest extends WebTestCase
{

    /**
     * php ./vendor/bin/phpunit tests/controller/UserControllerTest.php
     */
    public function testCreateUser():void
    {
        $baseUrl = getenv('DATABASE_URL');

        $client = static::createClient();
        $crawler = $client->request('POST', '/user/singup',["username"=>"simon",
            "password"=>"123456",
            "email"=>"z513881204@gmail.com",
            "telephone"=>"656759257"]);
        $response = $client->getResponse();
        $this->expectOutputString($response);
    }


    public function testSingupWithOutParams():void{
        $baseUrl = getenv('DATABASE_URL');

        $client = static::createClient();
        $crawler = $client->request('POST', '/user/singup',["username"=>"simon",
            "password"=>"123456",
            "telephone"=>"656759257"]);
        $response = $client->getResponse();
        $this->expectOutputString($response);
    }


    public function testLogin():void{
        $client = static::createClient();
        $crawler = $client->request('POST', '/user/login',
            [
                "username"=>"z513881204@gmail.com",
                "password"=>"123456"
            ]);
        $response = $client->getResponse();
        $this->expectOutputString($response);

    }


}