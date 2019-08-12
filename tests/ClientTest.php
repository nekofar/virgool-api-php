<?php

namespace Nekofar\Virgool;


use Dotenv\Dotenv;
use PHPUnit\Framework\TestCase;

class ClientTest extends TestCase
{
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

    protected function setUp(): void
    {
        parent::setUp();

        $dotenv = Dotenv::create(__DIR__ . '/../');
        $dotenv->load();
    }
}
