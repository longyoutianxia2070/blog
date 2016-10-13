<?php 
/*
 * 获取文章内容
 */
  class HomeNewsController 
  {
    private $obj;
    
    
    function __construct()
    {
      $obj =  new Db();
      $this->obj = $obj;
    }
    
    
    public function getFirstNews() 
    {
      $article = $this->obj->table('lytx_article')->orderBy('id desc')->limit(1)->fetch();
      return $article[0];
    }
    
    public function getFirstSixNews() {
      $article = $this->obj->table('lytx_article')->orderBy('id desc')->limit(6)->fetch();
      return $article;
    }
    
    public function getAllNews()
    {
      $article = $this->obj->table('lytx_article')->fetchAll();
      return $article;
    }
    
    public function getTopNews() 
    {
      $article = $this->obj->table('lytx_article')->orderBy('clicks desc')->limit(6)->fetch();
      return $article;
    }
    
    public function getNewsById($id) 
    {
      $article = $this->obj->table('lytx_article')->fetchOne($id);
      return $article;
    }
    
    public function getMostMesssageArticle()
    {
      $article = $this->obj->table('lytx_article')->orderBy('comments desc')->limit(3)->fetch();
      return $article;
    }
    
  }



