<?php

namespace Shippinno\YahooShoppingJp;

use GuzzleHttp\Client as HttpClient;
use GuzzleHttp\TransferStats;
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
     * @var boolean
     */
    private $debug = false;

    /**
     * @param string $accessToken
     * @param string $refreshToken
     */
    public function __construct(string $accessToken, string $refreshToken, HttpClient $httpClient = null)
    {
        $this->accessToken  = $accessToken;
        $this->refreshToken = $refreshToken;

        if ( null === $httpClient ) {
            $httpClient = new HttpClient([
              'base_uri' => self::BASE_URL,
            ]);
        }
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
    public function execute(array $params, $method = 'POST'): array
    {
        if ( strtoupper($method) === 'GET' ) {
            $options['query'] = $params;
        }
        else {
            // 適当
            $options['body'] = $params;
        }
        $options['headers'] = [
          'Authorization' => 'Bearer ' . $this->accessToken,
        ];

        if ( $this->debug ) {
            $options['on_stats'] = function (TransferStats $stats) {
                echo $stats->getEffectiveUri() . "\n";
                echo $stats->getTransferTime() . "\n";
                var_dump($stats->getHandlerStats());

                // You must check if a response was received before using the
                // response object.
                if ( $stats->hasResponse() ) {
                    echo $stats->getResponse()->getStatusCode();
                }
                else {
                    // Error data is handler specific. You will need to know what
                    // type of error data your handler uses before using this
                    // value.
                    var_dump($stats->getHandlerErrorData());
                }
            };
            $options['debug'] = true;
        }

        $rawResponse = $this->httpClient->request($method, $this->api->path(), $options);

        $response = json_decode(
          json_encode(
            simplexml_load_string($rawResponse->getBody()->getContents(), null, LIBXML_NOCDATA)
          ), true
        );
        return $response;
    }

    public function setDebug(Bool $set)
    {
        $this->debug = $set;
    }

}
