<?php 
session_start();
include('../db/connect.php');
$date = date("Ymd");
$numrand = (mt_rand());

if(isset($_POST["do"]) && $_POST["do"] != "" ){
	$do = $_POST["do"];
	switch($do){
              
        case 'add_pro':

            $pro_name = $_POST['pro_name'];
            $pro_price = $_POST['pro_price'];
            $pro_detail = $_POST['pro_detail'];

            $path="../img/promotion/";  
            $type = strrchr($_FILES['pro_img']['name'],".");
            $newname = 'img_'.$date.$numrand.$type;
            $path_copy=$path.$newname;
            $path_link="../img/promotion".$newname;
            move_uploaded_file($_FILES['pro_img']['tmp_name'],$path_copy);

    
            $sql = "INSERT INTO `tbl_promotion`(`pro_name`, `pro_price`, `pro_detail`, `pro_img`, `create_at`)  
                    VALUES ('$pro_name', '$pro_price', '$pro_detail', '$newname', current_timestamp())";
                            // echo($sql);
                            // die();
            $result = mysqli_query($conn, $sql) or die(mysqli_error());
                    
            echo "Success";


        break;

        case 'view_pro';

        include('../db/connectpdo.php'); 

        $ID = $_POST["id"];
        $sql = "SELECT * FROM tbl_promotion WHERE id = :ID";
        $stmt=$db->prepare($sql);
        $stmt->bindparam(':ID',$ID);
        $stmt->execute();
        $row=$stmt->fetch(PDO::FETCH_ASSOC);
        echo json_encode($row);

        break;

        case 'edit_pro';

        $pro_name = $_POST['pro_name'];
        $pro_price = $_POST['pro_price'];
        $pro_detail = $_POST['pro_detail'];
        $id = $_POST['id'];

            $path="../img/promotion/";  
            $type = strrchr($_FILES['picture']['name'],".");
            $newname = 'img_'.$date.$numrand.$type;
            $path_copy=$path.$newname;
            $path_link="../img/promotion".$newname;
            move_uploaded_file($_FILES['picture']['tmp_name'],$path_copy);

            $sql = "UPDATE tbl_promotion SET pro_name = '".$pro_name."', pro_img = '".$newname."', pro_price = '".$pro_price."', pro_detail = '".$pro_detail."', update_at = current_timestamp()
            WHERE id = '".$id."'";
            $result = mysqli_query($conn, $sql) or die(mysqli_error());
            
            echo "Success";
     

        break;

        case 'cancel';

        $id = $_POST['id'];

            $sql = "UPDATE tbl_promotion SET pro_status = '1'
            WHERE id = '".$id."'";
            $result = mysqli_query($conn, $sql) or die(mysqli_error());
            
            echo "Success";
     

        break;

        case 'enabled';

        $id = $_POST['id'];

            $sql = "UPDATE tbl_promotion SET pro_status = '0'
            WHERE id = '".$id."'";
            $result = mysqli_query($conn, $sql) or die(mysqli_error());
            
            echo "Success";
     

        break;


    }
}

?>