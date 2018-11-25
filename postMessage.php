<?php   
if(isset($_POST['usrnm']) && !empty($_POST['usrnm'])){
    if(isset($_POST['passwrd']) && !empty($_POST['passwrd'])){
        if(isset($_POST['message']) && !empty($_POST['message'])){
        $servername = "localhost";
        $username = "root";
        $password = "123";
        $database = "chatApp";

        $conn = new mysqli($servername, $username, $password, $database);
        $userName = mysqli_real_escape_string($conn, $_POST['usrnm']);          //Record usrname entered
        $userPassword = mysqli_real_escape_string($conn, $_POST['passwrd']);    //Record password entered 
        $messageSent = mysqli_real_escape_string($conn, $_POST['message']);     //Record message 
            if (mysqli_connect_error()) {
                die("Database connection failed: " . mysqli_connect_error());
            }
            $rec_query=mysqli_query($conn,"SELECT * FROM CHAT_RECORDS WHERE USER_NAME= '$userName' && USER_PASSWRD= '$userPassword'");
            $count = mysqli_num_rows($rec_query);
                if($count == 1){
                    $updateMessageField_query=mysqli_query($conn,"UPDATE CHAT_RECORDS SET MESSAGE='$messageSent' WHERE USER_NAME= '$userName' && USER_PASSWRD= '$userPassword'");
                    echo "Message sent";
                    mysqli_close($conn);
                }
                else{
                    mysqli_close($conn);
                    echo "Crudentials don't match our database, message not sent!";
                }
        }
    }
}