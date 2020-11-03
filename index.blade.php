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

    <section class="hero set-bg" data-setbg="assets/img1/5.jpg" style="opacity: 1">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="hero__text">
                        <h2>chotik nails & spa</h2>
                        <a href="contact.blade.php" class="primary-btn">Contact us</a>
                        <a href="promotion.blade.php" class="primary-btn second-bg">See Promotion</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
 
    <!-- <section class="feature spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-4">
                    <div class="feature__text">
                        <div class="section-title">
                            <span>Why choose us ?</span>
                            <h2>Our Promotion</h2>
                        </div>
                        <p>Promotion for you.</p>
                        <a href="promotion.blade.php" class="primary-btn second-bg">See Promotion</a>
                    </div>
                </div>
                <div class="col-lg-8 col-md-8">
                    <div class="row">
                    <?php
                        $sql1 = "SELECT * FROM tbl_promotion ORDER BY id DESC LIMIT 6";
                        $stmt=$db->prepare($sql1);
                        $stmt->execute();
                        while($row1=$stmt->fetch(PDO::FETCH_ASSOC)){
                            $id = $row1['id'];
                            $pro_name = $row1['pro_name'];
                            $pro_price = $row1['pro_price'];
                            $pro_img = $row1['pro_img'];
                    ?>
                        <div class="col-lg-4 col-md-6 col-sm-6">
                            <div class="feature__item">
                                <img src="backend/img/promotion/<?=$pro_img?>" alt="" style="width: 150px; height 100px;">
                                <h5><?=$pro_name?></h5>
                            </div>
                        </div>
                    <?php } ?>    
                    </div>
                </div>
            </div>
        </div>
    </section> -->

    <section class="team spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-7 col-md-7 col-sm-7">
                    <div class="section-title">
                        <span>Our Great Team</span>
                        <h2>Our Technician</h2>
                    </div>
                </div>
                <div class="col-lg-5 col-md-5 col-sm-5">
                    <div class="team__all">
                        <a href="technician.blade.php" class="primary-btn second-bg">View all</a>
                    </div>
                </div>
            </div>
            <div class="row">
                <?php
                    $sql = "SELECT * FROM tbl_tech ORDER BY id DESC";
                    $stmt=$db->prepare($sql);
                    $stmt->execute();
                    while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
                        $firstname = $row['firstname'];
                        $lastname = $row['lastname'];
                        $expert = $row['expert'];
                        $tel = $row['tel'];
                        $picture = $row['picture'];
                ?>
                <div class="col-lg-6">
                    <div class="team__item">
                        <div class="team__item__img">
                            <img src="backend/img/tech/<?=$picture?>" alt="" style="width: 190px; height: 150px;">
                        </div>
                        <div class="team__item__text">
                            <h5><?=$firstname?> <?=$lastname?></h5>
                            <span>Tel.<?=$tel?></span>
                            <div class="team__item__social">
                     
                            </div>
                        </div>
                    </div>
                </div>
                <?php } ?> 
            </div>
        </div>
    </section>

    <?php require_once __DIR__.'/resource/script.php'; ?>
    <script>
    $(document).ready(function() {
        var url = window.location; 
        var element = $('ul.sidebar-menu a').filter(function() {
        return this.href == url || url.href.indexOf(this.href) == 0; }).parent().addClass('active');
        if (element.is('li')) { 
             element.addClass('active').parent().parent('li').addClass('active')
         }
    });
    </script>
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
    </script>
</body>

</html>