<?php
/**
 * @package Nekofar\Virgool
 *
 * @author Milad Nekofar <milad@nekofar.com>
 */

namespace Nekofar\Virgool;

use Http\Client\Common\HttpMethodsClient;
use Http\Client\Common\Plugin\AuthenticationPlugin;
use Http\Client\Common\Plugin\BaseUriPlugin;
use Http\Client\Common\Plugin\ErrorPlugin;
use Http\Client\Common\Plugin\HeaderDefaultsPlugin;
use Http\Client\Common\PluginClient;
use Http\Client\HttpClient;
use Http\Discovery\HttpClientDiscovery;
use Http\Discovery\MessageFactoryDiscovery;
use Http\Discovery\UriFactoryDiscovery;
use Http\Message\Authentication;
use Http\Message\Authentication\BasicAuth;
use Nekofar\Virgool\Exception\InvalidArgumentException;

/**
 * Class Client
 */
class Client
{
    /**
     * @const string
     */
    const BASE_URL = 'https://virgool.io/api/v1.2/';

    /**
     * @var string
     */
    private $baseUrl;

    /**
     * @var HttpClient
     */
    private $httpClient;

    /**
     * @var Authentication
     */
    private $authentication;

    /**
     * Client constructor.
     *
     * @param string $username
     * @param string $password
     */
    public function __construct($username, $password)
    {
        $this->baseUrl = Client::BASE_URL;
        $this->authentication = new BasicAuth($username, $password);
    }

    /**
     * @param string $username
     * @param string $password
     *
     * @return Client
     */
    public static function create($username, $password)
    {
        return new static($username, $password);
    }

    /**
     * @param HttpClient $httpClient
     */
    public function setHttpClient($httpClient)
    {
        // Make sure http client instance is valid.
        if (!$httpClient instanceof HttpClient) {
            throw new InvalidArgumentException(
                'HttpClient instance is invalid'
            );
        }

        $this->httpClient = $httpClient;
    }

    /**
     * @return HttpMethodsClient
     */
    public function getHttpClient()
    {
        // Finds an HTTP Client implementation if no client provided.
        $this->httpClient = $this->httpClient ?: HttpClientDiscovery::find();

        // Identify the client and it's version.
        $headers['User-Agent'] = 'nekofar/virgool@0.1.0';

        // Designate the content to be in JSON format.
        $headers['Content-Type'] = 'application/json';

        // Define default values for given headers.
        $plugins[] = new HeaderDefaultsPlugin($headers);

        // Transforms responses with HTTP error status codes into exceptions.
        $plugins[] = new ErrorPlugin();

        // Authenticate requests sent through the client.
        $plugins[] = new AuthenticationPlugin($this->authentication);

        // Finds a URI factory for a URI implementation and create a URI.
        $uriFactory = UriFactoryDiscovery::find()->createUri($this->baseUrl);

        // Set host, scheme and port and prefix the request path with a path.
        $plugins[] = new BaseUriPlugin($uriFactory, ['replace' => true]);

        // Wrap the HttpClient and add some processing logic using plugins.
        $pluginClient = new PluginClient($this->httpClient, $plugins);

        // Finds a Message factory for a Message implementation.
        $messageFactory = MessageFactoryDiscovery::find();

        // Wraps the HttpClient and provides methods for common HTTP requests.
        return new HttpMethodsClient($pluginClient, $messageFactory);
    }
}
