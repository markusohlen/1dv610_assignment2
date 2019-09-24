<?php

class LoginController
{
    private $view;
    private $model;

    private $username;
    private $password;

    public function __construct(LoginView $view, LoginModel $model) {
        $this->view = $view;
        $this->model = $model;
    }

    public function login() {
        if ($this->view->userFilledInForm() === true) {
            $this->username = $this->view->getRequestUsername();
            $this->password = $this->view->getRequestPassword();
        }

        var_dump($this);

        if ($this->model->userExists($this->username) === true) {

        }
        // if ($this->model->usernameIsValid($this->username) === true && $this->model->passwordsIsValid($this->password, $this->passwordRepeat) === true) {
        //     $this->model->registerUser($this->username, $this->password);
        // }
        // $this->model->usernameIsValid($this->username);
        // $this->model->passwordsIsValid($this->password, $this->passwordRepeat);
    }
}
