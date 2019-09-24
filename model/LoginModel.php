<?php

class LoginModel
{
    public function userExists($username) {
        $servername = "localhost";
        $dbUsername = "root";
        $dbPassword = "";
        $dbname = "1dv610";

        $conn = new mysqli($servername, $dbUsername, $dbPassword, $dbname);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "SELECT * 
            FROM assignment2
            WHERE username = arakasaga78";

        if ($conn->query($sql) === TRUE) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        var_dump($sql);

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

        $conn->close();
    }
}
