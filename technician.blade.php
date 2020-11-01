<?php 
session_start();
require_once __DIR__.'/db/connectpdo.php';
?>

<!DOCTYPE html>
<html lang="zxx">

<head><?php require_once __DIR__.'/resource/head.php'; ?></head>

<body>

    <div id="preloder">
        <div class="loader"></div>
    </div>

    <?php require_once __DIR__.'/resource/navbar.php'; ?>

    <section class="team team--instructor spad" style="margin-top: 100px;">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title center-title">
                        <h2>Our Tecnician</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <?php
                    $sql = "SELECT * FROM tbl_tech ORDER BY id DESC";
                    $stmt=$db->prepare($sql);
                    $stmt->execute();
                    while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
                        $id = $row['id'];
                        $firstname = $row['firstname'];
                        $lastname = $row['lastname'];
                        $picture = $row['picture'];
                        $tel = $row['tel'];
                        $expert = $row['expert'];
                ?>
                <div class="col-lg-6">
                    <div class="team__item">
                        <div class="team__item__img">
                            <img src="backend/img/tech/<?=$picture?>" alt="" style="width: 190px; height: 150px;">
                        </div>
                        <div class="team__item__text">
                            <h5 style="font-size: 16px !important;"><?=$firstname?> <?=$lastname?></h5>
                            <span>ประสบการณ์ <?=$expert?></span>
                            <p><?=$tel?></p>
                        </div>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>
    </section>
    
    <?php require_once __DIR__.'/resource/script.php'; ?>
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
        $(document).ready(function(e) {
            $("#booking_form").on('submit', (function(e) {
                e.preventDefault();
                $.ajax({
                    url: "controller/bookingController.php",
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
                            swal("Success", {
                                icon: "success",
                            });
                            setTimeout(function() {
                                window.location.href = "booking.blade.php";
                            }, 3000);
                        }
                    },
                    error: function() {}
                });
            }));
        });
    </script>
</body>

</html>