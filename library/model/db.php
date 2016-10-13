<?php
class Db extends Mysql{
  function fetchIds($ids) {
    $article = array();
    foreach ($ids as $id) {
      $article[] = $this->fetchOne($id);
    }
    return $article;
  }
}
