<?php

require_once __DIR__ . '/vendor/autoload.php';

use Shippinno\YahooShoppingJp\Client;
use Shippinno\YahooShoppingJp\Api\OrderCount;
use Shippinno\YahooShoppingJp\Api\Furigana;

define('YAHOO_APP_ID', 'dj0zaiZpPUZFNTFuUUQ3Q2piSSZzPWNvbnN1bWVyc2VjcmV0Jng9MWY-');
define('YAHOO_SECRET', 'a71d10c84a7826c7f98aae379f4d33607dff4a87');

$accessToken  = 'fIi7lRUYl6XlNkh9Ot_6rs1dOlhItNbUPaPckiubhpuI0PPgVA.89X36C67so7HlB4zJfS08qYjxGPxKpiHoo8OBN2JX64EceCkf6g7n1f11jQE2MFM92luTbZY7p9kom3TkW.UrTz_zfPNOtgG36WsOmeoveHF3JNrwlqKtA0s6dEIF6bfIIEdI3ISEAxoRwuosvRM1If1p6asLA3_wx9Xz1YGnq9v2fTN.gpFr5D48pUi_ajnU4tsnkvL9cQW4J1moQ7dklzE0PDojV0jBAcLa0BPi1cmjdEkt89XhdA7t6yWJf4aV67CIIFDtDGb8Q9uGie5BhvS0OkcotpVESOo9kTDGwU_F6M9jcNw.IteM9SH_aY91xVVuIIvl7AYFZKrrgCqfafnh6FReB1pm2KJ.pab5lK5h3_kGEz8tdpE00FVjRu0iZhNtpEdQUQa68PB8HYdPvwmwSsYXZFn6PkNkKMbfiKElDRAI62Ti9tLJeVAQrloVnBTOsFspKCRRjdDSEjbMqZIIVz4sUP._1Lbc8qD.7gng3pDF2l8rw3CAn7wJv2yDlKH7FjsEWXp7XmmIHlq4AaWRnlUW_bUeGo4rNQG3mPe6qwtydxuyNfVNL5t0bEcArLbs9ouTxpgxOkQc1YQ-';
$refreshToken = '';
$seller_id    = 'snbx-nxpqe5hm3';


$client = new Client($accessToken, $refreshToken);
$client->setApi(new OrderCount);

$response = $client->execute(['sellerId' => $seller_id], 'GET');

echo "\n";
var_dump($response);

$client->setApi(new Furigana);
$response = $client->execute(['sentence' => '明鏡止水']);

echo "\n";
var_dump($response);
