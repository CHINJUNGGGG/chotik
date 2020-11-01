<?php 
session_start();
include('../db/connect.php');
include('../db/connectpdo.php'); 



if(isset($_POST["do"]) && $_POST["do"] != "" ){
	$do = $_POST["do"];
	switch($do){
              
        case 'add':

            $firstname = $_POST['firstname'];
            $lastname = $_POST['lastname'];
            $tel = $_POST['tel'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $password_hash = password_hash($password, PASSWORD_BCRYPT);

            $sql_check = "SELECT email FROM tbl_admin WHERE email = '".$email."'";
            $result_check = mysqli_query($conn, $sql_check) or die(mysqli_error());
            $num=mysqli_num_rows($result_check);

            if($num > 0){
                echo "Error";
            }else{    
    
            $sql = "INSERT INTO `tbl_users`(`firstname`, `lastname`, `tel`, `email`, `password`, `create_at`, `update_at`) 
                    VALUES ('$firstname', '$lastname', '$tel', '$email', '$password_hash', current_timestamp(), current_timestamp())";
                
            $result = mysqli_query($conn, $sql) or die(mysqli_error());
            
            echo "Success";

            }

        break;

        case 'view_user';

        include('../db/connectpdo.php'); 

        $ID = $_POST["id"];
        $sql = "SELECT * FROM tbl_users WHERE id = :ID";
        $stmt=$db->prepare($sql);
        $stmt->bindparam(':ID',$ID);
        $stmt->execute();
        $row=$stmt->fetch(PDO::FETCH_ASSOC);
        echo json_encode($row);

        break;

    }
}

?>