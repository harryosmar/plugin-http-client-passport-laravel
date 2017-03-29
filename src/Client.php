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
use PluginHttpClientPassportLaravel\Contract\AccessToken;
use PluginHttpClientPassportLaravel\Contract\Client as ContractClient;

class Client implements ContractClient, HttpMethod
{
    /**
     * @var GuzzleHttpClient
     */
    private $client;

    /**
     * @var AccessToken
     */
    private $accessToken;

    private $action = '';

    private $body = [];

    private $headers = [];

    protected $connectTimeout = 5;

    protected $debug = false;

    const ALLOW_REDIRECTS = false;

    use ResponseErrorHandler;

    public function __construct(GuzzleHttpClient $client, AccessToken $accessToken)
    {
        $this->client = $client;
        $this->accessToken = $accessToken;
    }

    public function action(string $action)
    {
        $this->action = $action;
        return $this;
    }

    public function body(array $body)
    {
        $this->body = (array) $body;
        return $this;
    }

    public function header(array $headers)
    {
        $this->headers = (array) $headers;
        return $this;
    }

    public function get()
    {
        return $this->request('GET', 'application/json', 'query');
    }

    public function post()
    {
        return $this->request('POST', 'application/x-www-form-urlencoded', 'form_params');
    }

    public function postJson()
    {
        return $this->request('POST', 'application/json', 'json');
    }

    public function postMultipart()
    {
        return $this->request('POST', 'multipart/form-data', 'multipart');
    }

    public function put()
    {
        return $this->request('PUT', 'application/json', 'json');
    }

    public function delete()
    {
        return $this->request('DELETE', 'application/json', 'query');
    }

    private function request(
        string $method,
        string $headerContentType,
        string $bodyType
    ) {
        $this->setHeaderAuthorization($this->accessToken->get());

        try {
            return $this->client->request(
                $method,
                $this->action,
                [
                    'headers' => array_merge([
                        'Accept' => $headerContentType
                    ], $this->headers),
                    $bodyType => $this->body,
                    'allow_redirects' => self::ALLOW_REDIRECTS,
                    'debug' => $this->debug,
                    'connect_timeout' => $this->connectTimeout // TODO: implement incentive parameters
                ]
            );
        } catch (RequestException $exception) {
            $this->setResponseVariableWhenError($exception);

            // TODO: handle refresh token here
        }
    }

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
