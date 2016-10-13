<?php
class Cache {
  private $variables = array();
  private $mem;
  
  public function __construct() {
    $mem = new Memcached;
    $mem->addServer('192.168.33.12', '11211');
    $this->mem = $mem;
  }
  
  public static function set($name,$value) {
    $this->mem->set($name,$value);
  }
  public static function get($name) {
    $value = $this->mem->get($name);
    if ($value) {
      return $value;
    } else {
      return false;
    }
  }
  
  public static function del($name) {
    $this->mem->delete($name);
  }
  
  public static function flush() {
    $this->mem->flush();
  }
}