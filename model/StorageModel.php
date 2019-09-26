<?php

class StorageModel
{
    private static $isLoggedIn = 'StorageModel::IsLoggedIn';

    public function setLoggedInSession($status) {
        $_SESSION['StorageModel::IsLoggedIn'] = $status;
        // $_SESSION[self::$isLoggedIn] = $status;
    }

    public function getLoggedInSession() {
        // return $_SESSION[self::$isLoggedIn];
        return $_SESSION['StorageModel::IsLoggedIn'];
    }

    public function isLoggedIn() {
        if ($this->getLoggedInSession() === true) {
            return true;
        }
        return false;
    }

    public function sessionIsSet() {
        // if (isset($_SESSION[self::$isLoggedIn])) {
        //     return true;
        // }
        if (isset($_SESSION['StorageModel::IsLoggedIn'])) {
            return true;
        }
        return false;
    }
}
