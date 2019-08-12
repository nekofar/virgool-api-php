<?php

namespace Nekofar\Virgool;

use Dotenv\Dotenv;
use Http\Client\HttpClient;
use JsonMapper;
use PHPUnit\Framework\TestCase;

class ConfigTest extends TestCase
{
    public function testCreateJsonMapper()
    {
        $username = getenv('VIRGOOL_USERNAME') ?: 'username';
        $password = getenv('VIRGOOL_PASSWORD') ?: 'password';

        $config = Config::create($username, $password);

        $this->assertInstanceOf(HttpClient::class, $config->createHttpClient());
    }

    public function testCreateHttpClient()
    {
        $username = getenv('VIRGOOL_USERNAME') ?: 'username';
        $password = getenv('VIRGOOL_PASSWORD') ?: 'password';

        $config = Config::create($username, $password);

        $this->assertInstanceOf(JsonMapper::class, $config->createJsonMapper());
    }

    protected function setUp(): void
    {
        parent::setUp();

        $dotenv = Dotenv::create(__DIR__ . '/../');
        $dotenv->load();
    }
}
