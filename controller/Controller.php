<?php

class Controller
{
    private $registerView;
    private $registerModel;

    private $username;
    private $password;
    private $passwordRepeat;

    public function __construct(RegisterView $registerView) {
        $this->registerView = $registerView;
        // $this->registerModel = $registerModel;
    }

    public function register() {
        if ($this->registerView->personRegistered() === true) {
            $this->userName = $this->registerView->getRequestUsername();
            $this->password = $this->registerView->getRequestPassword();
            $this->passwordRepeat = $this->registerView->getRequestPasswordRepeat();
        }
    }
}
