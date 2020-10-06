<?php 
session_start();
include('../db/connect.php');

if(isset($_POST["do"]) && $_POST["do"] != "" ){
	$do = $_POST["do"];
	switch($do){

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