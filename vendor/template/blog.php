<?php
class Blog {
  public $left_delimiter = '{';
  public $right_delimiter = '}';
  public $template_dir = '';
  public $variables = array();
  public function Left_delimiter($arg) {
    $this->left_delimiter = $arg;
    return $this;
  }
  
  public function Right_delimiter($arg) {
    $this->right_delimiter = $arg;
    return $this;
  }
  
  public function setTemplateDir($arg) {
    $this->template_dir = $arg;
    return $this;
  }
  
  public function assign($name,$value) {
    $this->variables[$name] = $value;
    return $this;
  }
  
  private function getTemplate($filename) {
    $str = file_get_contents($filename);
    if ($this->variables) {
      foreach ($this->variables as $name=>$value) {
        if (is_string($value)) {
          $replace = "<?php echo $value; ?>";
          $str = preg_replace('/{$'.$name.'.*/', $replace, $str);
        }
      }
    }
    file_put_contents($filename, $str);
    return $this;
  }
  
  public function display($filename) {
    $this->getTemplate($filename);
  }
}

