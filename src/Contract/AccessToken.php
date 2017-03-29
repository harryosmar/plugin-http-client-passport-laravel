<?php
/**
 * Created by PhpStorm.
 * User: harry
 * Date: 3/29/17
 * Time: 10:52 PM
 */

namespace PluginHttpClientPassportLaravel\Contract;

interface AccessToken
{
    public function get() : string ;

    public function refresh(\GuzzleHttp\Client $client, $refreshToken, $scope) : string ;
}
