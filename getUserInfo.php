<?php
require_once("vendor/autoload.php");


use YConnect\Credential\ClientCredential;
use YConnect\YConnectClient;

//yahooシッピーノアプリID（webnotakumiで取得）
define('YAHOO_APP_ID_TEST', 'dj0zaiZpPUZFNTFuUUQ3Q2piSSZzPWNvbnN1bWVyc2VjcmV0Jng9MWY-');//test
define('YAHOO_SECRET_TEST', 'a71d10c84a7826c7f98aae379f4d33607dff4a87');//test

define('ACCESS_TOKEN_FILE', 'access_token.txt');

echo "ユーザ情報取得<br>";


// アプリケーションID, シークレッvト
$client_id     = YAHOO_APP_ID_TEST;
$client_secret = YAHOO_SECRET_TEST;

// クレデンシャルインスタンス生成
$cred = new ClientCredential( $client_id, $client_secret );
// YConnectクライアントインスタンス生成
$client = new YConnectClient( $cred );

// デバッグ用ログ出力
$client->enableDebugMode();

try {

    $access_token = file_get_contents(ACCESS_TOKEN_FILE);

    // UserInfoエンドポイントにリクエスト
    $client->requestUserInfo($access_token);
    echo "<h1>UserInfo Request</h1>";
    echo "UserInfo: <br/>";
    // UserInfo情報を取得
    echo "<pre>" . print_r( $client->getUserInfo(), true ) . "</pre>";

} catch ( \Exception $e ) {
    echo "<pre>" . print_r( $e, true ) . "</pre>";
}
