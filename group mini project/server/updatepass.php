<?php 
include('dbconnection.php');

if(isset($_POST['change-password'])){
    $pass1 = mysqli_real_escape_string($conn, $_POST['pass1']);
    $cpass1 = mysqli_real_escape_string($conn, $_POST['cpass']);
    $email = $_POST['email'];

    if($pass1 !== $cpass1){
        echo "Passwords dont match";

    }
    else{
        $code = 0; 
       

        $encrypt_pass = password_hash($pass1, PASSWORD_DEFAULT);

        $sql_update = "UPDATE users SET password = '$encrypt_pass', code = $code  WHERE email = '$email' ";

        $execute_query = mysqli_query($conn, $sql_update);

        if($execute_query){

            $info = "Your password has been changed successfully. You can login with your new password";

            echo $info;

            header('refresh: 3; url=../client/index.html');


        }
        else{
            echo "Failed to change your password";
        }
    }
}





?>