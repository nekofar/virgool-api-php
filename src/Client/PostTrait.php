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
 * Trait PostTrait
 */
trait PostTrait
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
     * @param array $args
     *
     * @return mixed
     *
     * @throws Exception
     */
    public function getPosts(array $args = [])
    {
        $path = $args['status'] === 'drafts' ?
            '/posts/drafts' : '/posts/published';

        $resp = $this->httpClient->get($path);

        $json = json_decode($resp->getBody(), true);

        return $json;
    }
}
