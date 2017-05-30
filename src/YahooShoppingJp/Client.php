<?php

namespace Shippinno\YahooShoppingJp;

use GuzzleHttp\Client as HttpClient;
use GuzzleHttp\Exception\ConnectException as GuzzleConnectException;
use GuzzleHttp\Exception\ServerException as GuzzleServerException;
use GuzzleHttp\Exception\ClientException as GuzzleClientException;
use Psr\Http\Message\ResponseInterface;
use Shippinno\YahooShoppingJp\Api\AbstractApi;
use Shippinno\YahooShoppingJp\Exception\ClientException;
use Shippinno\YahooShoppingJp\Exception\ConnectException;
use Shippinno\YahooShoppingJp\Exception\ServerException;
use Shippinno\YahooShoppingJp\Request\AbstractRequest;
use SoapBox\Formatter\Formatter;

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
        string $accessToken,
        string $refreshToken,
        HttpClient $httpClient = null
    ) {
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
     * @param AbstractRequest $request
     * @return mixed
     * @throws ClientException
     * @throws ConnectException
     * @throws ServerException
     */
    public function execute(AbstractRequest $request): array
    {
        $this->setApi($request->api());

        $options = $this->setAuthorizationHeader($this->setRequestParams($request));

        try {
            $rawResponse = $this->request($options);
        } catch (GuzzleClientException $e) {
            throw new ClientException($e->getMessage(), $e->getCode(), $e);
        } catch (GuzzleServerException $e) {
            throw new ServerException($e->getMessage(), $e->getCode(), $e);
        } catch (GuzzleConnectException $e) {
            throw new ConnectException($e->getMessage(), $e->getCode(), $e);
        }

        return $this->api->distillResponse($this->decodeResponse($rawResponse));
//        $response = $request->response()->setData($distilledResponse);
    }

    /**
     * @param AbstractApi $api
     */
    private function setApi(AbstractApi $api)
    {
        $this->api = $api;
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
     * @param AbstractRequest $request
     * @return array
     */
    private function setRequestParams(AbstractRequest $request): array
    {
        $options = [];
        if ($this->api->httpMethod()->equals(HttpMethod::GET())) {
            $options = $this->setRequestParamsForGetRequest($options, $request);
        } else {
            if ($this->api->httpMethod()->equals(HttpMethod::POST())) {
                $options = $this->setRequestParamsForPostRequest($options, $request);
            }
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
            $options['form_params'] = $request->getParams();
        } else {
            $options['body'] = $request->getParams();
        }

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
        $formatter = Formatter::make($rawResponse->getBody()->getContents(), Formatter::XML);
        return $formatter->toArray();
    }
}
