<?php
class File {
  
  private $maxSize ;
  private $savePath;
  private $ext = array('jpg','jpeg','png','gif');
  private $error = array();
  
  private function setError($arg,$key) {
    switch ($arg) {
      case 0:
      break;
      case 1:
        $this->error[$key] = '上传的文件超过了 php.ini 中 upload_max_filesize 选项限制的值';
      break;
      case 2:
        $this->error[$key] = '上传文件的大小超过了 HTML 表单中 MAX_FILE_SIZE 选项指定的值';
      break;
      case 3:
        $this->error[$key] = '文件只有部分被上传';
      break;
      case 4:
        $this->error[$key] = '没有文件被上传';
      break;
      case 6:
        $this->error[$key] = '找不到临时文件夹';
      break;
      case 7:
        $this->error[$key] = '文件写入失败';
      break;
      case 9:
        $this->error[$key] = '超过设置文件尺寸';
      break;
      case 10:
        $this->error[$key] = '图片格式不对';
      break;
      default:
        $this->error[$key] = '未知错误';
      break;
    }
    return $this;
  }

  private function getExt($file) {
    $ext = substr($file, strrpos($file, '/')+1) ;
    return $ext;
  }
  
  private function checkUploadFile($items) {
    $flag = TRUE;
    $key = count($this->error);
    if ($items['error'] != 0) {
      $this->setError($items['error'], $key);
      $key++;
      $flag = FALSE;
    }
    
    if(!$this->maxSize) {
      $this->maxSize = $this->setFileSize();
    }
    if ($items['size'] > $this->maxSize) {
      $this->setError(9, $key);
      $key++;
      $flag = FALSE;
    } 
    $ext = $this->getExt($items['type']);
    if (!in_array($ext, $this->ext,true)) {
      $this->setError(10, $key);
      $flag = FALSE;
    }
    return $flag;
  }
  
  private function dealUploadFile () {
    $files = $_FILES;
    $uploadFiles = array();
    if(reset($files) == end($files)) {
      foreach ($files as $key=>$items) {
        if (!is_array($items['name'])) {
          $uploadFiles[0] = $items;
        } else {
          foreach ($items['name'] as $k=>$item) {
            $uploadFiles[$k]['name'] = $items['name'][$k];
            $uploadFiles[$k]['size'] = $items['size'][$k];
            $uploadFiles[$k]['type'] = $items['type'][$k];
            $uploadFiles[$k]['tmp_name'] = $items['tmp_name'][$k];
            $uploadFiles[$k]['error'] = $items['error'][$k];
          }
        }
      }
    } else {
      foreach ($files as $key=>$items) {
        $uploadFiles[] = $items;
      }
      
    }
    return $uploadFiles;
  }

  public function setFileSize($size = '') {
    if (empty($size)) {
      $maxSize = ini_get('post_max_size');
      $this->maxSize = ( int )$maxSize * 1000000;
    } else {
      $this->maxSize = $size;
    }
    return $this->maxSize;
  }
  
  public function setSavePath($filePath = '') {
    if (empty($filePath)) {
      $this->savePath ='upload/';
    } else {
      $this->savePath = $filePath;
    }
    return $this->savePath;
  }
  
  public function upload() {
    $imagePath = array();
    $files = $this->dealUploadFile();
    foreach ($files as $key=>$items) {
      if (!$items["name"]) {
        continue;
      }
      $flag = $this->checkUploadFile($items);
      if ($flag) {
        $tmpPath = $items['tmp_name'];
        $ext = $this->getExt($items['type']);
        if (!isset($this->savePath)) {
          $savePath = $this->setSavePath();
        }
        $savePath = $this->savePath.time().'.'.$ext;
        $bool = move_uploaded_file($tmpPath, $savePath);
        if ($bool) {
          $imagePath[] = $savePath;
        } else {
          $this->setError(11, $key);
        }
      } else {
        continue;
      }
    }
    return $imagePath;
  } 
  
  public function getUploadInfo () {
    $info = '';
    if (empty($this->error)) {
      $info = '上传成功！';
    } else {
      foreach ($this->error as $key=>$value) {
        $key++;
        $info .= '第'.$key.'张图片上传失败,错误是：'.$value.';<br/>';
      }
    }
    return $info;
  }
  
}
