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

        $message = $this->generateMessage();
        $this->view->setMessage($message);

       

        if ($this->model->usernameIsValid($this->username) === true && $this->model->passwordsIsValid($this->password, $this->passwordRepeat) === true) {
            $this->model->registerUser($this->username, $this->password);
            
            
        }
        // $this->model->usernameIsValid($this->username);
        // $this->model->passwordsIsValid($this->password, $this->passwordRepeat);
    }

    private function generateMessage() {
        $message = '';

        if (!$this->model->usernameIsValid($this->username)) {
            $message .= "Username has too few characters, at least 3 characters.<br>";
        }

        if (!$this->model->passwordsIsTooShort($this->password, $this->passwordRepeat)) {
            $message .= "Password has too few characters, at least 6 characters.<br>";
        }

        return $message;
    }
}
