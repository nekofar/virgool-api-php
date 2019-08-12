<?php
/**
 * @package Nekofar\Virgool
 *
 * @author Milad Nekofar <milad@nekofar.com>
 */

namespace Nekofar\Virgool\Authentication;

use Http\Client\Exception;
use Http\Message\Authentication;
use Nekofar\Virgool\Client\AuthTrait;
use Nekofar\Virgool\HttpClient\HttpMethodsClientFactory;
use Psr\Http\Message\RequestInterface;

/**
 * Class BasicAuth
 */
class BasicAuth implements Authentication
{
    use AuthTrait;

    /**
     * @var string
     */
    private $username;

    /**
     * @var string
     */
    private $password;

    /**
     * @param string $username
     * @param string $password
     */
    public function __construct($username, $password)
    {
        $this->username = $username;
        $this->password = $password;

        $this->httpClient = HttpMethodsClientFactory::create();
    }

    /**
     * {@inheritdoc}
     *
     * @throws Exception
     */
    public function authenticate(RequestInterface $request)
    {
        $this->accessToken = $this->refreshToken(
            $this->username,
            $this->password
        );

        $header = sprintf('Bearer %s', $this->accessToken);

        return $request->withHeader('Authorization', $header);
    }
}
