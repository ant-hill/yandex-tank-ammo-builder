<?php
namespace Anthill\TankAmmo\RequestBuilder;

use GuzzleHttp\Psr7\Request;
use InvalidArgumentException;
use Psr\Http\Message\UriInterface;

abstract class AbstractRequestBuilder
{
    /**
     * @var null|string
     */
    private $method;
    /**
     * @var null|UriInterface|string
     */
    private $uri;
    /**
     * @var array
     */
    private $headers = array();
    /**
     * @var mixed
     */
    private $body;
    /**
     * @var string
     */
    private $protocolVersion = '1.1';

    /**
     * @param null|string $method HTTP method for the request.
     * @param null|string|UriInterface $uri URI for the request.
     * @param array $headers Headers for the message.
     *
     */
    public function __construct(
        $method = null,
        $uri = null,
        array $headers = []
    ) {

        $this->method = $method;
        $this->uri = $uri;
        $this->headers = $headers;
    }

    /**
     * @param $name
     * @param $value
     * @return $this
     */
    public function setHeader($name, $value)
    {
        $this->headers[$name] = $value;
        return $this;
    }

    /**
     * @return array
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * @param $bodyParams
     * @return $this
     */
    public function setBody($bodyParams)
    {
        $this->body = $bodyParams;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getMethod()
    {
        return $this->method;
    }

    /**
     * @param null|string $method
     */
    public function setMethod($method)
    {
        $this->method = $method;
    }

    /**
     * @return null|UriInterface|string
     */
    public function getUri()
    {
        return $this->uri;
    }

    /**
     * @param null|UriInterface|string $uri
     */
    public function setUri($uri)
    {
        $this->uri = $uri;
    }

    /**
     * @return array
     */
    public function getHeaders()
    {
        return $this->headers;
    }

    /**
     * @param array $headers
     */
    public function setHeaders(array $headers)
    {
        $this->headers = $headers;
    }

    /**
     * @return string
     */
    public function getProtocolVersion()
    {
        return $this->protocolVersion;
    }

    /**
     * @param string $protocolVersion
     */
    public function setProtocolVersion($protocolVersion)
    {
        $this->protocolVersion = $protocolVersion;
    }

    /**
     * @throws InvalidArgumentException for an invalid URI
     * @return Request
     */
    abstract public function build();
}