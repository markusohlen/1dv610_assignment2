<?php

class RegisterController
{
    private $view;
    private $model;

    private $username;
    private $password;
    private $passwordRepeat;

    public function __construct(RegisterView $view, RegisterModel $model) {
        $this->view = $view;
        $this->model = $model;
    }

    public function register() {
        if ($this->view->personRegistered() === true) {
            $this->username = $this->view->getRequestUsername();
            $this->password = $this->view->getRequestPassword();
            $this->passwordRepeat = $this->view->getRequestPasswordRepeat();
        }

        if ($this->model->usernameIsValid($this->username) === true && $this->model->passwordsIsValid($this->password, $this->passwordRepeat) === true) {
            $this->model->registerUser($this->username, $this->password);
        }
        // $this->model->usernameIsValid($this->username);
        // $this->model->passwordsIsValid($this->password, $this->passwordRepeat);
    }
}
