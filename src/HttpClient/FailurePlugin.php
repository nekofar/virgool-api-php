<?php
/**
 * @package Nekofar\Virgool
 *
 * @author Milad Nekofar <milad@nekofar.com>
 */

namespace Nekofar\Virgool\HttpClient;

use Http\Client\Common\Plugin;
use Http\Promise\Promise;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

/**
 * Class FailurePlugin
 */
class FailurePlugin implements Plugin
{

    /**
     * @param RequestInterface $request
     * @param callable $next
     * @param callable $first
     *
     * @return Promise|void
     */
    public function handleRequest(
        RequestInterface $request,
        callable $next,
        callable $first
    )
    {
        $promise = $next($request);

        return $promise->then(
            function (ResponseInterface $response) use ($request) {
                return $this->transformResponseToException($request, $response);
            }
        );
    }

    /**
     * @param RequestInterface $request
     * @param ResponseInterface $response
     *
     * @return ResponseInterface
     */
    protected function transformResponseToException(
        RequestInterface $request,
        ResponseInterface $response
    )
    {
        if ($response->getStatusCode() === 200) {
            $json = json_decode($response->getBody());
            if (isset($json->success) && $json->success === false) {
                $message = isset($json->msg) ? $json->msg : '';
                throw new ResponseFailureException(
                    $message,
                    $request,
                    $response
                );
            }
        }

        return $response;
    }
}
