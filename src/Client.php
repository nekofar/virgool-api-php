<?php
/**
 * @package Nekofar\Virgool
 *
 * @author Milad Nekofar <milad@nekofar.com>
 */

namespace Nekofar\Virgool;

use Http\Client\HttpClient;
use JsonMapper;
use Nekofar\Virgool\Client\PostTrait;
use Nekofar\Virgool\Client\TopicTrait;
use Nekofar\Virgool\Client\UserTrait;

/**
 * Class Client
 */
class Client
{
    use UserTrait;
    use TopicTrait;
    use PostTrait;

    /**
     * @var HttpClient
     */
    private $httpClient;

    /**
     * @var JsonMapper
     */
    private $jsonMapper;

    /**
     * Client constructor.
     *
     * @param HttpClient $httpClient
     * @param JsonMapper $jsonMapper
     */
    public function __construct(
        HttpClient $httpClient,
        JsonMapper $jsonMapper
    ) {
        $this->httpClient = $httpClient;
        $this->jsonMapper = $jsonMapper;
    }

    /**
     * @param Config $config
     *
     * @return Client
     */
    public static function create(Config $config)
    {
        return new static(
            $config->createHttpClient(),
            $config->createJsonMapper()
        );
    }
}
