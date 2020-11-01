<?php 
session_start();
require_once __DIR__.'/db/connectpdo.php';
$user_id = $_SESSION['id'];
$data = array();
$sql = "SELECT * FROM tbl_users WHERE id = '".$user_id."'";
$stmt=$db->prepare($sql);
$stmt->execute();
$row=$stmt->fetch(PDO::FETCH_ASSOC);
    $id = $row['id'];
    $firstname = $row['firstname'];
    $lastname = $row['lastname'];
    $tel = $row['tel'];
?>


<!DOCTYPE html>
<html lang="zxx">

<head>
    <?php require_once __DIR__.'/resource/head.php'; ?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.css" />
</head>
<style>
.fc-title {
    color: #fff;
}
</style>

<body>

    <div id="preloder">
        <div class="loader"></div>
    </div>

    <?php require_once __DIR__.'/resource/navbar.php'; ?>



    <section class="contact spad" style="margin-top: 140px;">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-4">
                    <div class="contact__address">
                        <h4>Contact info</h4>
                        <ul>
                            <li>
                                <div class="icon">
                                    <i class="fa fa-phone"></i>
                                </div>
                                <p><span class="mt-2"><?=$tel?></span></p>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-8 col-md-8">
                    <div class="contact__form">
                        <h4>Profile</h4>
                        <form id="update_profile" method="POST" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-lg-4">
                                    <input type="text" value="<?=$firstname?>" name="firstname">
                                </div>
                                <div class="col-lg-4">
                                    <input type="text" value="<?=$lastname?>" name="lastname">
                                </div>
                                <div class="col-lg-4">
                                    <input type="text" value="<?=$tel?>" name="tel">
                                </div>
                            </div>
                            <button type="submit" class="site-btn">Update Profile</button>
                            <input type="hidden" name="id" value="<?=$id?>">
                            <input type="hidden" name="do" value="update">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <?php require_once __DIR__.'/resource/script.php'; ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.js"></script>
    <script type="text/javascript">
    $(document).ready(function(e) {
        $("#register_form").on('submit', (function(e) {
            e.preventDefault();
            $.ajax({
                url: "controller/registerController.php",
                type: "POST",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                success: function(response) {
                    console.log(response)
                    if (response == "Error") {
                        swal("ชื่อผู้ใช้งานนี้ได้ถูกใช้งานไปแล้ว !!", {
                            icon: "warning",
                        });
                    }
                    if (response == "Success") {
                        swal("สมัครสมาชิกเสร็จสิ้น", {
                            icon: "success",
                        });
                        setTimeout(function() {
                            window.location.href = "index.blade.php";
                        }, 3000);
                    }
                },
                error: function() {}
            });
        }));
    });
    $(document).ready(function(e) {
        $("#update_profile").on('submit', (function(e) {
            e.preventDefault();
            $.ajax({
                url: "controller/profileController.php",
                type: "POST",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                success: function(response) {
                    console.log(response)
                    if (response == "Error") {
                        swal("", {
                            icon: "warning",
                        });
                    }
                    if (response == "Success") {
                        swal("", {
                            icon: "success",
                        });
                        setTimeout(function() {
                            window.location.href = "index.blade.php";
                        }, 2000);
                    }
                },
                error: function() {}
            });
        }));
    });
    </script>
    <script type="text/javascript">
    $(document).ready(function(e) {
            $("#login_form").on('submit', (function(e) {
                e.preventDefault();
                $.ajax({
                    url: "backend/controller/loginController.php",
                    type: "POST",
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function(response) {
                        console.log(response)
                        if (response == "Error") {
                            swal("ชื่อผู้ใช้งานหรือรหัสผ่านผิด !!", {
                                icon: "warning",
                            });
                        }
                        if (response == "users") {
                            swal("Success", {
                                icon: "success",
                            });
                            setTimeout(function() {
                                window.location.href = "index.blade.php";
                            }, 1500);
                        }
                        if (response == "admin") {
                            swal("Success", {
                                icon: "success",
                            });
                            setTimeout(function() {
                                window.location.href = "backend/index.blade.php";
                            }, 1500);
                        }
                        if (response == "staff") {
                            swal("Success", {
                                icon: "success",
                            });
                            setTimeout(function() {
                                window.location.href = "backend/index.blade.php";
                            }, 1500);
                        }
                    },
                    error: function() {}
                });
            }));
        });
    </script>
</body>

</html>