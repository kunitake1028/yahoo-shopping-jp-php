<?php
require_once("vendor/autoload.php");
require_once("defines.php");

use YConnect\Credential\ClientCredential;
use YConnect\YConnectClient;


echo "コールバック<br>";

var_dump($_GET);

// アプリケーションID, シークレッvト
//$client_id     = YAHOO_APP_ID_TEST;
//$client_secret = YAHOO_SECRET_TEST;
$redirect_uri = "https://local.yahoo-shopping-jp.com/callback.php";

// クレデンシャルインスタンス生成
$cred = new ClientCredential( YAHOO_APP_ID_TEST, YAHOO_SECRET_TEST );
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

} catch ( \Exception $e ) {
    echo "<pre>" . print_r( $e, true ) . "</pre>";
}
