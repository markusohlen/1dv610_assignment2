<?php

class RegisterController
{
    private $view;
    private $model;
    private $userModel;

    private $username;
    private $password;
    private $passwordRepeat;

    public function __construct(RegisterView $view, RegisterModel $model, $userModel) {
        $this->view = $view;
        $this->model = $model;
        $this->userModel = $userModel;
    }

    public function register() {
        if ($this->view->personRegistered() === true) {
            $this->username = $this->view->getRequestUsername();
            $this->password = $this->view->getRequestPassword();
            $this->passwordRepeat = $this->view->getRequestPasswordRepeat();
        }

        $message = $this->generateMessage();
        $this->view->setMessage($message);

       if (!$message === '') {
           return;
       }

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

        if ($this->model->passwordsIsTooShort($this->password, $this->passwordRepeat)) {
            $message .= "Password has too few characters, at least 6 characters.<br>";
        }

        if ($this->userModel->usernameExists($this->username)) {
            $message .= "User exists, pick another username.<br>";
        }

        if (!$this->userModel->passwordsMatch($this->password, $this->passwordRepeat)) {
            $message .= "Passwords do not match.";
        }

        return $message;
    }
}
