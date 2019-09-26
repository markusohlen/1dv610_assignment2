<?php

class LoginController
{
    private $view;
    private $model;
    private $database;

    private $username;
    private $password;

    public function __construct(LoginView $view, LoginModel $model) {
        $this->view = $view;
        $this->model = $model;
    }

    public function login() {
        if ($this->view->userFilledInUsername() === true) {
            $this->username = $this->view->getRequestUsername();
            $this->password = $this->view->getRequestPassword();
        } 
        else {
            return; 
        }

        // var_dump($this->model->usernameExists($this->username));
        
        

        // DATABASE
        // if ($this->database->userExists($this->username) === true) {
        //     echo "USERNAME $this->username";
        //     $user = $this->database->fetchUserLoginData($this->username);
            
        //     $hash = $user["password"];
        //     // var_dump($hash);
        //     if ($this->database->comparePasswords($hash, $this->password) === true) {
        //         echo "PASSWORDS MATCH!";
        //     }
        //     else {
        //         echo "PASSWORDS DONT MATCH!";
        //     }
            
        // }
        // if ($this->model->usernameIsValid($this->username) === true && $this->model->passwordsIsValid($this->password, $this->passwordRepeat) === true) {
        //     $this->model->registerUser($this->username, $this->password);
        // }
        // $this->model->usernameIsValid($this->username);
        // $this->model->passwordsIsValid($this->password, $this->passwordRepeat);
    }
}
