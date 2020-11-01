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

    <section class="contact spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-4" style="margin-top: 100px;">
                    <div class="contact__address">
                        <h4>ข้อมูลติดต่อร้าน</h4>
                        <ul>
                            <li>
                                <div class="icon">
                                    <i class="fa fa-phone"></i>
                                </div>
                                <p><span>chotik_nails@gmail.com</span><span>099-954-4323</span></p>
                            </li>
                            <li>
                                <div class="icon">
                                    <i class="fa fa-map-marker"></i>
                                </div>
                                <p>111/43 ซอย พรธิสาร ตำบล คลองหก อำเภอ คลองหลวง จังหวัก ปทุมธานี 12120</p>
                            </li>
                            <li>
                                <div class="icon">
                                    <i class="fa fa-clock-o"></i>
                                </div>
                                <p><span style="margin-top: 10px;">จันทร์ - เสาร์ : 8:00 - 17:00 </span></p>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-8 col-md-8">
                    <div class="map">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d9141.07297257301!2d100.72242326004336!3d14.033968899936912!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x311d78a34e9c15a9%3A0xe09b721885a0b41b!2z4LihIOC4o-C4suC4iuC4oeC4h-C4hOC4peC4mOC4seC4jeC4jeC4muC4uOC4o-C4tQ!5e0!3m2!1sth!2sth!4v1602153816015!5m2!1sth!2sth" width="600" height="400" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
                    </div>
                </div>
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
    </script>
</body>

</html>