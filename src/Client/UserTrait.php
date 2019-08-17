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
     * @param array $args
     *
     * @return mixed
     *
     * @throws Exception
     */
    public function getUser(array $args = [])
    {
        $args = array_merge(
            [
                'hash' => '',
            ],
            $args
        );

        // Get current user info if no hash presents.
        $path = $args['hash'] ? '/user/' . $args['hash'] : '/user/info';

        $resp = $this->httpClient->get($path);

        $json = json_decode($resp->getBody(), true);

        return $json;
    }
}
