<?php

class StorageModel
{
    private static $isLoggedIn = 'StorageModel::IsLoggedIn';
    private static $cookieName = 'LoginView::CookieName';
	private static $cookiePassword = 'LoginView::CookiePassword';

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

    public function setKeepLoggedIn() {
        setcookie(self::$cookieName, true, time() + (86400 * 30), "/");
    }

    public function isCookieSet() {
        if (isset($_COOKIE[self::$cookieName])) {
            return true;
        }
        return false;
    }

    public function changeCookie() {
        setcookie(self::$cookieName, false, time() + (86400 * 30), "/");
    }
}
