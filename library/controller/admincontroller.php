<?php
class adminController extends baseController {
  
  public function index() {
    $this->display();
  }
  
  public function login() {
    $appID = "6f3e2619ff9d4cb79690cccb34eb638c";
    //授权码
    $authKey = "824bbcfc88ea4afd82ece2302354a5d3";
    //待验证手机号
    $pn = 15820067066;
    $version = "1.0";
    $url = "https://api.ciaapp.cn/{$version}/agent";
    $headerList = array("Host:api.ciaapp.cn",
      "Accept:application/json",
      "Content-Type:application/json;charset=utf-8",
      "appId:{$appID}",
      "authKey:{$authKey}",
      "pn:{$pn}"
    );
    $params = array('aa'=>1);
    //使用 cURL  的 POST 调用 api
    
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_TIMEOUT,100);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headerList);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    $returnData = curl_exec($ch);
    var_dump($returnData);exit;
    //对返回的 json 格式的字符串进行解析，并截取 authCode 后四位作为验证码
    $return = json_decode($returnData);
    $returnCode = $return->authCode;
    $code = substr($returnCode,-4);
    curl_close($ch);
    echo $code;
    exit;
    $this->display();
  }
  
  public function logout() {
    unset($_SESSION['user']);
    header('location:http://192.168.33.12:10086/index.php');
  }
  
  public function dealLogin() {
    $userName = $_POST['userName'];
    $pass = $_POST['pass'];
    $mysql = new Db();
    $userInfo = $mysql->table('lytx_user')->where("username='$userName' and password='$pass'")->fetch();
    
    if ($userInfo) {
      $_SESSION['user'] = $userInfo;
      $loginCount = $userInfo[0]['logincount']+1;
      
      $data = array(
        'lastlogin' => time(),
        'ip' => $_SERVER['REMOTE_ADDR'],
        'logincount' => $loginCount,
      );
      
      $mysql->table('lytx_user')->where("id = " .$userInfo[0]['id'])->update($data);
      
      header('location:http://192.168.33.12:10086/index.php?m=admin&q=index');
      
    } else {
      header('location:http://192.168.33.12:10086/index.php?m=admin&q=login');
    }
    
    var_dump($userInfo);exit;
  }
  
  public function addnew() {
    $url = deal_url('admin/addnew');
    $this->assign('url', $url);
    $this->display();
  }
  
  public function listnew() {
    $mysql = new Db();
    $listNews = $mysql->table('lytx_article')->fetchAll();
    $this->assign('listnews', $listNews);
    $this->display();
  }
  
  public function exportarticle() {
    if (isset($_POST['export'])) {
      
      $mysql = new Db();
      $articles = $mysql->table('lytx_article')->fetchIds($_POST['artileId']);
      
      $phpexcel = new PHPExcel();
      $output_execel_name = 'artcle.xls';
      $phpexcel->setActiveSheetIndex(0)->setCellValue('A1', '文章标题')->setCellValue('B1', '文章内容')->setCellValue('C1', '发布时间')->setCellValue('D1', '文章描述')->setCellValue('E1', '点击量');
      $i = 2;
      foreach ( $articles as $item ) {
        $phpexcel->setActiveSheetIndex(0)->setCellValue('A' . $i, $item['title'])->setCellValue('B' . $i, $item['content'])->setCellValue('C' . $i, $item['dateline'])->setCellValue('D' . $i, $item['description'])->setCellValue('E' . $i, $item['clicks']);
        $i ++;
      }
      $obj = PHPExcel_IOFactory::createWriter($phpexcel, 'Excel5');
      header("Pragma: public");
      header("Expires: 0");
      header("Cache-Control:must-revalidate, post-check=0, pre-check=0");
      header("Content-Type:application/force-download");
      header("Content-Type: application/vnd.ms-excel;");
      header("Content-Type:application/octet-stream");
      header("Content-Type:application/download");
      header("Content-Disposition:attachment;filename=" . $output_execel_name);
      header("Content-Transfer-Encoding:binary");
      $obj->save("php://output");
    } elseif (isset($_POST['delete'])) {
    
    } else {
    
    }
  }
  
  public function dealadd() {
    $file = new File();
    $imagePath = $file->upload();
    if (! $imagePath) {
      $imagePath = array (
        'upload/default.jpg' 
      );
    }
    $data = array (
      'title' => $_POST['title'],
      'content' => $_POST['content'],
      'imagepath' => reset($imagePath),
      'dateline' => time() 
    );
    $mysql = new Db();
    $aa = $mysql->table('lytx_article')->insert($data);
  }
}
