<?php
//TODO: пока костыльный способ побороть CORS. Потом изыскать средства самого фреймворка
$arrAllowedOrigin = [
    'http://cors.front1.local.su',
    'http://alex-team.ru',
    'https://alex-team.ru',
    'http://localhost',
    'https://localhost',
];
if (in_array($_SERVER['HTTP_ORIGIN'], $arrAllowedOrigin)) {
    header('Access-Control-Allow-Origin: ' . $_SERVER['HTTP_ORIGIN']);
}
header('Access-Control-Allow-Headers: ' . $_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']);
header('Access-Control-Allow-Methods: PATCH PUT DELETE OPTIONS');
header('Access-Control-Allow-Credentials: true');
header('Access-Control-Max-Age: 600');


// comment out the following two lines when deployed to production
defined('YII_DEBUG') or define('YII_DEBUG', true);
defined('YII_ENV') or define('YII_ENV', 'dev');

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../vendor/yiisoft/yii2/Yii.php';

$config = require __DIR__ . '/../config/web.php';

(new yii\web\Application($config))->run();
