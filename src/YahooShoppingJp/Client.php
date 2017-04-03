<?php

namespace Shippinno\YahooShoppingJp;

use FluidXml\FluidXml;
use GuzzleHttp\Client as HttpClient;
use Shippinno\YahooShoppingJp\Api\AbstractApi;
use Symfony\Component\Console\Exception\LogicException;

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
     * @var HttpClient
     */
    private $httpClient;

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
        if ($this->api->httpMethod()->equals(HttpMethod::GET())) {
            $options['query'] = $params;
        } elseif ($this->api->httpMethod()->equals(HttpMethod::POST())) {
            $fluidXml = new FluidXml('Req');
            $fluidXml->add($params);
            $options['body'] = $fluidXml->xml();
        } else {
            throw new LogicException('HTTP メソッドが不正です。');
        }

        $options['headers'] = [
            'Authorization' => 'Bearer ' . $this->accessToken,
        ];

//        if ( $this->debug ) {
//            $options['on_stats'] = function (TransferStats $stats) {
//                echo $stats->getEffectiveUri() . "\n";
//                echo $stats->getTransferTime() . "\n";
//                var_dump($stats->getHandlerStats());
//
//                // You must check if a response was received before using the
//                // response object.
//                if ( $stats->hasResponse() ) {
//                    echo $stats->getResponse()->getStatusCode();
//                }
//                else {
//                    // Error data is handler specific. You will need to know what
//                    // type of error data your handler uses before using this
//                    // value.
//                    var_dump($stats->getHandlerErrorData());
//                }
//            };
//            $options['debug'] = true;
//        }

        $rawResponse = $this->httpClient->request(
            $this->api->httpMethod()->getValue(),
            $this->api->path(),
            $options
        );


        $response = json_decode(
            json_encode(
                simplexml_load_string($rawResponse->getBody()->getContents(), null, LIBXML_NOCDATA)
            ),
            true
        );

//        var_dump($response);
        return $this->api->distillResponse($response);
    }
}