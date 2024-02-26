<?php 

require('dbconnection.php');



if(isset($_POST['username'])){
    $username=$_POST['username'];
    $password =$_POST['password1'];
    $sql = "select * from users where username ='".$username."' AND password='".$password."' limit 1";

    $result = mysqli_query($conn,$sql);


    if(mysqli_num_rows($result)==1){
        echo "You have successfully logged in";
        header('refresh: 2, url=../client/home.html');
        exit();
    }

    else{
        echo "You have Entered Incorrect Password";
        header('refresh: 2, url=../client/home.html');
        exit();

    }
}
