<?php

require_once("../vendor/autoload.php");
require_once("defines.php");

use YConnect\Constant\OIDConnectDisplay;
use YConnect\Constant\OIDConnectPrompt;
use YConnect\Constant\OIDConnectScope;
use YConnect\Constant\ResponseType;
use YConnect\Credential\ClientCredential;
use YConnect\YConnectClient;

//ログインボタン表示する場合
if(0){

    $contents = file_get_contents('login_view.php');

    $param['client_id'] = YAHOO_APP_ID_TEST;
    $param['redirect_uri'] = str_replace('login.php','callback.php','https://'.$_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"]);
    //state リクエストとコールバック間の検証用のランダムな文字列
    $param['state'] = substr(str_shuffle('1234567890abcdefghijklmnopqrstuvwxyz'), 0, 10).'_'.time().'_'.substr(str_shuffle('1234567890abcdefghijklmnopqrstuvwxyz'), 0, 10);
    //nonce リプレイアタック対策のランダムな文字列
    $param['nonce'] = substr(str_shuffle('1234567890abcdefghijklmnopqrstuvwxyz'), 0, 10).'_'.time().'_'.substr(str_shuffle('1234567890abcdefghijklmnopqrstuvwxyz'), 0, 10);
    //viewに変数を埋め込む
    foreach($param as $key => $val){
        $contents = str_replace('{$'.$key.'}', $val, $contents);
    }

    echo $contents;

}else{
    //js使用しない場合

    // クレデンシャルインスタンス生成
    $cred = new ClientCredential(YAHOO_APP_ID_TEST, YAHOO_SECRET_TEST );
    // YConnectクライアントインスタンス生成
    $client = new YConnectClient( $cred );

    // デバッグ用ログ出力
    $client->enableDebugMode();

        try {

            $param['redirect_uri'] = str_replace('login.php','callback.php','https://'.$_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"]);
            //state リクエストとコールバック間の検証用のランダムな文字列
            $param['state'] = substr(str_shuffle('1234567890abcdefghijklmnopqrstuvwxyz'), 0, 10).'_'.time().'_'.substr(str_shuffle('1234567890abcdefghijklmnopqrstuvwxyz'), 0, 10);
            //nonce リプレイアタック対策のランダムな文字列
            $param['nonce'] = substr(str_shuffle('1234567890abcdefghijklmnopqrstuvwxyz'), 0, 10).'_'.time().'_'.substr(str_shuffle('1234567890abcdefghijklmnopqrstuvwxyz'), 0, 10);
            $param['response_type'] = ResponseType::CODE_IDTOKEN;
            $param['scope'] = array(
                OIDConnectScope::OPENID,
                OIDConnectScope::PROFILE,
                OIDConnectScope::EMAIL,
                OIDConnectScope::ADDRESS
            );
            $param['display'] = OIDConnectDisplay::DEFAULT_DISPLAY;
            $param['prompt'] = array(
                OIDConnectPrompt::DEFAULT_PROMPT
            );


            // Authorizationエンドポイントにリクエスト
            $client->requestAuth(
                $param['redirect_uri'],
                $param['state'],
                $param['nonce'],
                $param['response_type'],
                $param['scope'],
                $param['display'],
                $param['prompt']
            );

        } catch ( \Exception $e ) {
            echo "<pre>" . print_r( $e, true ) . "</pre>";
        }
}