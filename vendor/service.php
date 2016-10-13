<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/7/10
 * Time: 09:06
 */
require_once(BLOG_ROOT.'library/common/Constant.php');
require_once(BLOG_ROOT.'library/common/functions.php');
require_once(BLOG_ROOT.'vendor/smarty/libs/Smarty.class.php');
require_once(BLOG_ROOT.'library/app.php');
require_once(BLOG_ROOT.'library/cache.php');
require_once(BLOG_ROOT.'library/file.php');
require_once(BLOG_ROOT.'vendor/phpqrcode/phpqrcode.php');
require_once(BLOG_ROOT.'vendor/template/blog.php');
require_once(BLOG_ROOT.'vendor/PHPExcel-1.8/Classes/PHPExcel.php');
require_once(BLOG_ROOT.'vendor/PHPWord-develop/bootstrap.php');
require_once(BLOG_ROOT.'vendor/PHPMailer/PHPMailerAutoload.php');
function auto_load($className) {
	$className = strtolower($className);
	$modelfile = BLOG_ROOT.'library/model/'.$className . '.php';
	$controllerfile = BLOG_ROOT.'library/controller/'.$className . '.php';
	if(file_exists($modelfile)) {
		include($modelfile);
	} elseif (file_exists($controllerfile)) {
		include($controllerfile);
	}
}
function show_error() {
	
}

function write_data() {
	if (file_exists('data/lytx.sql')) {
		
	} else {
		echo '数据不存在';
	}
}

function deal_url($url) {
  if (is_array($url)) {
    $url = $url['arg'];
  }
  $urlArr = explode('/', $url);
  $urlPath ='';
  foreach ($urlArr as $key=>$item) {
    if ($key == 0) {
      $urlPath .= 'index.php?m='.$item;
      continue;
    } elseif($key == 1) {
      $urlPath .= '&q='.$item;
      continue;
    } elseif($key % 2 == 0) {
      $urlPath .= "&$item=";
    } else {
      $urlPath .= $item;
    }
  }
  return $urlPath;
}

 function filter($arr) {
  $arr = is_array($arr) ? $arr :array($arr);
  $arr = array_map('addslashes', $arr);
  $arr = array_map('htmlspecialchars', $arr);
  return $arr;
 } 

spl_autoload_register('auto_load');