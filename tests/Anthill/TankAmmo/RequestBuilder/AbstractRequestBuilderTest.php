<?php

namespace Tests\Anthill\TankAmmo\RequestBuilder;

use Anthill\TankAmmo\RequestBuilder\AbstractRequestBuilder;
use Tests\Anthill\TankAmmo\RequestBuilder\Fixtures\AbstractRequestBuilderImplementation;

class AbstractRequestBuilderTest extends \PHPUnit_Framework_TestCase
{
    public function testProtocolVersionSetterAndGetter()
    {
        $version = '2.1';
        $requestBuilder = $this->getInstance();
        $requestBuilder->setProtocolVersion('2.1');
        $this->assertEquals($version, $requestBuilder->getProtocolVersion());
        return $requestBuilder;
    }

    /**
     * @return AbstractRequestBuilderImplementation
     */
    public function getInstance()
    {
        return new AbstractRequestBuilderImplementation();
    }

    /**
     * @depends testProtocolVersionSetterAndGetter
     * @param AbstractRequestBuilder $requestBuilder
     * @return AbstractRequestBuilderImplementation
     */
    public function testHeadersSetterAndGetter(AbstractRequestBuilder $requestBuilder)
    {
        $requestBuilder->setHeaders([]);
        $requestBuilder->setHeader('asd', 'qwe');
        $requestBuilder->setHeader('asd1', 'qwe1');
        $requestBuilder->setHeader('asd2', 'qwe2');
        $expected = array(
            'asd' => 'qwe',
            'asd1' => 'qwe1',
            'asd2' => 'qwe2',
        );
        $this->assertEquals($expected, $requestBuilder->getHeaders());
        return $requestBuilder;
    }

    /**
     * @depends testHeadersSetterAndGetter
     * @param AbstractRequestBuilder $requestBuilder
     * @return AbstractRequestBuilderImplementation
     */
    public function testUriSetterAndGetter(AbstractRequestBuilder $requestBuilder)
    {
        $requestBuilder->setUri('asdqwe');
        $this->assertEquals('asdqwe', $requestBuilder->getUri());
        return $requestBuilder;
    }

    /**
     * @depends testUriSetterAndGetter
     * @param AbstractRequestBuilder $requestBuilder
     * @return AbstractRequestBuilderImplementation
     */
    public function testMethodSetterAndGetter(AbstractRequestBuilder $requestBuilder)
    {
        $requestBuilder->setMethod('DELETE');
        $this->assertEquals('DELETE', $requestBuilder->getMethod());
        return $requestBuilder;
    }

    /**
     * @depends testMethodSetterAndGetter
     * @param AbstractRequestBuilder $requestBuilder
     * @return AbstractRequestBuilderImplementation
     */
    public function testBodySetterAndGetter(AbstractRequestBuilder $requestBuilder)
    {
        $expected = new \ArrayObject([]);
        $requestBuilder->setBody($expected);

        $this->assertEquals($expected,$requestBuilder->getBody());
        return $requestBuilder;
    }

}