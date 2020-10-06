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

    <section class="hero set-bg" data-setbg="img/hero-bg.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="hero__text">
                        <h5>Best options for you</h5>
                        <h2>drive safe & get license</h2>
                        <a href="#" class="primary-btn">Contact us</a>
                        <a href="#" class="primary-btn second-bg">See Courses</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
 
    <section class="feature spad">
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
    </section>

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
                                <a href="#"><i class="fa fa-facebook"></i></a>
                                <a href="#"><i class="fa fa-twitter"></i></a>
                                <a href="#"><i class="fa fa-instagram"></i></a>
                                <a href="#"><i class="fa fa-dribbble"></i></a>
                            </div>
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
    </script>
</body>

</html>