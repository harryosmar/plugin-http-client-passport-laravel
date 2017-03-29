<?php
/**
 * Created by PhpStorm.
 * User: harry
 * Date: 3/29/17
 * Time: 5:55 PM
 */

namespace PluginHttpClientPassportLaravel\Contract;

interface HttpMethod
{
    public function get();

    public function post();

    public function put();

    public function delete();
}
