<?php

class StorageModel
{
    private static $isLoggedIn = 'StorageModel::IsLoggedIn';

    public function setLoggedInSession($status) {
        $_SESSION[self::$isLoggedIn] = $status;
    }

    public function isLoggedIn() {
        return $_SESSION[self::$isLoggedIn];
    }

    public function sessionIsSet() {
        if (isset($_SESSION[self::$isLoggedIn])) {
            return true;
        }
        return false;
    }
}
