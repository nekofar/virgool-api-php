<?php

namespace Nekofar\Virgool;


use Http\Client\HttpClient;
use Nekofar\Virgool\Exception\InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class ClientTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $dotenv = \Dotenv\Dotenv::create(__DIR__ . '/../');
        $dotenv->load();
    }

    public function testCreate()
    {
        $username = getenv('VIRGOOL_USERNAME') ?: 'username';
        $password = getenv('VIRGOOL_PASSWORD') ?: 'password';

        $config = Config::create($username, $password);
        $client = Client::create($config);

        $this->assertInstanceOf(Client::class, $client);
    }

    public function testGetUserInfo()
    {
        $username = getenv('VIRGOOL_USERNAME') ?: 'username';
        $password = getenv('VIRGOOL_PASSWORD') ?: 'password';

        $config = Config::create($username, $password);
        $client = Client::create($config);

        var_dump($client->getUserInfo());
    }
}
