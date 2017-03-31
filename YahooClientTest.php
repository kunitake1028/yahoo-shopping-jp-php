<?php

require_once __DIR__ . '/vendor/autoload.php';

use Shippinno\YahooShoppingJp\Client;
use Shippinno\YahooShoppingJp\Api\OrderCount;

define('YAHOO_APP_ID', 'dj0zaiZpPUZFNTFuUUQ3Q2piSSZzPWNvbnN1bWVyc2VjcmV0Jng9MWY-');
define('YAHOO_SECRET', 'a71d10c84a7826c7f98aae379f4d33607dff4a87');

$accessToken  = 'VPKdeik1obQySJa1g5iOS4bAyUSxLoccRF6gUseT5EPgqyYOrnbZVUxjrnZ45OeszUlp2mPtpDBAv2P1CGzhpzbqvWGjPw.BC0p_FBlwu3kXkrUxEFMoaFtHiU4AOwo4qmG2acQi5tz7HAyuUOQbFG_ZQz.StN86BvFAQEMJR_1Nx0pOE7Eih79JgtSUMdx6LOsrQlF_gGAsVDWk.nNKDitNtki.kDAOilypVD4n4xhXnGNWxrSGR_EzpACoA02zjGGInFu95_RMHvDVET7ZRWc8O_pOq1vs4mA.T_W.6KT_FlFKK9JIWMD9.ckjaEtUHnwqX0tPFEYp8dOURwsB.yss_PmBj20OsrIt9fB9g7MLdlSENSfgEaaE415nLTp.QMEslIL_Y86YHTApIddwlDfBBqbk1S1XlHIVn.8NZCJO2IT_0IHK29bxORbPpNHTU18yAEBAxdvO_bj1xUlWZZiwiCcH.65Acv9GiAFV4lIuGcg4gE0vTyaP3l2Dcm8HhqrizBUGklcDVbhVRg8tXA1i0pPude9ZtRunrVRUtmcmLthMWpwb84JdHgcT3.q7zViyzdwTL3kkPbyYf.BZIpBERCfclNxMd4t28z_dkkA1cNAfdjR.X2KIQrmaiaifC7vqppU-';
$refreshToken = '';
$seller_id    = 'snbx-nxpqe5hm3';


$client = new Client($accessToken, $refreshToken);
$client->setApi(new OrderCount);

$response = $client->execute(['sellerId' => $seller_id], 'GET');

echo "\n";
var_dump($response);

$client->setDebug(true);
$response = $client->execute(['sellerId' => $seller_id], 'GET');

echo "\n";
echo "\n";
echo "\n";
var_dump($response);
