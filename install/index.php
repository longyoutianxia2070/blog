<?php 
$filename = "../data/lytx.sql";

if (!file_exists($filename)) {
  echo "数据库配置文件不存在！";
}
$mysql_config = fopen($filename, 'rb');

$sql = '';
try {
  $pdo = new PDO('mysql:host=localhost;dbname=blog','root','111111');
  while (!feof($mysql_config)) {
    $row = fgets($mysql_config);
    $sql .= $row;
    if (strpos($row, ';') !== false) {
      $pdo->query($sql);
      $sql = '';
    }
  }
  echo '安装成功,3秒后跳转！';
  header('refresh:3;url="../index.php"');
} catch (Exception $e) {
  echo $e->getMessage();
  exit;
}