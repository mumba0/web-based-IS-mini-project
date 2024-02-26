<?php 
require('dbconnection.php');

if(isset($_POST['submit'])){
    $search = $_POST['search'];

    $sql_query = "Select * from contactdetails where Regno ='$search'";
    $result = mysqli_query($conn,$sql_query);
    if($result){
    if(mysqli_num_rows($result)>0){
        echo'<h1 style="color: blue;"> Your contact details stored on the database</h1>';
        echo '<table border="2"; style="border-collapse: collapse;">
        <thead> 
        <th>id</th>
        <th>Regno</th>
        <th>Phone number</th>
        <th>Email</th>
        <th>Address</th>
        </thead>';
        $row = mysqli_fetch_assoc($result);
        echo '<tbody>
        <tr>
        <td>'.$row['id'].'</td>
        <td>'.$row['Regno'].'</td>
        <td>'.$row['PhoneNo'].'</td>
        <td>'.$row['email'].'</td>
        <td>'.$row['address'].'</td>
        </tr>
        </tbody>
        </table>';

    }
    else{
        echo '<h2 style="color: red"> Data not found on the database</h2>';
    }
    }


}



?>