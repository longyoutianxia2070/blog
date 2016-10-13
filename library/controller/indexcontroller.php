<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/7/10
 * Time: 09:40
 */

class indexController extends baseController {

	public function index() 
	{
	  /* $indexinfo = Cache::get('indexinfo');
	  if (!$indexinfo) {
	    $indexinfo = 'ds';
	  } */
	  $article =new HomeNewsController();
	  if (isset($_SESSION['user'])) {
	    $user = $_SESSION['user'];
	  } else {
	    $user = '';
	  }
	  $firstArticle = $article->getFirstNews();
	  $firstSixArticle = $article->getFirstSixNews();
	  $messageArticle = $article->getMostMesssageArticle();
	  $topArticle = $article->getTopNews();
	  $this->assign('firstArticle', $firstArticle);
	  $this->assign('messageArticle', $messageArticle);
	  $this->assign('topArticle', $topArticle);
	  $this->assign('user', $user);
	  $this->assign('firstFourArticle', $firstSixArticle);
		$this->display();
	}
	
	public function detail()
	{
	  $article =new HomeNewsController();
	  $id = $_GET['id'];
	  $firstArticle = $article->getNewsById($id);
	  $firstSixArticle = $article->getFirstSixNews();
	  $topArticle = $article->getTopNews();
	  $messageArticle = $article->getMostMesssageArticle();
	  $this->assign('firstArticle', $firstArticle);
	  $this->assign('topArticle', $topArticle);
	  $this->assign('messageArticle', $messageArticle);
	  $this->assign('firstFourArticle', $firstSixArticle);
	  $this->display();
	}
	public function serachByTitle()
	{
	  $title = $_POST['title'];
	  $obj =  new Db();
	  
	  echo $title;
	}
}