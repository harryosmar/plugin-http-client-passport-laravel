<?php
/**
 * Created by PhpStorm.
 * User: harry
 * Date: 3/29/17
 * Time: 10:52 PM
 */

namespace PluginHttpClientPassportLaravel\Contract;

interface Token
{
    public function set(array $data);

    public function getTokenType() : string ;

    public function getExpiresIn() : int ;

    public function getAccessToken() : string ;

    public function getRefreshToken() : string ;

    public function refresh(\GuzzleHttp\Client $client, $refreshToken, $scope);
}
