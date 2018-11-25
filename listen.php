<?php
if(isset($_POST['usrnm']) && !empty($_POST['usrnm'])){
    if(isset($_POST['passwrd']) && !empty($_POST['passwrd'])){
        if(isset($_POST['who']) && !empty($_POST['who'])){

        $servername = "localhost";
        $username = "root";
        $password = "123";
        $database = "chatApp";

        $conn = new mysqli($servername, $username, $password, $database);
        $userName = mysqli_real_escape_string($conn, $_POST['usrnm']);          //Record usrname entered
        $userPassword = mysqli_real_escape_string($conn, $_POST['passwrd']);    //Record password entered 
        $whoTo = mysqli_real_escape_string($conn, $_POST['who']);               //Record the name of the person you wanna listen to
        if (mysqli_connect_error()) {
            die("Database connection failed: " . mysqli_connect_error());
        }
        $rec_query=mysqli_query($conn,"SELECT * FROM CHAT_RECORDS WHERE USER_NAME= '$userName' && USER_PASSWRD= '$userPassword'");
        $count = mysqli_num_rows($rec_query);
            //If crudentials of the user match
            if($count == 1){
                $userExists_query=mysqli_query($conn,"SELECT * FROM CHAT_RECORDS WHERE USER_NAME= '$whoTo'");
                $usr = mysqli_num_rows($userExists_query);
                if($count == 1){
                    $extractTheMessage_query=mysqli_query($conn,"SELECT MESSAGE FROM CHAT_RECORDS WHERE USER_NAME= '$whoTo'");
                    while ($obj = mysqli_fetch_object($extractTheMessage_query)) {
                        $message = $obj->MESSAGE;
                    }
                    echo ($message);
                    mysqli_close($conn);
                }
            }
            //If crudentials of the user don't match
            else{
                mysqli_close($conn);
                echo "Crudentials don't match our database";
            }
        }
    }
}
?>