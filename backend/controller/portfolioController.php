<?php 
session_start();
include('../db/connect.php');
$date = date("Ymd");
$numrand = (mt_rand());

if(isset($_POST["do"]) && $_POST["do"] != "" ){
	$do = $_POST["do"];
	switch($do){
              
        case 'add':

            $user_id = $_POST['user_id'];
            $detail = $_POST['detail'];

            $path="../img/port/";  
            $type = strrchr($_FILES['picture']['name'],".");
            $newname = 'img_'.$date.$numrand.$type;
            $path_copy=$path.$newname;
            $path_link="../img/port".$newname;
            move_uploaded_file($_FILES['picture']['tmp_name'],$path_copy);

    
            $sql = "INSERT INTO `tbl_portfolio`(`picture`, `user_id`, `detail`, `create_at`)  
                    VALUES ('$newname', '$user_id', '$detail', current_timestamp())";
                            // echo($sql);
                            // die();
            $result = mysqli_query($conn, $sql) or die(mysqli_error());
                    
            echo "Success";


        break;

    }
}

?>