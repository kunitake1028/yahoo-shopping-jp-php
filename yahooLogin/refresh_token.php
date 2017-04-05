<?php
require_once("../vendor/autoload.php");
require_once("defines.php");

use YConnect\Credential\ClientCredential;
use YConnect\Exception\TokenException;
use YConnect\YConnectClient;

echo "リフレッシュ<br>";


// クレデンシャルインスタンス生成
$cred = new ClientCredential(YAHOO_APP_ID_TEST, YAHOO_SECRET_TEST );
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
