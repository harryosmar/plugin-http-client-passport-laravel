<?php
/**
 * Created by PhpStorm.
 * User: harry
 * Date: 3/29/17
 * Time: 11:46 PM
 */

namespace PluginHttpClientPassportLaravel\Base;

use GuzzleHttp\Client as GuzzleHttpClient;
use PluginHttpClientPassportLaravel\Contract\Token as ContractAccessToken;

abstract class Token implements ContractAccessToken
{
    const ACTION = 'oauth/token';

    const GRANT_TYPE = 'refresh_token';

    /**
     * @var int
     */
    private $clientId;

    /**
     * @var string
     */
    private $clientSecret;

    /**
     * @var bool
     */
    private $allowRedirects;

    /**
     * @var bool
     */
    private $debug;

    /**
     * @var int
     */
    private $connectTimeout;

    /**
     * Token constructor.
     * @param int $clientId
     * @param string $clientSecret
     * @param int $allowRedirects
     * @param int $debug
     * @param int $connectTimeout
     */
    public function __construct(
        int $clientId,
        string $clientSecret,
        int $allowRedirects,
        int $debug,
        int $connectTimeout
    ) {
        $this->clientId = $clientId;
        $this->clientSecret = $clientSecret;
        $this->allowRedirects = boolval($allowRedirects);
        $this->debug = boolval($debug);
        $this->connectTimeout = $connectTimeout;
    }

    /**
     * @return int
     */
    public function getClientId()
    {
        return $this->clientId;
    }

    /**
     * @return string
     */
    public function getClientSecret()
    {
        return $this->clientSecret;
    }

    /**
     * @param GuzzleHttpClient $client
     * @param $refreshToken
     * @param $scope
     * @return Token
     */
    public function refresh(
        GuzzleHttpClient $client,
        $refreshToken,
        $scope
    ) : self {
        // TODO: Implement refresh() method.
        return $client->request(
            'POST',
            self::ACTION,
            [
                'headers' => [
                    'Accept' => 'application/x-www-form-urlencoded'
                ],
                'form_params' => [
                    'grant_type' => self::GRANT_TYPE,
                    'refresh_token' => $refreshToken,
                    'client_id' => $this->clientId,
                    'client_secret' => $this->clientSecret,
                    'scope' => $scope,
                ],
                'allow_redirects' => $this->allowRedirects,
                'debug' => $this->debug,
                'connect_timeout' => $this->connectTimeout
            ]
        );
    }
}