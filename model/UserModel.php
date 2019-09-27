<?php

class UserModel
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
        $user = null;
        foreach ($this->usernames as $u) {
            if ($u->username === $username) {
                $user = $u;
            }
        }

        if ($user === null) {
            return false;
        }

        if ($user->password === $password) {
            return true;
        }
        return false;
    }

    public function passwordsMatch($password, $passwordRepeat) {
        if ($password === $passwordRepeat) {
            return true;
        }
        return false;
    }

    public function saveUser($username, $password) {
        $userObj = new stdClass();
        $userObj->username = $username;
        $userObj->password = $password;
        array_push($this->usernames, $userObj);
    }
}
