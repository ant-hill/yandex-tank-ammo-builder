<?php

namespace Anthill\TankAmmo\RequestBuilder;


use GuzzleHttp\Psr7\Request;
use InvalidArgumentException;

/**
 * Class JsonRequestBuilder
 * @package Anthill\TankAmmo\RequestBuilder
 * 
 * @method array setBody
 * @method array getBody
 */
class JsonRequestBuilder extends AbstractRequestBuilder
{
    /**
     * @throws InvalidArgumentException for an invalid URI
     * @return Request
     */
    public function build()
    {
        $this->setHeader('Content-Type', 'application/json; charset=UTF-8');

        $body = $this->getBody();
        if (!is_array($body)) {
            throw new InvalidArgumentException('body must be an array');
        }

        $body = json_encode($body);
        $this->setHeader('Content-Length', strlen($body));

        return new Request($this->getMethod(), $this->getUri(), $this->getHeaders(), $body,
            $this->getProtocolVersion());
    }
}