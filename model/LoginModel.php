<?php

class LoginModel
{
    private $usernames = array();

    public function __construct() {
        $obj = new stdClass;
        $obj->username = "Admin";
        $obj->password = "Password";

        $obj2 = new stdClass;
        $obj2->username = "abc";
        $obj2->password = "123123";

        array_push($this->usernames, $obj, $obj2);
    }
    public function usernameExists($username) {
        foreach ($this->usernames as $user) {
            if ($user->username === $username) {
                return true;
            }
        }
        return false;
    }

    public function checkUsernameAndPassword($username, $password) {
        $user;
        foreach ($this->usernames as $u) {
            if ($u->username === $username) {
                $user = $u;
            }
        }

        if ($user->password === $password) {
            return true;
        }
        return false;
    }
}
