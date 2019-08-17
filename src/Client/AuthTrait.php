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
 * Trait AuthTrait
 */
trait AuthTrait
{
    /**
     * @var string
     */
    private $accessToken;

    /**
     * @var HttpMethodsClient
     */
    private $httpClient;

    /**
     * @var JsonMapper
     */
    private $jsonMapper;

    /**
     * Refresh authentication access token.
     *
     * @param string $username
     * @param string $password
     *
     * @return string
     *
     * @throws Exception
     * @throws \Exception
     */
    public function refreshToken($username = null, $password = null)
    {
        if ($this->accessToken) {
            $data = json_encode(['refreshToken' => $this->accessToken]);
            $resp = $this->httpClient->post('/auth/checktoken', [], $data);
            $json = json_decode($resp->getBody());

            if ($json->success) {
                return $this->accessToken;
            }
        }

        $data = ['username' => $username, 'password' => $password];
        $data = http_build_query($data);
        $resp = $this->httpClient->post('/login', [], $data);
        $json = json_decode($resp->getBody());

        if ($json->success) {
            $this->accessToken = $json->token;
        }

        return $this->accessToken;
    }
}
