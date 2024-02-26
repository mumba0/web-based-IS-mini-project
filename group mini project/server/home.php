<?php 

$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = '' ;
$DATABASE_NAME = 'authusers';

$conn = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);


if(mysqli_connect_error()){
    exit('Error connecting to the database' . mysqli_connect_error());

}

if(!isset($_POST['Phoneno'],$_POST['RegNo'],$_POST['email'], $_POST['address'])){ 
    exit('Empty Field(s)');
}

if(empty($_POST['Phoneno'] || $_POST['RegNo'] || $_POST['address'] || $_POST['email'])){
    exit('Values Empty');
}


if($statement = $conn->prepare('SELECT id, Regno FROM contactdetails WHERE Regno = ?')){
    $statement->bind_param('s', $_POST['RegNo']);
    $statement->execute();
    $statement->store_result();

    if($statement->num_rows>0){
        echo 'The registration number already exists. Kindly check your registration number.... and retry again';
        header("refresh:3; url=../client/home.html");
    }
    else {
        if($statement = $conn->prepare('INSERT INTO contactdetails (Regno,address,email,Phoneno) values (?, ?, ?,?)')){
            $statement->bind_param('ssss', $_POST['RegNo'], $_POST['address'],$_POST['email'], $_POST['Phoneno']);
            $statement->execute();
            echo 'Your contact details have been saved successfully'; 
            header("refresh: 2; url=../client/searchdata.html");
        }
        else{
            echo 'An Error occured';
            header("refresh:2; url=../client/home.html");
        }
    }
    

$statement->close();
    }

else{
        echo 'Error Occured';
    }

$conn->close()





?>