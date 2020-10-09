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


    <div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">เข้าสู่ระบบ</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="controller/registerController.php" id="login_form" method="POST" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="username">ชื่อผู้ใช้งาน</label>
                            <input type="text" class="form-control" name="username" id="username" required>
                        </div>
                        <div class="form-group">
                            <label for="password">รหัสผ่าน</label>
                            <input type="password" class="form-control" name="password" id="password" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิดหน้าต่าง</button>
                        <button type="submit" name="submit" id="submit" class="btn btn-primary">เข้าสู่ระบบ</button>
                        <input type="hidden" name="do" value="login">
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="regisModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">สมัครสมาชิก</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="controller/registerController.php" id="register_form" method="POST"
                    enctype="multipart/form-data">
                    <div class="modal-body">
                        <!-- <div class="form-group col-12">
                            <label for="prefixname" >คำนำหน้านาม</label>
                            <select name="prefixname" id="prefixname" class="form-control">
                                <option>นาย</option>
                                <option>นาง</option>
                                <option>นางสาว</option>
                            </select>
                        </div> -->
                        <div class="form-group">
                            <label for="firstname">ชื่อ</label>
                            <input type="text" class="form-control" name="firstname" id="firstname" required>
                        </div>
                        <div class="form-group">
                            <label for="lastname">นามสกุล</label>
                            <input type="text" class="form-control" name="lastname" id="lastname" required>
                        </div>
                        <div class="form-group">
                            <label for="tel">เบอร์โทรศัพท์</label>
                            <input type="text" class="form-control" name="tel" id="tel" required>
                        </div>
                        <div class="form-group">
                            <label for="username">ชื่อผู้ใช้งาน</label>
                            <input type="text" class="form-control" name="username" id="username" required>
                        </div>
                        <div class="form-group">
                            <label for="password">รหัสผ่าน</label>
                            <input type="password" class="form-control" name="password" id="password" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิดหน้าต่าง</button>
                        <button type="submit" name="submit" id="submit" class="btn btn-primary">ยืนยัน</button>
                        <input type="hidden" name="do" value="register">
                    </div>
                </form>
            </div>
        </div>
    </div>
    
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
                    url: "controller/registerController.php",
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
                        if (response == "Success") {
                            swal("Success", {
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