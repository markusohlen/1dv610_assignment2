<?php

class DatabaseModel
{
    public function fetchUserLoginData($username) {
        $servername = "localhost";
        $dbUsername = "root";
        $dbPassword = "";
        $dbname = "1dv610";

        $db = new PDO('mysql:host=127.0.0.1;dbname=1dv610;charset=utf8','root','');

        $stmt = $db->prepare("SELECT * FROM assignment2 WHERE username = ?");

        $stmt->bindParam(1, $username);

        $stmt->execute();

        $result=$stmt->fetch(PDO::FETCH_ASSOC);

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
