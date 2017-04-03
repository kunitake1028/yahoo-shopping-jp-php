<?php
require_once("vendor/autoload.php");


use YConnect\Constant\OIDConnectDisplay;
use YConnect\Constant\OIDConnectPrompt;
use YConnect\Constant\OIDConnectScope;
use YConnect\Constant\ResponseType;
use YConnect\Credential\ClientCredential;
use YConnect\YConnectClient;

//yahooシッピーノアプリID（webnotakumiで取得）
define('YAHOO_APP_ID_TEST', 'dj0zaiZpPUZFNTFuUUQ3Q2piSSZzPWNvbnN1bWVyc2VjcmV0Jng9MWY-');//test
define('YAHOO_SECRET_TEST', 'a71d10c84a7826c7f98aae379f4d33607dff4a87');//test

define('ACCESS_TOKEN_FILE', 'access_token.txt');
define('REFRESH_TOKEN_FILE', 'refresh_token.txt');

echo "コールバック<br>";

var_dump($_GET);

// アプリケーションID, シークレッvト
$client_id     = YAHOO_APP_ID_TEST;
$client_secret = YAHOO_SECRET_TEST;
$redirect_uri = "https://local.yahoo-shopping-jp.com/callback.php";

// クレデンシャルインスタンス生成
$cred = new ClientCredential( $client_id, $client_secret );
// YConnectクライアントインスタンス生成
$client = new YConnectClient( $cred );

// デバッグ用ログ出力
$client->enableDebugMode();

try {

    /****************************
    Access Token Request
     ****************************/

    // Tokenエンドポイントにリクエスト
    $client->requestAccessToken(
        $redirect_uri,
        $_GET["code"]
    );

    echo "<h1>Access Token Request</h1>";
    // アクセストークン, リフレッシュトークン, IDトークンを取得
    echo "ACCESS TOKEN : " . $client->getAccessToken() . "<br/><br/>";
    echo "REFRESH TOKEN: " . $client->getRefreshToken() . "<br/><br/>";
    echo "EXPIRATION   : " . $client->getAccessTokenExpiration() . "<br/><br/>";

    file_put_contents(ACCESS_TOKEN_FILE, $client->getAccessToken());
    file_put_contents(REFRESH_TOKEN_FILE, $client->getRefreshToken());


//    /************************
//    UserInfo Request
//     ************************/
//
//    // UserInfoエンドポイントにリクエスト
//    $client->requestUserInfo( $client->getAccessToken() );
//    echo "<h1>UserInfo Request</h1>";
//    echo "UserInfo: <br/>";
//    // UserInfo情報を取得
//    echo "<pre>" . print_r( $client->getUserInfo(), true ) . "</pre>";


} catch ( \Exception $e ) {
    echo "<pre>" . print_r( $e, true ) . "</pre>";
}
