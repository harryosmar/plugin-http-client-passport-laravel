<?php
/**
 * Created by PhpStorm.
 * User: harry
 * Date: 3/29/17
 * Time: 5:55 PM
 */

namespace PluginHttpClientPassportLaravel;

interface Client
{
    public function get();

    public function post();

    public function put();

    public function delete();
}
