<?php

class UserModel
{
    public function usernameExists($username) {
        foreach ($this->fetchUsers() as $user) {         
            if ($user->username === $username) {
                return true;
            }
        }
        return false;
    }

    public function checkUsernameAndPassword($username, $password) {
        $user = null;
        $users = $this->fetchUsers();

        foreach ($users as $u) {
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
        $this->fetchUsers();
        if ($password === $passwordRepeat) {
            return true;
        }
        return false;
    }

    private function fetchUsers() {
        $json = file_get_contents('./data/users.json');
        $users = array();

        $json_data = json_decode($json, true);

        foreach ($json_data as $value) {
            $obj = new stdClass();

            $obj->username = $value["username"];
            $obj->password = $value["password"];

            array_push($users, $obj);
        }
        return $users;
    }

    public function saveUser($username, $password) {
        $userObj = new stdClass();
        $userObj->username = $username;
        $userObj->password = $password;

        $oldUsers = $this->fetchUsers();
        $newUsers = array();
        array_push($oldUsers, $userObj);

        $a = json_encode($oldUsers);

        file_put_contents('./data/users.json', $a);
    }
}
