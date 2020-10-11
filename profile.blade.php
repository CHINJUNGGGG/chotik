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

    <div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">เข้าสู่ระบบ</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="controller/registerController.php" id="login_form" method="POST"
                    enctype="multipart/form-data">
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

    <div class="modal fade" id="regisModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
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
                        <div class="form-group">
                            <label for="prefixname" >คำนำหน้านาม</label>
                            <select name="prefixname" id="prefixname" class="form-control">
                                <option>นาย</option>
                                <option>นาง</option>
                                <option>นางสาว</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="firstname"  style="margin-top: 10px;">ชื่อ</label>
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
    </script>
</body>

</html>