<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/7/10
 * Time: 08:11
 */
define('BLOG_ROOT',str_replace('\\','/',__DIR__).'/');
require_once('vendor/service.php');
//error_reporting(0);
$errorCorrectionLevel = 'L';//容错级别
$matrixPointSize = 6;//生成图片大小
$value = 'http://www.baidu.com'; //二维码内容
QRcode::png($value, 'qrcode.png', $errorCorrectionLevel, $matrixPointSize, 2);
App::run();


