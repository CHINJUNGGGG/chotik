<?php 
session_start();
require_once __DIR__.'/db/connectpdo.php';
$data = array();
$sql = "SELECT id,b_date,b_time,b_end_date FROM tbl_booking";
$stmt=$db->prepare($sql);
$stmt->execute();
while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
    $data[] = array(
        'id' => $row->id,
        'b_time'=> $row->b_time,
        'b_date'=> $row->b_date,
        'b_date_end'=> $row->b_date_end
    );
    
}

?>