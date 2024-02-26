<?php 

$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = '' ;
$DATABASE_NAME = 'authusers';

$conn = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);


if(mysqli_connect_error()){
    exit('Error connecting to the database' . mysqli_connect_error());

}

if(!isset($_POST['username'],$_POST['email'],$_POST['password'])){ 
    exit('Empty Field(s)');
}

if(empty($_POST['username'] || $_POST['username'] || $_POST['username'] || $_POST['username'])){
    exit('Values Empty');
}


if($stmt = $conn->prepare('SELECT id, password FROM users WHERE username = ?')){
    $stmt->bind_param('s', $_POST['username']);
    $stmt->execute();
    $stmt->store_result();

    if($stmt->num_rows>0){
        echo 'Username Already exists. Try another one';
        header('refresh: 2; url=../client/register.html');
    }
    else {
        if($stmt = $conn->prepare('INSERT INTO users (username,password,email) values (?, ?, ?)')){
            $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
            $stmt->bind_param('sss', $_POST['username'], $password, $_POST['email']);
            $stmt->execute();
            echo 'You have Successfully Registered';
            header("refresh:2;url=../client/index.html" ); 
        }
        else{
            echo 'An Error occured';
            header("refresh:2; url=register.html");
        }
    }
    

$stmt->close();
    }

else{
        echo 'Error Occured';
    }

$conn->close()





?>