<?php
//yahooシッピーノアプリID・secret（webnotakumiで取得）
//define('YAHOO_APP_ID_TEST', 'dj0zaiZpPUZFNTFuUUQ3Q2piSSZzPWNvbnN1bWVyc2VjcmV0Jng9MWY-');//test
//define('YAHOO_SECRET_TEST', 'a71d10c84a7826c7f98aae379f4d33607dff4a87');//test


$contents  = file_get_contents('login_view.php');

$yahooSellerId = 'snbx-nxpqe5hm3';

//state リクエストとコールバック間の検証用のランダムな文字列
$viewParam['state'] = substr(str_shuffle('1234567890abcdefghijklmnopqrstuvwxyz'), 0, 10).'_'.time().'_'.substr(str_shuffle('1234567890abcdefghijklmnopqrstuvwxyz'), 0, 10);
//nonce リプレイアタック対策のランダムな文字列
$viewParam['nonce'] = substr(str_shuffle('1234567890abcdefghijklmnopqrstuvwxyz'), 0, 10).'_'.time().'_'.substr(str_shuffle('1234567890abcdefghijklmnopqrstuvwxyz'), 0, 10);

foreach($viewParam as $key => $val){
    $contents = str_replace('$'.$key, $val, $contents);
}

echo $contents;