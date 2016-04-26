<?php

namespace Anthill\TankAmmo\RequestBuilder;


use GuzzleHttp\Psr7\Request;
use InvalidArgumentException;

/**
 * Class FormRequestBuilder
 * @package Anthill\TankAmmo\RequestBuilder
 *
 * @method array setBody
 * @method array getBody
 */
class FormRequestBuilder extends AbstractRequestBuilder
{
    /**
     * @throws InvalidArgumentException for an invalid URI or Body
     * @return Request
     */
    public function build()
    {
        $this->setHeader('Content-Type', 'application/x-www-form-urlencoded');

        $body = $this->getBody();
        if (!is_array($body)) {
            throw new InvalidArgumentException('body must be an array');
        }

        $body = http_build_query($this->getBody());
        $this->setHeader('Content-Length', strlen($body));

        return new Request($this->getMethod(), $this->getUri(), $this->getHeaders(), $body,
            $this->getProtocolVersion());
    }
}