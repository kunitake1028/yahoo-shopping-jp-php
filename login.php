<?php
require_once("defines.php");

$contents = file_get_contents('login_view.php');

$viewParam['client_id'] = YAHOO_APP_ID_TEST;
$viewParam['redirect_uri'] = 'https://local.yahoo-shopping-jp.com/callback.php';
//state リクエストとコールバック間の検証用のランダムな文字列
$viewParam['state'] = substr(str_shuffle('1234567890abcdefghijklmnopqrstuvwxyz'), 0, 10).'_'.time().'_'.substr(str_shuffle('1234567890abcdefghijklmnopqrstuvwxyz'), 0, 10);
//nonce リプレイアタック対策のランダムな文字列
$viewParam['nonce'] = substr(str_shuffle('1234567890abcdefghijklmnopqrstuvwxyz'), 0, 10).'_'.time().'_'.substr(str_shuffle('1234567890abcdefghijklmnopqrstuvwxyz'), 0, 10);
//viewに変数を埋め込む
foreach($viewParam as $key => $val){
    $contents = str_replace('{$'.$key.'}', $val, $contents);
}

echo $contents;