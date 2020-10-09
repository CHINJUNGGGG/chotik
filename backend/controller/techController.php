<?php 
session_start();
include('../db/connect.php');
$date = date("Ymd");
$numrand = (mt_rand());

if(isset($_POST["do"]) && $_POST["do"] != "" ){
	$do = $_POST["do"];
	switch($do){
              
        case 'add_tech':

            $firstname = $_POST['firstname'];
            $lastname = $_POST['lastname'];
            $tel = $_POST['tel'];
            $email = $_POST['email'];
            $expert = $_POST['expert'];
            $password_hash = password_hash($tel, PASSWORD_BCRYPT);

            $sql_check = "SELECT email FROM tbl_tech WHERE email = '".$email."'";
            $result_check = mysqli_query($conn, $sql_check) or die(mysqli_error());
            $num=mysqli_num_rows($result_check);

            $sql_check1 = "SELECT email FROM tbl_admin WHERE email = '".$email."'";
            $result_check1 = mysqli_query($conn, $sql_check1) or die(mysqli_error());
            $num1=mysqli_num_rows($result_check1);


            if($num > 0 || $num1 > 0){
                echo "Error";
            }else{  
                
                $query = "SELECT tech_id FROM tbl_tech ORDER BY id DESC";
                $result = mysqli_query($conn,$query);
                $row = mysqli_fetch_array($result);
                $lastid = $row['tech_id'];

                if(empty($lastid)){

                    $number = "TECH-00001";

                    $path="../img/tech/";  
                    $type = strrchr($_FILES['picture']['name'],".");
                    $newname1 = 'img_'.$date.$numrand.$type;
                    // echo($newname);
                    // die();
                    $path_copy=$path.$newname1;
                    //  echo($path_copy);
                    // die();
                    $path_link="../img/tech".$newname1;
                    move_uploaded_file($_FILES['picture']['tmp_name'],$path_copy);

                    $sql = "INSERT INTO `tbl_tech`(`tech_id`, `email`, `tel`, `firstname`, `lastname`, `picture`, `expert`, `create_at`)  
                    VALUES ('$number', '$email', '$tel', '$firstname', '$lastname', '$newname1', '$expert', current_timestamp())";
                    $result = mysqli_query($conn, $sql) or die(mysqli_error());

                    $sql1 = "INSERT INTO `tbl_admin`(`firstname`, `lastname`, `tel`, `email`, `password`, `status`, `create_at`, `update_at`) 
                    VALUES ('$firstname', '$lastname', '$tel', '$email', '$password_hash', '1', current_timestamp(), current_timestamp())";
                    $result1 = mysqli_query($conn, $sql1) or die(mysqli_error());

                    echo "Success";

                }else{

                    $idd = str_replace("TECH-", "", $lastid);
                    $id = str_pad($idd + 1, 5, 0, STR_PAD_LEFT);
                    $number = 'TECH-'.$id;
                    // echo($idd);
                    // die();

                    $path="../img/tech/";  
                    $type = strrchr($_FILES['picture']['name'],".");
                    $newname = 'img_'.$date.$numrand.$type;
                    $path_copy=$path.$newname;
                    $path_link="../img/tech".$newname;
                    move_uploaded_file($_FILES['picture']['tmp_name'],$path_copy);

    
                    $sql = "INSERT INTO `tbl_tech`(`tech_id`, `email`, `tel`, `firstname`, `lastname`, `picture`, `expert`, `create_at`)  
                            VALUES ('$number', '$email', '$tel', '$firstname', '$lastname', '$newname', '$expert', current_timestamp())";
                            // echo($sql);
                            // die();
                    $result = mysqli_query($conn, $sql) or die(mysqli_error());

                    $sql1 = "INSERT INTO `tbl_admin`(`firstname`, `lastname`, `tel`, `email`, `password`, `status`, `create_at`, `update_at`) 
                    VALUES ('$firstname', '$lastname', '$tel', '$email', '$password_hash', '1', current_timestamp(), current_timestamp())";
                    $result1 = mysqli_query($conn, $sql1) or die(mysqli_error());
                    
                echo "Success";

                }

            }

        break;

        case 'view_tech';

        include('../db/connectpdo.php'); 

        $ID = $_POST["id"];
        $sql = "SELECT * FROM tbl_tech WHERE id = :ID";
        $stmt=$db->prepare($sql);
        $stmt->bindparam(':ID',$ID);
        $stmt->execute();
        $row=$stmt->fetch(PDO::FETCH_ASSOC);
        echo json_encode($row);

        break;

        case 'edit_tech';

        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $tel = $_POST['tel'];
        $email = $_POST['email'];
        $expert = $_POST['expert'];
        $id = $_POST['id'];

        if($num > 0){
            echo "Error";
        }else{  

            $path="../img/tech/";  
            $type = strrchr($_FILES['picture1']['name'],".");
            $newname = 'img_'.$date.$numrand.$type;
            $path_copy=$path.$newname;
            $path_link="../img/tech".$newname;
            move_uploaded_file($_FILES['picture1']['tmp_name'],$path_copy);

            $sql = "UPDATE tbl_tech SET firstname = '".$firstname."', lastname = '".$lastname."', email = '".$email."', tel = '".$tel."', picture = '".$newname."', expert = '".$expert."', update_at = current_timestamp()
            WHERE id = '".$id."'";
            $result = mysqli_query($conn, $sql) or die(mysqli_error());
            
            echo "Success";
        }

        break;


    }
}

?>