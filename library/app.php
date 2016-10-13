<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/7/10
 * Time: 09:02
 */


class App {
    public static function init() {
		$mysql = new Db();
    }
    
    public static function run() {
	  	self::init();
	  	$m = isset($_GET['m']) ? $_GET['m'] : 'index';
	  	$q = isset($_GET['q']) ? $_GET['q'] : 'index';
	  	$controllerName = $m . 'Controller';
	  	$obj =  new $controllerName();
	  	$obj->$q();
    }
}