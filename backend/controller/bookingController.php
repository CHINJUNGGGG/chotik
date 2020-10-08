<?php 
session_start();
include('../db/connectpdo.php');
$date = date("Ymd");
$numrand = (mt_rand());

$id = $_GET['id'];
$sql = "UPDATE tbl_booking SET b_status = '1', update_at = current_timestamp() WHERE id = :id";
$stmt=$db->prepare($sql);
$stmt->bindparam(':id',$id);
$stmt->execute();

echo "<script>window.location='../booking.blade.php'</script>"

?>