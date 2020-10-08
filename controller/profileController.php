<?php 
session_start();
include('../db/connect.php');
include('../db/connectpdo.php'); 

if(isset($_POST["do"]) && $_POST["do"] != "" ){
	$do = $_POST["do"];
	switch($do){
              
        case 'update':

            $id = $_POST['id'];
            $firstname = $_POST['firstname'];
            $lastname = $_POST['lastname'];
            $tel = $_POST['tel'];
    
            $sql = "UPDATE tbl_users SET firstname = '".$firstname."', lastname = '".$lastname."', update_at = current_timestamp WHERE id = '".$id."'";
            $result = mysqli_query($conn, $sql) or die(mysqli_error());

            unset($_SESSION["id"]);
            
            echo "Success";


        break;

    }
}

?>