<?php
/**
 * @package Nekofar\Virgool
 *
 * @author Milad Nekofar <milad@nekofar.com>
 */

namespace Nekofar\Virgool\HttpClient;

use Http\Client\Common\HttpMethodsClient;
use Http\Client\Common\Plugin\BaseUriPlugin;
use Http\Client\Common\Plugin\ErrorPlugin;
use Http\Client\Common\PluginClient;
use Http\Client\HttpClient;
use Http\Discovery\HttpClientDiscovery;
use Http\Discovery\MessageFactoryDiscovery;
use Http\Discovery\UriFactoryDiscovery;
use Nekofar\Virgool\Config;

/**
 * Class HttpClientFactory
 */
class HttpMethodsClientFactory
{
    /**
     * @param array $plugins
     * @param HttpClient $httpClient
     *
     * @return HttpMethodsClient
     */
    public static function create(
        array $plugins = [],
        HttpClient $httpClient = null
    ) {
        // Finds an HTTP Client implementation if no client provided.
        $httpClient = $httpClient ?: HttpClientDiscovery::find();

        // Finds a URI factory for a URI implementation.
        $uriFactory = UriFactoryDiscovery::find();

        // Finds a Message factory for a Message implementation.
        $messageFactory = MessageFactoryDiscovery::find();

        // Transforms responses with HTTP error status codes into exceptions.
        $plugins[] = new ErrorPlugin();

        // Set host, scheme and port and prefix the request path with a path.
        $plugins[] = new BaseUriPlugin(
            $uriFactory->createUri(Config::CLIENT_BASE_URL),
            ['replace' => true]
        );

        // Wrap the HttpClient and add some processing logic using plugins.
        $pluginClient = new PluginClient($httpClient, $plugins);

        // Wraps the HttpClient and provides methods for common HTTP requests.
        return new HttpMethodsClient($pluginClient, $messageFactory);
    }
}
