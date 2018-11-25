<?php
    /*
        This script is responsible for checking whether the user crudentials
        are matching database records.
    */
    if(isset($_POST['usrnm']) && !empty($_POST['usrnm'])){
        if(isset($_POST['passwrd']) && !empty($_POST['passwrd'])){

                $servername = "localhost";
                $username = "root";
                $password = "123";
                $database = "chatApp";

                //Connecting with the database and checking if the connection is successful
                $conn = new mysqli($servername, $username, $password, $database);
                $userName = mysqli_real_escape_string($conn, $_POST['usrnm']);
                $userPassword = mysqli_real_escape_string($conn, $_POST['passwrd']);
                if (mysqli_connect_error()) {
                    die("Database connection failed: " . mysqli_connect_error());
                }
                $rec_query=mysqli_query($conn,"SELECT * FROM CHAT_RECORDS WHERE USER_NAME= '$userName' && USER_PASSWRD= '$userPassword'");

                $count = mysqli_num_rows($rec_query);
                if($count == 1){
                    mysqli_close($conn);
                    echo "You are logged in now";
                }
                else{
                    mysqli_close($conn);
                    echo "Crudentials don't match our database";
                }
        }
    }
?>