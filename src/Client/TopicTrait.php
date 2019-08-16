<?php
/**
 * @package Nekofar\Virgool
 *
 * @author Milad Nekofar <milad@nekofar.com>
 */

namespace Nekofar\Virgool\Client;

use Http\Client\Common\HttpMethodsClient;
use Http\Client\Exception;
use JsonMapper;

/**
 * Trait TopicTrait
 */
trait TopicTrait
{
    /**
     * @var HttpMethodsClient
     */
    private $httpClient;

    /**
     * @var JsonMapper
     */
    private $jsonMapper;

    /**
     * @return mixed
     *
     * @throws Exception
     */
    public function getTopics()
    {
        $resp = $this->httpClient->get('/topics');

        $json = json_decode($resp->getBody(), true);

        return $json;
    }
}
