/*
    This AJAX function makes a call for PHP
    script that checks whether the user entered
    valid crudentials.
*/
$(document).ready(function(){
    $('#passwrd').keyup(function() {
        var grabUsername=$('#usrnm').val();     //Store the username
        var grabPassword=$('#passwrd').val();    //Store the password
        if(grabUsername!='' && grabPassword!=''){
            $.ajax({
                type: "POST",
                url: "checkUserName.php",
                data: {usrnm: grabUsername, passwrd: grabPassword},
                cache: false,
                success: function(result){
                        $("#status").text(result);                                                                                     
                }
            });
        }
    });
});
/*
    This function is responsible for AJAX that requests
    for a list of all users of the chat.
*/
$(document).ready(function(){
    $.ajax({
        type: "POST",
        url: "listUsers.php",
        cache: false,
        success: function(result){
            document.getElementById("allUsers").innerHTML = result;
        }
    });
});
/*
    This function is responsible for AJAX that updates
    the message field in the database. The other person will
    be able to read that message if the click Listen button.
*/
$(document).ready(function(){
    $('#toSend').keyup(function() {
        var grabUsername=$('#usrnm').val();     //Store the username
        var grabPassword=$('#passwrd').val();   //Store the password
        var grabMessage=$('#toSend').val();      //Store the message
        if(grabUsername!='' && grabPassword!='' && grabMessage!=''){
            $.ajax({
                type: "POST",
                url: "postMessage.php",
                data: {usrnm: grabUsername, passwrd: grabPassword, message: grabMessage},
                cache: false,
                success: function(result){
                        $("#status").text(result);                                                                                     
                }
            });
        }
    });
});
/*
    This function is responsible for AJAX that listens
    to the message that was sent by the other person.
*/
function updateReceivedMessage(){
        var grabUsername=$('#usrnm').val();     //Store the username
        var grabPassword=$('#passwrd').val();   //Store the password
        var grabWhoToListenTo=$('#whoToListenTo').val();    //Store the user that you want to listen to
        $.ajax({
            type: "POST",
            url: "listen.php",
            data: {usrnm: grabUsername, passwrd: grabPassword, who: grabWhoToListenTo},
            cache: false,
            success: function(result){
                $("#receive").text(result);
            }
        });
}
/*
    This function triggers AJAX function to
    repeatedly update the content of the field
    that is responsible for receiving messages
*/
$(document).ready(function(){
    setInterval(updateReceivedMessage,1000);
});