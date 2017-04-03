<?php
require_once("vendor/autoload.php");


use YConnect\Credential\ClientCredential;
use YConnect\YConnectClient;

//yahooシッピーノアプリID（webnotakumiで取得）
define('YAHOO_APP_ID_TEST', 'dj0zaiZpPUZFNTFuUUQ3Q2piSSZzPWNvbnN1bWVyc2VjcmV0Jng9MWY-');//test
define('YAHOO_SECRET_TEST', 'a71d10c84a7826c7f98aae379f4d33607dff4a87');//test

define('ACCESS_TOKEN_FILE', 'access_token.txt');
define('REFRESH_TOKEN_FILE', 'refresh_token.txt');

echo "リフレッシュ<br>";


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

    $refresh_token = file_get_contents(REFRESH_TOKEN_FILE);

    // Tokenエンドポイントにリクエストしてアクセストークンを更新
    $client->refreshAccessToken( $refresh_token );
    echo "<h1>Refresh Access Token Request</h1>";
    echo "ACCESS TOKEN : " . $client->getAccessToken() . "<br/><br/>";
    echo "EXPIRATION   : " . $client->getAccessTokenExpiration();

    file_put_contents(ACCESS_TOKEN_FILE, $client->getAccessToken());


} catch ( TokenException $te ) {

    // リフレッシュトークンが有効期限切れであるかチェック
    if( $te->invalidGrant() ) {
        // はじめのAuthorizationエンドポイントリクエストからやり直してください
        echo "<h1>Refresh Token has Expired</h1>";
    }

    echo "<pre>" . print_r( $te, true ) . "</pre>";

} catch ( \Exception $e ) {
    echo "<pre>" . print_r( $e, true ) . "</pre>";
}
