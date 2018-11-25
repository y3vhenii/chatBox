<?php
    /*
        This script is responsible for providing the user with 
        the list of all users in the chat.
    */
    $servername = "localhost";
    $username = "root";
    $password = "123";
    $database = "chatApp";
    $conn = new mysqli($servername, $username, $password, $database);
    
        if (mysqli_connect_error()) {
            die("Database connection failed: " . mysqli_connect_error());
        }
        $users_query=mysqli_query($conn,"SELECT USER_NAME FROM CHAT_RECORDS");
        while($row = $users_query->fetch_assoc()) {
            echo('<p><strong>' . $row["USER_NAME"] . '</strong></p>');
        }
        mysqli_close($conn);
?>