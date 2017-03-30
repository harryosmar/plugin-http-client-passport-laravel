<?php
/**
 * Created by PhpStorm.
 * User: harry
 * Date: 3/29/17
 * Time: 10:52 PM
 */

namespace PluginHttpClientPassportLaravel\Libraries;

use PluginHttpClientPassportLaravel\Base\Token as BaseToken;

class Token extends BaseToken
{
    /**
     * @param array $data
     * @return Token
     */
    public function set(array $data) : self
    {
        // TODO: Implement set() method.
    }

    /**
     * @return string
     */
    public function getTokenType(): string
    {
        // TODO: Implement getTokenType() method.
    }

    /**
     * @return int
     */
    public function getExpiresIn(): int
    {
        // TODO: Implement getExpiresIn() method.
    }

    /**
     * @return string
     */
    public function getAccessToken(): string
    {
        // TODO: Implement getAccessToken() method.
    }

    /**
     * @return string
     */
    public function getRefreshToken(): string
    {
        // TODO: Implement getRefreshToken() method.
    }
}
