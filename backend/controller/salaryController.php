<?php 
session_start();
include('../db/connectpdo.php');
$date = date("Ymd");
$numrand = (mt_rand());

$id = $_GET['id'];

$sql1 = "SELECT * FROM tbl_booking WHERE id = :id";
$stmt1=$db->prepare($sql1);
$stmt1->bindparam(':id',$id);
$stmt1->execute();
$row1=$stmt1->fetch(PDO::FETCH_ASSOC);
$tech_id = $row1['tech_id'];
$b_list = $row1['b_list'];

$sql3 = "SELECT * FROM tbl_list WHERE id = :b_list";
$stmt3=$db->prepare($sql3);
$stmt3->bindparam(':b_list',$b_list);
$stmt3->execute();
$row3=$stmt3->fetch(PDO::FETCH_ASSOC);
$price = $row3['list_price'];
$salary1 = $price * 30 / 100;

$sql5 = "SELECT * FROM tbl_tech WHERE id = :tech_id";
$stmt5=$db->prepare($sql5);
$stmt5->bindparam(':tech_id',$tech_id);
$stmt5->execute();
$row5=$stmt5->fetch(PDO::FETCH_ASSOC);
$slr = $row5['salary'];
$salary = $salary1 + $slr;

// echo($salary);
// die();

$sql2 = "UPDATE tbl_tech SET salary = '".$salary."', update_at = current_timestamp() WHERE id = :tech_id";
$stmt2=$db->prepare($sql2);
$stmt2->bindparam(':tech_id',$tech_id);
$stmt2->execute();

$sql4 = "UPDATE tbl_booking SET b_status = '2', update_at = current_timestamp() WHERE id = :id";
$stmt4=$db->prepare($sql4);
$stmt4->bindparam(':id',$id);
$stmt4->execute();


echo "<script>window.location='../booking.blade.php'</script>"

?>