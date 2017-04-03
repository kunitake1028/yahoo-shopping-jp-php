<?php
require_once("vendor/autoload.php");
require_once("defines.php");


use YConnect\Credential\ClientCredential;
use YConnect\YConnectClient;


echo "ユーザ情報取得<br>";

// クレデンシャルインスタンス生成
$cred = new ClientCredential( YAHOO_APP_ID_TEST, YAHOO_SECRET_TEST );
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
