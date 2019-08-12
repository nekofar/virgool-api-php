<?php
/**
 * @package Nekofar\Virgool
 *
 * @author Milad Nekofar <milad@nekofar.com>
 */

namespace Nekofar\Virgool;

use Http\Client\Common\HttpMethodsClient;
use Http\Client\Common\Plugin\AuthenticationPlugin;
use Http\Message\Authentication;
use JsonMapper;
use Nekofar\Virgool\Authentication\BasicAuth;
use Nekofar\Virgool\HttpClient\HttpMethodsClientFactory;

/**
 * Class Config
 */
class Config
{
    /**
     * @const string
     */
    const CLIENT_NAME = 'Nekofar Virgool';

    /**
     * @const string
     */
    const CLIENT_VERSION = '0.1.0';

    /**
     * @const string
     */
    const CLIENT_BASE_URL = 'https://virgool.io/api/v1.2/';

    /**
     * @var Authentication
     */
    private $authentication;

    /**
     * Config constructor.
     * @param Authentication $authentication
     */
    public function __construct(Authentication $authentication)
    {
        $this->authentication = $authentication;
    }

    /**
     * @param string $username
     * @param string $password
     *
     * @return Config
     */
    public static function create($username, $password)
    {
        return new static(new BasicAuth($username, $password));
    }

    /**
     * @return HttpMethodsClient
     */
    public function createHttpClient()
    {
        // Authenticate requests sent through the client.
        $plugins[] = new AuthenticationPlugin($this->authentication);

        $httpClient = HttpMethodsClientFactory::create($plugins);

        return $httpClient;
    }

    /**
     * @return JsonMapper
     */
    public function createJsonMapper()
    {
        $jsonMapper = new JsonMapper();

        return $jsonMapper;
    }
}
