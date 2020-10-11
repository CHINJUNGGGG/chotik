<?php 
session_start();
$user_id = $_SESSION['id'];
include('../db/connectpdo.php');
include('../db/connect.php'); 
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
            $b_start_time = $_POST['b_start_time'];

            $sql_date = "SELECT b_start_time,b_date,tech_id FROM tbl_booking WHERE tech_id = '".$tech_id."'";
            $stmt_date=$db->prepare($sql_date);
            $stmt_date->execute();
            $row_date=$stmt_date->fetch(PDO::FETCH_ASSOC);
            $time_check = $row_date['b_start_time'] ??= '0';
            $date_check = $row_date['b_date'] ??= '0';
            $technician_id = $row_date['id'] ??= '0';

            // print_r($_POST);
            // die();

            if($b_start_time == $time_check && $b_date == $date_check || $tech_id == $technician_id){
                echo "Time_out";
            }else{
                for ($i=0; $i<sizeof ($check);$i++) {
                    $sql_time = "SELECT list_time,list_price FROM tbl_list WHERE id = '".$check[$i]."'";
                    $stmt=$db->prepare($sql_time);
                    $stmt->execute();
                    $row=$stmt->fetch(PDO::FETCH_ASSOC);
                    $list_time = $row['list_time'];
                    $list_price = $row['list_price'];

                    $sql = "INSERT INTO `tbl_booking`(`b_list`, `b_date`, `b_end_date`, `b_start_time`, `b_price`, `user_id`, `tech_id`, `b_time`, `create_at`) 
                    VALUES ('".$check[$i]. "', '$b_date', '$b_date', '$b_start_time', '$list_price', '$user_id', '$tech_id', '$list_time', current_timestamp())";
                    // echo($sql);
                    // die();
                    $result = mysqli_query($conn, $sql) or die(mysqli_error());

                    // $sql1 = "UPDATE tbl_tech SET status = '1' WHERE id = '".$tech_id."'";
                    // $result1 = mysqli_query($conn, $sql1) or die(mysqli_error());
                }  
                echo "Success";
            }    

        break;

        
        case 'view_promotion';

        $pro_id = $_POST["id"];
        $sql = "SELECT * FROM tbl_promotion WHERE id = :pro_id";
        $stmt=$db->prepare($sql);
        $stmt->bindparam(':pro_id',$pro_id);
        $stmt->execute();
        $row=$stmt->fetch(PDO::FETCH_ASSOC);
        echo json_encode($row);

        break;

        case 'promotion':

            $tech_id = $_POST['tech_id'];
            $b_date = $_POST['b_date'];
            $b_start_time = $_POST['start_time'];
            $promotion_id = $_POST['id'];
            $pro_price = $_POST['pro_price'];

            $sql_date = "SELECT b_start_time,b_date,tech_id FROM tbl_booking WHERE tech_id = '".$tech_id."'";
            $stmt_date=$db->prepare($sql_date);
            $stmt_date->execute();
            $row_date=$stmt_date->fetch(PDO::FETCH_ASSOC);
            $time_check = $row_date['b_start_time'] ??= '0';
            $date_check = $row_date['b_date'] ??= '0';
            $technician_id = $row_date['id'] ??= '0';

            if($b_start_time == $time_check && $b_date == $date_check || $tech_id == $technician_id){
                echo "Time_out";
            }else{
                    $sql = "INSERT INTO `tbl_booking`(`promotion`, `b_date`, `b_end_date`, `b_start_time`, `b_price`, `user_id`, `tech_id`, `create_at`) 
                    VALUES ('$promotion_id', '$b_date', '$b_date', '$b_start_time', '$pro_price', '$user_id', '$tech_id',  current_timestamp())";
                    $result = mysqli_query($conn, $sql) or die(mysqli_error());

                echo "Success";
            }    

        break;

    
    }
}

?>