<?php

namespace Shippinno\YahooShoppingJp;

use GuzzleHttp\Client as HttpClient;
use Psr\Http\Message\ResponseInterface;
use Shippinno\YahooShoppingJp\Api\AbstractApi;
use Shippinno\YahooShoppingJp\Request\AbstractRequest;

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
     * @param string $accessToken
     * @param string $refreshToken
     * @param HttpClient|null $httpClient
     */
    public function __construct(
    string $accessToken, string $refreshToken, HttpClient $httpClient = null
    )
    {
        if (null === $httpClient) {
            $httpClient = new HttpClient([
              'base_uri' => self::BASE_URL,
            ]);
        }

        $this->accessToken  = $accessToken;
        $this->refreshToken = $refreshToken;
        $this->httpClient   = $httpClient;
    }

    /**
     * @param AbstractApi $api
     */
    public function setApi(AbstractApi $api)
    {
        $this->api = $api;
    }

    /**
     * @param AbstractRequest $request
     * @return mixed
     */
    public function execute(AbstractRequest $request): array
    {
        $options     = [];
        $options     = $this->setRequestParams(
          $options,
          $request);
        $options     = $this->setAuthorizationHeader($options);
        $rawResponse = $this->request($options);
        $response    = $this->decodeResponse($rawResponse);

        return $this->api->distillResponse($response);
    }

    /**
     * @param array $options
     * @param AbstractRequest $request
     * @return array
     */
    private function setRequestParams(array $options, AbstractRequest $request): array
    {
        if ($this->api->httpMethod()->equals(HttpMethod::GET())) {
            $options = $this->setRequestParamsForGetRequest($options,
              $request);
        }
        elseif ($this->api->httpMethod()->equals(HttpMethod::POST())) {
            $options = $this->setRequestParamsForPostRequest($options,
              $request);
        }

        return $options;
    }

    /**
     * @param array $options
     * @param AbstractRequest $request
     * @return array
     */
    private function setRequestParamsForGetRequest(array $options, AbstractRequest $request): array
    {
        $options['query'] = $request->getParams();

        return $options;
    }

    /**
     * @param array $options
     * @param AbstractRequest $request
     * @return array
     */
    private function setRequestParamsForPostRequest(array $options, AbstractRequest $request): array
    {
        if ($this->api->expectsFormFields()) {
            $options['form_param'] = $request->getParams();
        } else {
            $options['body'] = $request->getParams();
        }

        return $options;
    }

    /**
     * @param array $options
     * @return array
     */
    private function setAuthorizationHeader(array $options): array
    {
        $options['headers'] = [
          'Authorization' => 'Bearer ' . $this->accessToken,
        ];

        return $options;
    }

    /**
     * @param $options
     * @return mixed|ResponseInterface
     */
    private function request($options)
    {
        return $this->httpClient->request(
            $this->api->httpMethod()->getValue(),
            $this->api->path(),
            $options
        );
    }

    /**
     * @param ResponseInterface $rawResponse
     * @return array
     */
    private function decodeResponse(ResponseInterface $rawResponse): array
    {
        return json_decode(
          json_encode(
            simplexml_load_string(
              $rawResponse->getBody()->getContents(),
              null,
              LIBXML_NOCDATA
            )
          ),
          true
        );
    }

}
