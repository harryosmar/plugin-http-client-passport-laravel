<?php
/**
 * Created by PhpStorm.
 * User: harry
 * Date: 3/29/17
 * Time: 11:46 PM
 */

namespace PluginHttpClientPassportLaravel\Base;

abstract class AccessToken implements \PluginHttpClientPassportLaravel\Contract\AccessToken
{
    const ACTION = 'oauth/token';

    const GRANT_TYPE = 'refresh_token';

    public function refresh(\GuzzleHttp\Client $client, $refreshToken, $scope): string
    {
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
                    'client_id' => '3',
                    'client_secret' => 'CvrHI3bOifYCxxanRtjj8KSaRdUDDlArpbLC2UtV',
                    'scope' => $scope,
                ],
                'allow_redirects' => \PluginHttpClientPassportLaravel\Base\Client::ALLOW_REDIRECTS,
                'debug' => $this->debug,
                'connect_timeout' => $this->connectTimeout
            ]
        );
    }
}