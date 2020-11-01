<?php 
session_start();
include('../db/connect.php');
include('../db/connectpdo.php'); 


if(isset($_POST["do"]) && $_POST["do"] != "" ){
	$do = $_POST["do"];
	switch($do){
              
        case 'register':

            $firstname = $_POST['firstname'];
            $prefixname = $_POST['prefixname'];
            $lastname = $_POST['lastname'];
            $tel = $_POST['tel'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $password_hash = password_hash($password, PASSWORD_BCRYPT);

            $sql_check = "SELECT email FROM tbl_users WHERE email = '".$email."'";
            $result_check = mysqli_query($conn, $sql_check) or die(mysqli_error());
            $num=mysqli_num_rows($result_check);

            if($num > 0){
                echo "Error";
            }else{    
    
            $sql = "INSERT INTO `tbl_users`(`email`, `password`, `tel`, `prefixname`, `firstname`, `lastname`, `status`, `create_at`, `update_at`) 
                    VALUES ('$email', '$password_hash', '$tel', '$prefixname', '$firstname', '$lastname' , '2', current_timestamp(), current_timestamp())";
            $result = mysqli_query($conn, $sql) or die(mysqli_error());
            
            echo "Success";

            }

        break;

    }
}
