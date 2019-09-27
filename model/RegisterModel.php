<?php

class RegisterModel {
    private $userModel;

    public function __construct(UserModel $um) {
        $this->userModel = $um;
    }
    public function usernameIsValid ($username) {
        if (strlen($username) > 3) {
            return true;
        } 
        else {
            return false;
        }
    }

    public function passwordsIsValid ($password, $passwordRepeat) {
        if (strlen($password) >=6 && $password === $passwordRepeat) {
            return true;
        }
        else {
            return false;
        }
    }

    public function passwordsIsTooShort ($password, $passwordRepeat) {
        if (strlen($password) < 6 || strlen($passwordRepeat) < 6) {
            echo "PXD är minder än 6";
            return true;
        }
        else {
            echo "PXD är större än 6";
            return false;
        }
    }

    public function registerUser ($username, $password) {
        $this->userModel->saveUser($username, $password);
    }
}