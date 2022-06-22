<?php

namespace Shippinno\YahooShoppingJp;

use App\Constants\HttpCode;
use GuzzleHttp\Client as HttpClient;
use GuzzleHttp\Exception\ConnectException as GuzzleConnectException;
use GuzzleHttp\Exception\ServerException as GuzzleServerException;
use GuzzleHttp\Exception\ClientException as GuzzleClientException;
use GuzzleHttp\RequestOptions;
use Psr\Http\Message\ResponseInterface;
use Shippinno\YahooShoppingJp\Api\AbstractApi;
use Shippinno\YahooShoppingJp\Exception\ClientException;
use Shippinno\YahooShoppingJp\Exception\ConnectException;
use Shippinno\YahooShoppingJp\Exception\ExpiredAccessTokenException;
use Shippinno\YahooShoppingJp\Exception\ServerException;
use Shippinno\YahooShoppingJp\Exception\TokenSessionExpired;
use Shippinno\YahooShoppingJp\Request\AbstractRequest;
use SoapBox\Formatter\Formatter;

class Client
{
    /**
     * @var string
     */
    private $baseUrl = 'https://circus.shopping.yahooapis.jp/ShoppingWebService/V1/';

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
    private $cert;

    /**
     * @var
     */
    private $sslKey;

    /**
     * @param string $accessToken
     * @param string|null $cert
     * @param string|null $sslKey
     * @param bool $enableTestMode
     * @param HttpClient|null $httpClient
     */
    public function __construct(
        string $accessToken,
        string $cert = null,
        string $sslKey = null,
        bool $enableTestMode = false,
        HttpClient $httpClient = null
    ) {
        if ($enableTestMode) {
            $this->baseUrl = 'https://test.circus.shopping.yahooapis.jp/ShoppingWebService/V1/';
        }

        if (null === $httpClient) {
            $httpClient = new HttpClient([
                'base_uri' => $this->baseUrl,
            ]);
        }

        $this->accessToken = $accessToken;
        $this->cert = $cert;
        $this->sslKey = $sslKey;
        $this->httpClient = $httpClient;
    }

    /**
     * @param AbstractRequest $request
     * @return array|mixed
     * @throws ClientException
     * @throws ConnectException
     * @throws ExpiredAccessTokenException
     * @throws ServerException
     * @throws TokenSessionExpired
     */
    public function execute(AbstractRequest $request, $isReturnRawResponse = false)
    {
        $this->setApi($request->api());

        $options = $this->setAuthorizationHeader($this->setRequestParams($request));

        $options = $this->setCertAndSslKey($options);

        try {
            $rawResponse = $this->request($options);
        } catch (GuzzleClientException $e) {
            $wwwAuthenticateHeaders = $e->getResponse()->getHeader('WWW-Authenticate');
            $bodyContent = $this->decodeResponse($e->getResponse());
            if ($e->getCode() === 401 && $bodyContent['Code'] === 'px-04102') {
                throw new TokenSessionExpired();
            }

            if ([] !== $wwwAuthenticateHeaders) {
                if (false !== strpos($wwwAuthenticateHeaders[0], 'error_description="expired token"')) {
                    throw new ExpiredAccessTokenException;
                }
            }

            throw new ClientException($e->getMessage(), $e->getCode(), $e);
        } catch (GuzzleServerException $e) {
            throw new ServerException($e->getMessage(), $e->getCode(), $e);
        } catch (GuzzleConnectException $e) {
            throw new ConnectException($e->getMessage(), $e->getCode(), $e);
        }
        if ($isReturnRawResponse) {
            return $rawResponse;
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
    private function setCertAndSslKey(array $options): array
    {
        if (null !== $this->cert && null !== $this->sslKey) {
            $options[RequestOptions::CERT] = $this->cert;
            $options[RequestOptions::SSL_KEY] = $this->sslKey;
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
