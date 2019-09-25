<?php

class LoginModel
{
    public function userExists($username) {
        $servername = "localhost";
        $dbUsername = "root";
        $dbPassword = "";
        $dbname = "1dv610";


        $db = new PDO('mysql:host=localhost;dbname=1dv610;charset=utf8','root','');

        $stmt = $db->prepare("SELECT * FROM assignment2 WHERE username = ?");

        $stmt->bindParam(1, $username);

        $stmt->execute();

        $result=$stmt->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            echo "INLOGGAD!!!!!!!!!!!!!!!!!!!!!!!!!!!";
            return true;
        }
        else {
            return false;
        }

        // $stmt = $db->query("SELECT * 
        //     FROM assignment2
        //     WHERE username = $username");

        // while ($row=$stmt->fetch(PDO::FETCH_ASSOC)){
        //     //echo htmlentities($row['firstname']) . " " . htmlentities($row['lastname']) . " " . htmlentities($row['postcode']) . " " ."<br />";
        //     echo "<pre>" . var_dump($row) . "</pre>";
        // }

        // if ($conn->query($sql) === TRUE) {
        //     echo "New record created successfully";
        // } else {
        //     echo "Error: " . $sql . "<br>" . $conn->error;
        // }

        // $db->close();
    }
}
