<?php
/**
 * Created by PhpStorm.
 * User: harry
 * Date: 3/29/17
 * Time: 9:33 PM
 */

namespace PluginHttpClientPassportLaravel\Contract;

interface Client
{
    public function action(string $action);

    public function body(array $body);

    public function header(array $headers);
}
