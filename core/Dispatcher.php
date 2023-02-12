<?php
class Dispatcher
{

  var $request;

  function __construct()
  {
    $this->request = new Request();
    // debug($this->request);
    Router::parse($this->request->url, $this->request);
    //print_r($this->request);
    //echo $this->request->url;
    $controller = $this->loadController();
    $action = $this->request->action;
    if ($this->request->prefix) {
      $action = $this->request->prefix . '_' . $action;
    }
    // if (!get_class_methods($controller)) {
    //   return $this->error('Le controlleur ' . $this->request->controller . ' n\'existe pas');
    // }
    if (!in_array($action, array_diff(get_class_methods($controller), get_class_methods('Controller')))) {
      // return $this->error('Le controlleur ' . $this->request->controller . ' n\'a pas de méthode ' . $action);
      return $this->error("Cette page n'existe pas");
    }

    call_user_func_array(array($controller, $action), $this->request->params);
    $controller->render($action);
  }

  function error($message)
  {
    $controller = new Controller($this->request);
    $controller->e404($message);
  }

  function loadController()
  {
    $name = ucfirst($this->request->controller . 'Controller');
    $file = ROOT . DS . 'controller' . DS . $name . '.php';
    if (!file_exists($file)) {
      // return $this->error('Le controlleur ' . $this->request->controller . ' n\'existe pas');
      return $this->error("Cette page n'existe pas");
    }
    require $file;
    $controller = new $name($this->request);

    return $controller;
  }
}
