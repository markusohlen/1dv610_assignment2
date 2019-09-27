<?php


class LayoutView {
  
  public function render($renderView, LoginView $v, DateTimeView $dtv, RegisterView $rv, StorageModel $sm) {

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
              ' . $renderView->response() . '

              ' . $dtv->show() . '
          </div>
         </body>
      </html>
    ';
  }
  
  private function renderIsLoggedIn($sm) {
    if ($sm->isLoggedIn() === true) {
      return '<h2>Logged in</h2>';
    }
    else {
      return '<h2>Not logged in</h2>';
    }
  }
}
