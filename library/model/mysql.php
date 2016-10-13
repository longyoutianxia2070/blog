<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/7/10
 * Time: 08:31
 */
class Mysql {
  private $dbAdrr;
  private $dbUser;
  private $dbPass;
  private $dbName;
  private $link;
  private $table;
  private $sql;
  private $error = array();
  private $conditions = array ();
  private $char = 'and';
  private $fields = '*';
  private $linkError;
  private $where;
  const FETCH_ASSOC = PDO::FETCH_ASSOC;
  const FETCH_ROWS = PDO::FETCH_NUM;
  const FETCH_OBJ = PDO::FETCH_OBJ;
  
  function __construct() {
    //ini_set('display_errors', 0);
    $config = include 'config/config.php';
    $keysArr = array_map('strtolower', array_keys($config));
    $config = array_combine($keysArr, $config);
    $this->dbAdrr = $config['host_adrr'];
    $this->dbUser = $config['db_user'];
    $this->dbPass = $config['db_pass'];
    $this->dbName = $config['db_name'];
    try {
      $link = new PDO('mysql:host='.$config['host_adrr'].'; dbname='.$config['db_name'], $config['db_user'], $config['db_pass']);
      $link->exec("set names utf8");
      $this->link = $link;
    } catch (Exception $e) {
      $this->linkError = $e->getMessage();
    }
  }
  
  private function prepareField($data) {
    $data = $this->data($data);
    $link =  $this->link;
    $str = '';
    foreach ( $data as $key => $item ) {
      $str .= ",$key = ?";
    }
    $str = substr($str, 1);
    return $str;
  }
  
  private function getConditions() {
    $condition = $this->conditions;
    if (empty($condition)) {
      $this->error['update']= '禁止无条件更新';
      return false;
    } else {
      $where = ' where ';
      foreach ($condition as $items) {
        $where .= $items . 'and';
      }
      $where = substr($where, 0,-3);
    }
    return $where;
  }
  
  private function data($data) {
    $data = filter($data);
    $fields = $this->getAllFields();
    foreach ($data as $key=>$value) {
      if (in_array($key, $fields)) {
        continue;
      } else {
        unset($data[$key]);
      }
    }
    return $data;
  }
  
  private function getAllFields() {
    $result = $this->query("desc $this->table");//table_name 换成你对应的表名
    $column=array();
    foreach ($result as $item) {
      $column[]=$item['Field'];
    }
    return $column;
  }
  
  public function table($tableName, $alias = '') {
    $this->table = $tableName;
    return $this;
  }
  
  public function query($sql) {
    $query = $this->link;
    return $query->query($sql);
  }
  
  public function getLastSql() {
    return $this->sql;
  }
  
  public function insert($data) {
    $str = $this->prepareField($data);
    $sql = "insert {$this->table} set $str;";
    try {
      $stmt = $this->link->prepare($sql);
      $stmt->execute(array_values($data));
      return $this->link->lastInsertId() ;
    } catch (Exception $e) {
      $this->sql = $sql;
      return false;
    }
  }
  
  public function update($data) {
    $str = $this->prepareField($data);
    
    $where = $this->getConditions();
    
    if (!$where) {
      return false;
    } else {
      $sql = "update {$this->table} set $str $where;";
      $stmt = $this->link->prepare($sql);
      $stmt->execute(array_values($data));
      return $stmt->rowcount() ;
    }
  }
  
  public function delete() {
    $where = $this->getConditions();
    
    if (!$where) {
      return false;
    } else {
      $sql = "delete from $this->table $where;";
      $stmt = $this->link->prepare($sql);
      $stmt->execute();
    }
  }

  public function fetchOne($id,$data_type = self::FETCH_ASSOC) {
    $sql = "select $this->fields from $this->table where id =$id;";
    $stmt = $this->link->prepare($sql);
    $stmt->execute();
    return $stmt->fetch($data_type);
  }
  
  public function fetchAll($data_type = self::FETCH_ASSOC) {
    $sql = "select $this->fields from $this->table;";
    $stmt = $this->link->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll($data_type);
  }

  public function fetch($data_type = self::FETCH_ASSOC) {
    $where = $this->buildSql();
    unset($this->conditions);
    $sql = "select $this->fields from $this->table " .$where;
    $stmt = $this->link->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll($data_type);
  }
  
  public function buildSql() {
    $where = '';
    if (isset($this->conditions['where']))
    {
      $where .= ' where '.$this->conditions['where'];
    } 
    if (isset($this->conditions['group']))
    {
      $where .= ' group by '.$this->conditions['group'];
    } 
    if (isset($this->conditions['order']))
    {
      $where .= ' order by '.$this->conditions['order'];
    } 
    if (isset($this->conditions['limit']))
    {
      $where .= ' limit '.$this->conditions['limit'];
    } 
    return $where;
  }
  
  public function where($condition) {
    $this->conditions['where'] = $condition;
    return $this;
  }
  
  public function groupBy($group) {
    $this->conditions['group'] = $group;
    return $this;
  }
  
  public function orderBy($order) {
    $this->conditions['order'] = $order;
    return $this;
  }
  
  public function limit($offset,$start=0) {
    $limit = $start .',' .$offset;
    $this->conditions['limit'] = $limit;
    return $this;
  } 
  
  public function condition($field, $value, $operation = '=') {
    $this->conditions[] = " $field $operation '$value' ";
    return $this;
  }
  
  public function connector($char) {
    $this->char = $char;
    return $this;
  }
  
  
  public function field($fields = array()) {
    if ($fields) {
      $this->fields = join(',', $fields);
    } else {
      $this->fields = '*';
    }
    return $this;
  } 
}