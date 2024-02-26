 <?php

//Load composer's autoloader
require 'vendor/autoload.php';


include('dbconnection.php');

 use PHPMailer\PHPMailer\Exception;
 use PHPMailer\PHPMailer\PHPMailer;
 use PHPMailer\PHPMailer\SMTP;


 
if(isset($_POST['CheckEmail'])){
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $CheckEmail = "SELECT * FROM users WHERE email='$email'";
        $sql_query = mysqli_query($conn, $CheckEmail);
        if(mysqli_num_rows($sql_query) > 0){
            $code = rand(999999, 111111);
            $enter_code = "UPDATE users SET code = $code WHERE email = '$email'";
            $execute_query =  mysqli_query($conn, $enter_code);
            if($execute_query){
                $link = 'https://localhost/clientServer/client/changepassword.html';
                try {
                    //Server settings
                    $mail = new PHPMailer();
 
                    $mail->CharSet =  "utf-8";
                    $mail->IsSMTP();
                    // enable SMTP authentication
                    $mail->SMTPAuth = true;                  
                    // GMAIL username
                    $mail->Username = "frashasanto111@gmail.com";
                    // GMAIL password
                    $mail->Password = "hdtvjroeqkhjdyzb";
                    $mail->SMTPSecure = "ssl";  
                    // sets GMAIL as the SMTP server
                    $mail->Host = "smtp.gmail.com";
                    // set the SMTP port for the GMAIL server
                    $mail->Port = "465";
                    $mail->From='frashasanto111@gmail.com';
                    $mail->FromName='Frasha Santo Just a Tech';
                    $mail->AddAddress($email, 'reciever_name');
                    $mail->Subject  =  'Reset Password';
                    $mail->IsHTML(true);
                    $mail->Body    = 'Click On This Link to Reset Password '.$link.'';
                
                    $mail->send();
                    $info = "Hello the Client Server Authentication system has sent a passwod reset otp to your email - $email";
                    $_SESSION['info'] = $info;
                    $_SESSION['email'] = $email;
                    echo $info;
                    exit();
                } catch (Exception $e) {
                    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                    header('refresh: 1; url=../client/forgotpass.html');
                }
    
          
            }
           

        }
        else{
            echo "This email address does not exist!";
            header("refresh:2; url=../client/forgotpass.html");
        }

    }
               
        ?>










