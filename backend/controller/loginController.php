<?php 
session_start();
include('../db/connectpdo.php');

if(isset($_POST["do"]) && $_POST["do"] != "" ){
	$do = $_POST["do"];
	switch($do){
        case 'login':

            $email = $_POST['email'];
            $password = $_POST['password'];
    
                if(isset($_POST['email']) && $_POST['email'] != '' && isset($_POST['password']) && $_POST['password'] != '') {
                    $email = trim($_POST['email']);
                    $password = trim($_POST['password']);

                    $query = "SELECT * FROM tbl_admin WHERE `email` = ? LIMIT 0,1";
                    $stmt = $db->prepare($query);
                    $stmt->bindParam(1, $email);
                    $stmt->execute();
                    $num=$stmt->rowCount();

                    if($num > 0) {
                        // echo($num);
                        // die();
                        $row=$stmt->fetch(PDO::FETCH_ASSOC);
                        $_SESSION['id'] = $row['id'];
                        $_SESSION['firstname'] = $row['firstname'];
                        $_SESSION['email'] = $row['email'];
                        $_SESSION['lastname'] = $row['lastname'];
                        $_SESSION['status'] = $row['status'];
                        $MEMBER_PASSWORD_HASH = $row['password'];
                      
                        if(password_verify($password,$MEMBER_PASSWORD_HASH)){
                            if($row["status"] == "0"){
                                echo "Success";
                            }
                            if($row["status"] == "1"){
                                echo "Success";
                            }
                        }else{
                            echo "Error";
                        }
                    }
                }   
        break;

    }
}

?>