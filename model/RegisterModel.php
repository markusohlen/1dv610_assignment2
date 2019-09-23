<?php

class RegisterModel {
    public function usernameIsValid ($username) {
        // $whitelist = '/[a-zA-Z]\d/';

        // return preg_match($whitelist, '', $username);
        echo $username;
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
        // echo password_hash($password, PASSWORD_DEFAULT);
    }

    public function registerUser ($userName, $password) {
        $servername = "localhost";
        $dbUsername = "root";
        $dbPassword = "";
        $dbname = "1dv610";

        $conn = new mysqli($servername, $dbUsername, $dbPassword, $dbname);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO assignment2 (username, password)
        VALUES ('$userName', '$hashedPassword')";

        if ($conn->query($sql) === TRUE) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        $conn->close();
    }
}