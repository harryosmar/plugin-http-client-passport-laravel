<?php
/**
 * Created by PhpStorm.
 * User: harry
 * Date: 3/29/17
 * Time: 11:28 PM
 */

namespace PluginHttpClientPassportLaravel\Shared;

use GuzzleHttp\Exception\RequestException;
use PluginHttpClientPassportLaravel\Exception\CurlErrorException;
use PluginHttpClientPassportLaravel\Exception\NullResponseException;

trait ResponseErrorHandler
{
    private function setResponseVariableWhenError(RequestException $exception)
    {
        $response = $exception->getResponse();

        //for curl error, place this before called func statuscode & getcontents to avoid error
        if (!$response) {
            throw new CurlErrorException($exception->getMessage(), 500);
        }

        $statusCode = $response->getStatusCode();
        $content = $response->getBody()->getContents();

        // for 503: Service Temporarily Unavailable, there is no data received, empty response content
        if (!$content) {
            throw new NullResponseException(
                'Response does not contain any data.',
                $statusCode
            );
        }
    }
}
