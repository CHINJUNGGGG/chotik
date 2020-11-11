<?php 
session_start();
include('../db/connect.php');
include('../db/connectpdo.php');
$date = date("Ymd");
$numrand = (mt_rand());

if(isset($_POST["do"]) && $_POST["do"] != "" ){
	$do = $_POST["do"];
	switch($do){
              
        case 'trade':

            $tech_id = $_POST['tech_id'];

            $sql5 = "SELECT *,SUM(b_price) as salary FROM tbl_booking WHERE tech_id = :tech_id AND b_status = 1";
            $stmt5=$db->prepare($sql5);
            $stmt5->bindparam(':tech_id',$tech_id);
            $stmt5->execute();
            $row5=$stmt5->fetch(PDO::FETCH_ASSOC);
            $salary = $row5['salary'];

            $sum_price = $salary * 30 / 100;

            $sql_update = "UPDATE tbl_tech SET salary = '".$sum_price."' WHERE id = '".$tech_id."'";
            $result_update = mysqli_query($conn, $sql_update) or die(mysqli_error());

            $sql_update1 = "UPDATE tbl_booking SET b_status = 4 WHERE tech_id = '".$tech_id."' AND b_status = 1";
            $result_update1 = mysqli_query($conn, $sql_update1) or die(mysqli_error());
                    
            echo "Success";


        break;

    }
}

?>