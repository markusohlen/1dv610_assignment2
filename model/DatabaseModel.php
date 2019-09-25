<?php

class DatabaseModel
{
    public function fetchUserLoginData($username) {
        
        return $result;
    }

    public function userExists($username) {
        $result = $this->fetchUserLoginData($username);
        if ($result) {
            return true;
        }
        else {
            return false;
        }
    }

    public function comparePasswords($hash, $currentPassword) {
        if (password_verify($currentPassword, $hash)) {
            return true;
        } else {
            return false;
        }
    }
}
