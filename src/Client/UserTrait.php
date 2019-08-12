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
 * Trait UserTrait
 */
trait UserTrait
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
     *
     * @throws Exception
     */
    public function getUserInfo()
    {
        $resp = $this->httpClient->get('/user/info');

        return json_decode($resp->getBody());
    }
}
