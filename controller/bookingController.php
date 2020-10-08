<?php 
session_start();
$user_id = $_SESSION['id'];
include('../db/connect.php');
include('../db/connectpdo.php'); 
$sql = "SELECT id FROM tbl_users WHERE id = '".$user_id."'";
$stmt=$db->prepare($sql);
$stmt->execute();
$row=$stmt->fetch(PDO::FETCH_ASSOC);
$id = $row['id'];

if(isset($_POST["do"]) && $_POST["do"] != "" ){
	$do = $_POST["do"];
	switch($do){
              
        case 'booking':

            $tech_id = $_POST['tech_id'];
            $b_date = $_POST['b_date'];
            $check = $_POST['check'];
            // print_r($_POST);
            // die();
            
            for ($i=0; $i<sizeof ($check);$i++) {
                $sql_time = "SELECT list_time FROM tbl_list WHERE id = '".$check[$i]."'";
                $stmt=$db->prepare($sql_time);
                $stmt->execute();
                $row=$stmt->fetch(PDO::FETCH_ASSOC);
                $list_time = $row['list_time'];

                $sql = "INSERT INTO `tbl_booking`(`b_list`, `b_date`, `b_end_date`, `user_id`, `tech_id`, `b_time`, `create_at`) 
                VALUES ('".$check[$i]. "', '$b_date', '$b_date', '$user_id', '$tech_id', '$list_time', current_timestamp())";
                // echo($sql);
                // die();
                $result = mysqli_query($conn, $sql) or die(mysqli_error());
            }  
    
            echo "Success";

        break;

    }
}

?>