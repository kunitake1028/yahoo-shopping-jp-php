<?php

namespace Shippinno\YahooShoppingJp;

use GuzzleHttp\Client as HttpClient;
use Shippinno\YahooShoppingJp\Api\AbstractApi;

class Client
{
//    /**
//     * @var string
//     */
//    const BASE_URL = 'https://circus.shopping.yahooapis.jp/ShoppingWebService/V1/';

    /**
     * @var string
     */
    const BASE_URL = 'https://test.circus.shopping.yahooapis.jp/ShoppingWebService/V1/';

    /**
     * @var AbstractApi
     */
    private $api;

    /**
     * @var string
     */
    private $accessToken;

    /**
     * @var string
     */
    private $refreshToken;

    /**
     * Clients constructor.
     * @param HttpClient $httpClient
     */
    public function __construct(
        string $accessToken,
        string $refreshToken,
        HttpClient $httpClient = null
    )
    {
        if (null === $httpClient) {
            $httpClient = new HttpClient([
                'base_uri' => self::BASE_URL,
            ]);
        }

        $this->accessToken = $accessToken;
        $this->refreshToken = $refreshToken;
        $this->httpClient = $httpClient;
    }

    /**
     * @param AbstractApi $api
     */
    public function setApi(AbstractApi $api)
    {
        $this->api = $api;
    }

    /**
     * @param array $params
     * @return array
     */
    public function execute(array $params): array
    {
        $rawResponse = $this->httpClient->post($this->api->path(), [
            'form_params' => $params,
            'headers' => [
                'Authorization' => 'Bearer '.$this->accessToken,
            ],
        ]);

        $response = json_decode(
            json_encode(
                simplexml_load_string($rawResponse->getBody()->getContents(), null, LIBXML_NOCDATA)
            ),
            true
        );

        return $response;
    }

    public function execute2(Builder $builder)
    {
        $params = $builder->toArray();

        $rawResponse = $this->httpClient->post($this->api->path(), [
            'form_params' => $params,
            'headers' => [
                'Authorization' => 'Bearer '.$this->accessToken,
            ],
        ]);

        $response = json_decode(
            json_encode(
                simplexml_load_string($rawResponse->getBody()->getContents(), null, LIBXML_NOCDATA)
            ),
            true
        );

        return $response;
    }
}