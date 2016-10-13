<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/7/10
 * Time: 09:40
 */

class baseController {
  private $smarty;
  function __construct() {
    session_start();
    $smarty = new Smarty();
    $compile_dir = BLOG_ROOT . 'cache/template_c/';
    if (! file_exists($compile_dir)) {
      mkdir($compile_dir, 0777,true);
    }
    $smarty->registerPlugin('function', 'url', 'deal_url');
    $smarty->template_dir = BLOG_ROOT . 'tpl/';
    $smarty->compile_dir = $compile_dir;
    $this->smarty = $smarty;
  }
  public function display($path = NULL) {
    
    if ($path == NULL) {
      $className = get_class($this);
      $trace = debug_backtrace();
      $path = BLOG_ROOT . 'tpl/' . substr($className, 0, - 10) . '/' . $trace[1]['function'] . '.html';
    }
    $this->smarty->display($path);
  }
  public function assign($name, $value) {
    $this->smarty->assign('ee', BLOG_ROOT);
    $this->smarty->assign($name, $value);
  }
  
  public function verifyMail() {
    $mail = new PHPMailer();
    
    // $mail->SMTPDebug = 3; // Enable verbose debug output
    
    $mail->isSMTP();
    // Set mailer to use SMTP
    $mail->Host = 'smtp.163.com'; // Specify main and backup SMTP servers
    $mail->SMTPAuth = true; // Enable SMTP authentication
    $mail->Username = 'zhanglong2070@163.com'; // SMTP username
    $mail->Password = 'zl766744'; // SMTP password
    // $mail->SMTPSecure = 'ssl'; // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 25; // TCP port to connect to
    
    $mail->setFrom('zhanglong2070@163.com', 'Mailer');
    $mail->addAddress('654884112@qq.com', 'Joe User'); // Add a recipient
    $mail->addReplyTo('zhanglong2070@163.com', 'Information');
    
    $mail->isHTML(true); // Set email format to HTML
    
    $mail->Subject = 'Here is the subject';
    $mail->Body = 'This is the HTML message body <b>in bold!</b>';
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
    
    if (! $mail->send()) {
      echo 'Message could not be sent.';
      echo 'Mailer Error: ' . $mail->ErrorInfo;
    } else {
      echo 'Message has been sent';
    }
  }
}