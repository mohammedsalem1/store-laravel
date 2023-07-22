<?php
class autoloader {
  public function register($classname) {
    include __DIR__ . "/" . $classname . '.php';
  }
}
$a = new autoloader();
spl_autoload_register([$a , 'register']);
