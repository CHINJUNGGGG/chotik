<?php 
include('../db/connect.php'); 

$prefixname = $_POST['prefixname'];
$firstname = $_POST['firstname'];
$lastname = $_POST['prefixname'];
$tel = $_POST['tel'];
$username = $_POST['username'];
$password = $_POST['password'];
$password_hash = password_hash($password, PASSWORD_BCRYPT);

if(isset($_POST["do"]) && $_POST["do"] != "" ){
	$do = $_POST["do"];
	switch($do){
              
        case 'register':

            $sql_check = "SELECT username FROM tbl_users WHERE username = '".$username."'";
            $result_check = mysqli_query($conn, $sql_check) or die(mysqli_error());
            $num=mysqli_num_rows($result_check);

            if($num > 0){
                echo "Error";
            }else{    
    
            $sql = "INSERT INTO `tbl_users`(`username`, `password`, `tel`, `prefixname`, `firstname`, `lastname`, `status`, `create_at`, `update_at`) 
                    VALUES ('$username', '$password_hash', '$tel', '$prefixname', '$firstname', '$lastname' , '0', current_timestamp(), current_timestamp())";
            $result = mysqli_query($conn, $sql) or die(mysqli_error());
            
            echo "Success";

            }

        break;

        case 'login':

            $sql_check = "SELECT username FROM tbl_users WHERE username = '".$username."'";
            $result_check = mysqli_query($conn, $sql_check) or die(mysqli_error());
            $num=mysqli_num_rows($result_check);
  

            echo "Success";

        break;

    }
}

?>