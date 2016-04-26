<?php

namespace Tests\Anthill\TankAmmo\RequestBuilder\Fixtures;

use Anthill\TankAmmo\RequestBuilder\AbstractRequestBuilder;
use GuzzleHttp\Psr7\Request;
use InvalidArgumentException;

class AbstractRequestBuilderImplementation extends AbstractRequestBuilder
{

    /**
     * @throws InvalidArgumentException for an invalid URI
     * @return Request
     */
    public function build()
    {
        return new Request('POST', '/example');
    }
}