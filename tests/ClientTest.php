<?php

namespace Nekofar\Virgool;


use Http\Client\HttpClient;
use Nekofar\Virgool\Exception\InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class ClientTest extends TestCase
{
    public function testCreate()
    {
        $username = 'username';
        $password = 'password';

        $client = Client::create($username, $password);

        $this->assertInstanceOf(Client::class, $client);
    }

    public function testSetHttpClient()
    {
        $this->expectException(InvalidArgumentException::class);

        $username = 'username';
        $password = 'password';

        $client = Client::create($username, $password);
        $client->setHttpClient(new \stdClass());
    }

    public function testGetHttpClient()
    {
        $username = 'username';
        $password = 'password';

        $client = Client::create($username, $password);
        $client->setHttpClient(new \Http\Mock\Client());

        $this->assertInstanceOf(HttpClient::class, $client->getHttpClient());
    }
}
