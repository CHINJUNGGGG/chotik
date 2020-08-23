<?php 
session_start();
include('../db/connect.php');
include('../db/connectpdo.php'); 

$prefixname = $_POST['prefixname'];
$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
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

            $member_username = $_POST['username'];
            $member_password = $_POST['password'];

                if(isset($_POST['username']) && $_POST['username'] != '' && isset($_POST['password']) && $_POST['password'] != '') {
                    $member_username = trim($_POST['username']);
                    $member_password = trim($_POST['password']);

                    $query = "SELECT * FROM tbl_users WHERE `username` = ? LIMIT 0,1";
                    $stmt = $db->prepare($query);
                    $stmt->bindParam(1, $username);
                    $stmt->execute();
                    $num=$stmt->rowCount();

                    if($num > 0) {
                        // echo($num);
                        // die();
                        $row=$stmt->fetch(PDO::FETCH_ASSOC);
                        $_SESSION['id'] = $row['id'];
                        $_SESSION['firstname'] = $row['firstname'];
                        $_SESSION['lastname'] = $row['lastname'];
                        $MEMBER_PASSWORD_HASH = $row['password'];
                      
                        if(password_verify($member_password,$MEMBER_PASSWORD_HASH)){
                            echo "Success";
                        }else{
                            echo "Error";
                        }
                    }
                }   

        break;

    }
}

?>