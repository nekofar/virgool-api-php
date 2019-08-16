<?php

namespace Nekofar\Virgool;


use Dotenv\Dotenv;
use Http\Client\Exception;
use PHPUnit\Framework\TestCase;

class ClientTest extends TestCase
{
    /**
     *
     */
    public function testCreate()
    {
        $username = getenv('VIRGOOL_USERNAME') ?: 'username';
        $password = getenv('VIRGOOL_PASSWORD') ?: 'password';

        $config = Config::create($username, $password);
        $client = Client::create($config);

        $this->assertInstanceOf(Client::class, $client);
    }

    /**
     * @throws Exception
     */
    public function testGetUserInfo()
    {
        $username = getenv('VIRGOOL_USERNAME') ?: 'username';
        $password = getenv('VIRGOOL_PASSWORD') ?: 'password';

        $config = Config::create($username, $password);
        $client = Client::create($config);

        $this->assertArrayHasKey('user', $client->getUser());
    }

    /**
     * @throws Exception
     */
    public function testGetTopics()
    {
        $username = getenv('VIRGOOL_USERNAME') ?: 'username';
        $password = getenv('VIRGOOL_PASSWORD') ?: 'password';

        $config = Config::create($username, $password);
        $client = Client::create($config);

        $this->assertArrayHasKey('topics', $client->getTopics());
    }

    /**
     * @throws Exception
     */
    public function testGetPosts()
    {
        $username = getenv('VIRGOOL_USERNAME') ?: 'username';
        $password = getenv('VIRGOOL_PASSWORD') ?: 'password';

        $config = Config::create($username, $password);
        $client = Client::create($config);

        $this->assertArrayHasKey('data', $client->getPosts());
    }


    /**
     *
     */
    protected function setUp(): void
    {
        parent::setUp();

        $dotenv = Dotenv::create(__DIR__ . '/../');
        $dotenv->load();
    }
}
