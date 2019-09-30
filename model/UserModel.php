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
        $users = array();

        $port = 3306;
        $servername = "127.0.0.1";
        $dbusername = "dnpyesqv";
        $dbpassword = "XhBS515uxx[8;J";
        $dbname = "dnpyesqv_users";

        $conn = new mysqli($servername, $dbusername, $dbpassword, $dbname, $port);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        } 
        
        $sql = "SELECT * FROM assignment2";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {

            while($row = $result->fetch_assoc()) {
                $obj2 = new stdClass();

                $obj2->username = $row["username"];
                $obj2->password = $row["password"];
                array_push($users, $obj2);
            }
        }
        $conn->close();

        return $users;
    }

    public function saveUser($username, $password) {
        $port = 3306;
        $servername = "127.0.0.1";
        $dbusername = "dnpyesqv";
        $dbpassword = "XhBS515uxx[8;J";
        $dbname = "dnpyesqv_users";

        $conn = new mysqli($servername, $dbusername, $dbpassword, $dbname, $port);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        } 

        $sql = "INSERT INTO assignment2 (username, password)
        VALUES ('$username', '$password')";

        $conn->close();
    }
}
