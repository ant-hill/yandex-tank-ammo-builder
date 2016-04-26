<?php

namespace Tests\Anthill\TankAmmo;


use Anthill\TankAmmo\RequestBuilder\FormRequestBuilder;
use Anthill\TankAmmo\RequestBuilder\JsonRequestBuilder;

class AmmoBuilderTest extends \PHPUnit_Framework_TestCase
{

    public function testFormAmmoBuilding()
    {
        $builder = new \Anthill\TankAmmo\AmmoBuilder();

        $requestBuilder = new FormRequestBuilder('POST', 'http://example.com/register',
            ['User-Agent' => 'ololo/176 (Nexus 5; Android 6.0.1; en_US)']);
        $requestBuilder->setBody([
            'check' => [
                'param' => 'value',
                'dfsjsdf' => 'dkjjkl',
            ],
            'language' => 'ru',
            'country' => 'RU'
        ]);

        $request = $requestBuilder->build();
        $expected = "243\r\n";
        $expected .= "POST /register HTTP/1.1\r\n";
        $expected .= "Host: example.com\r\n";
        $expected .= "User-Agent: ololo/176 (Nexus 5; Android 6.0.1; en_US)\r\n";
        $expected .= "Content-Type: application/x-www-form-urlencoded\r\n";
        $expected .= "Content-Length: 71\r\n\r\n";
        $expected .= "check%5Bparam%5D=value&check%5Bdfsjsdf%5D=dkjjkl&language=ru&country=RU\r\n\r\n";
        $this->assertEquals($expected, $builder->build($request));
    }

    public function testJsonAmmoBuilding()
    {
        $builder = new \Anthill\TankAmmo\AmmoBuilder();

        $requestBuilder = new JsonRequestBuilder('POST', 'http://example.com/register',
            ['User-Agent' => 'ololo/176 (Nexus 5; Android 6.0.1; en_US)']);
        $requestBuilder->setBody([
            'check' => [
                'param' => 'value',
                'dfsjsdf' => 'dkjjkl',
            ],
            'language' => 'ru',
            'country' => 'RU'
        ]);

        $request = $requestBuilder->build();
        $expected = "247\r\n";
        $expected .= "POST /register HTTP/1.1\r\n";
        $expected .= "Host: example.com\r\n";
        $expected .= "User-Agent: ololo/176 (Nexus 5; Android 6.0.1; en_US)\r\n";
        $expected .= "Content-Type: application/json; charset=UTF-8\r\n";
        $expected .= "Content-Length: 77\r\n\r\n";
        $expected .= "{\"check\":{\"param\":\"value\",\"dfsjsdf\":\"dkjjkl\"},\"language\":\"ru\",\"country\":\"RU\"}\r\n\r\n";

        $this->assertEquals($expected, $builder->build($request));
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testJsonAmmoBuildingExceptionBody()
    {
        $builder = new \Anthill\TankAmmo\AmmoBuilder();

        $requestBuilder = new JsonRequestBuilder('POST', 'http://example.com/register');
        $requestBuilder->setBody(';dsfdsfdk');

        $requestBuilder->build();
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testFormAmmoBuildingExceptionBody()
    {
        $builder = new \Anthill\TankAmmo\AmmoBuilder();

        $requestBuilder = new FormRequestBuilder('POST', 'http://example.com/register');
        $requestBuilder->setBody(';dsfdsfdk');

        $requestBuilder->build();
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testFormAmmoBuildingInvalidUrlException()
    {
        $builder = new \Anthill\TankAmmo\AmmoBuilder();

        $requestBuilder = new JsonRequestBuilder('POST', []);
        $requestBuilder->setBody([]);

        $requestBuilder->build();
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testJsonAmmoBuildingInvalidUrlException()
    {
        $builder = new \Anthill\TankAmmo\AmmoBuilder();

        $requestBuilder = new FormRequestBuilder('POST', []);
        $requestBuilder->setBody([]);

        $requestBuilder->build();
    }

}