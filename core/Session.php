<?php
class Session{
  public function __construct(){
    if (!isset($_SESSION)) {
      session_start();
    }  
  }

  public function setFlash($message, $type = 'success'){
    if(!isset($_SESSION['flash'])){
      $_SESSION['flash'] = array();
    }
    $_SESSION['flash'][0] = array(
      'message' => $message,
      'type' => $type
    );
  }

  public function addFlashMessage($message, $type = 'success'){
    if(!isset($_SESSION['flash'])){
      $_SESSION['flash'] = array();
    }
    $_SESSION['flash'][] = array(
      'message' => $message,
      'type' => $type
    );
  }

  public function flash(){
    if(isset($_SESSION['flash']) and is_array($_SESSION['flash']) and !empty($_SESSION['flash']) ){
      $html = '';
      foreach($_SESSION['flash'] as $flash){
        $html .= '<div class="alert alert-'.$flash['type'].'">';
        $html .= $flash['message'].'<br>';
        $html .= '</div>';
      }
      $_SESSION['flash'] = array();
      return $html;
    }
  }

  public function write($key, $value){
    $_SESSION[$key] = $value;
  }

  public function read($key = null){
    if($key){
      return isset($_SESSION[$key]) ? $_SESSION[$key] : null;
    }
    return $_SESSION;
  }

  public function delete($key){
    if(isset($_SESSION[$key])){
      unset($_SESSION[$key]);
    }
  }

  public function isLogged(){
    return isset($_SESSION['User']->ID);
  }

  public function user($key){
    if($this->isLogged()){
      return $_SESSION['User']->$key;
    }
    return false;
  }
}

?>