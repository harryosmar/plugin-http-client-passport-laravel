<?php
/**
 * Created by PhpStorm.
 * User: harry
 * Date: 3/29/17
 * Time: 9:44 PM
 */

namespace PluginHttpClientPassportLaravel;

use GuzzleHttp\Exception\RequestException;
use PluginHttpClientPassportLaravel\Contract\HttpMethod;
use GuzzleHttp\Client as GuzzleHttpClient;
use PluginHttpClientPassportLaravel\Shared\ResponseErrorHandler;
use PluginHttpClientPassportLaravel\Contract\Token;
use PluginHttpClientPassportLaravel\Contract\Client as ContractClient;

class Client implements ContractClient, HttpMethod
{
    /**
     * @var GuzzleHttpClient
     */
    private $client;

    /**
     * @var Token
     */
    private $token;

    /**
     * @var string
     */
    private $action = '';

    /**
     * @var array
     */
    private $body = [];

    /**
     * @var array
     */
    private $headers = [];

    /**
     * @var int
     */
    protected $connectTimeout;

    /**
     * @var bool
     */
    protected $debug;

    /**
     * @var bool
     */
    protected $allowRedirects;

    use ResponseErrorHandler;

    /**
     * Client constructor.
     * @param GuzzleHttpClient $client
     * @param Token $token
     * @param int $allowRedirects
     * @param int $debug
     * @param int $connectTimeout
     */
    public function __construct(
        GuzzleHttpClient $client,
        Token $token,
        int $allowRedirects,
        int $debug,
        int $connectTimeout
    ) {
        $this->client = $client;
        $this->token = $token;
        $this->allowRedirects = boolval($allowRedirects);
        $this->debug = boolval($debug);
        $this->connectTimeout = $connectTimeout;
    }

    /**
     * @param string $action
     * @return $this
     */
    public function action(string $action)
    {
        $this->action = $action;
        return $this;
    }

    /**
     * @param array $body
     * @return $this
     */
    public function body(array $body)
    {
        $this->body = (array) $body;
        return $this;
    }

    /**
     * @param array $headers
     * @return $this
     */
    public function header(array $headers)
    {
        $this->headers = (array) $headers;
        return $this;
    }

    /**
     * @return mixed|\Psr\Http\Message\ResponseInterface
     */
    public function get()
    {
        return $this->request(
            'GET',
            'application/json',
            'query'
        );
    }

    /**
     * @return mixed|\Psr\Http\Message\ResponseInterface
     */
    public function post()
    {
        return $this->request(
            'POST',
            'application/x-www-form-urlencoded',
            'form_params'
        );
    }

    /**
     * @return mixed|\Psr\Http\Message\ResponseInterface
     */
    public function postJson()
    {
        return $this->request(
            'POST',
            'application/json',
            'json'
        );
    }

    /**
     * @return mixed|\Psr\Http\Message\ResponseInterface
     */
    public function postMultipart()
    {
        return $this->request(
            'POST',
            'multipart/form-data',
            'multipart'
        );
    }

    /**
     * @return mixed|\Psr\Http\Message\ResponseInterface
     */
    public function put()
    {
        return $this->request(
            'PUT',
            'application/json',
            'json'
        );
    }

    /**
     * @return mixed|\Psr\Http\Message\ResponseInterface
     */
    public function delete()
    {
        return $this->request(
            'DELETE',
            'application/json',
            'query'
        );
    }

    /**
     * @param string $method
     * @param string $headerContentType
     * @param string $bodyType
     * @return mixed|\Psr\Http\Message\ResponseInterface
     */
    private function request(
        string $method,
        string $headerContentType,
        string $bodyType
    ) {
        $this->setHeaderAuthorization($this->token->getAccessToken());

        try {
            return $this->client->request(
                $method,
                $this->action,
                [
                    'headers' => array_merge([
                        'Accept' => $headerContentType
                    ], $this->headers),
                    $bodyType => $this->body,
                    'allow_redirects' => $this->allowRedirects,
                    'debug' => $this->debug,
                    'connect_timeout' => $this->connectTimeout
                ]
            );
        } catch (RequestException $exception) {
            $this->setResponseVariableWhenError($exception);

            // TODO: handle refresh token here
        }
    }

    /**
     * @return bool
     */
    public function getAllowRedirects()
    {
        return $this->allowRedirects;
    }

    /**
     * @return bool
     */
    public function getDebug()
    {
        return $this->debug;
    }

    /**
     * @return int
     */
    public function getConnectTimeout()
    {
        return $this->connectTimeout;
    }

    /**
     * @param $accessToken
     * @return $this
     */
    private function setHeaderAuthorization($accessToken)
    {
        $this->headers['Authorization'] = sprintf(
            '%s %s',
            'Bearer',
            $accessToken
        );

        return $this;
    }
}
