<?php


class LayoutView {
  
  public function render(LoginView $v, DateTimeView $dtv, RegisterView $rv, StorageModel $sm) {
    // $isLoggedIn = $v->getLoggedIn();
    $view = (isset($_GET["register"]) ? $rv : $v);

    

    echo '<!DOCTYPE html>
      <html>
        <head>
          <meta charset="utf-8">
          <title>Login Example</title>
        </head>
        <body>
          <h1>Assignment 2</h1>
          ' . $this->renderIsLoggedIn($sm) . '
          <div class="container">
              ' . $view->response() . '

              ' . $dtv->show() . '
          </div>
         </body>
      </html>
    ';
  }
  
  private function renderIsLoggedIn($sm) {
    $isLoggedIn = $sm->isLoggedIn();
    // var_dump($_SESSION);
    if ($isLoggedIn === true && isset($_POST["LoginView::Login"])) {
      return '<h2>Logged in</h2>';
    }
    else {
      return '<h2>Not logged in</h2>';
    }
  }
}
