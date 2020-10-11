<?php 
session_start();
require_once __DIR__.'/db/connectpdo.php';
$test_id = $_GET['id'];
$customer = $_GET['id1'];
$shop = $_GET['id2'];
?>

<!DOCTYPE html>
<html lang="zxx">

<head><?php require_once __DIR__.'/resource/head.php'; ?></head>

<body>

<style>
    .modal {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  padding-top: 100px; /* Location of the box */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.9); /* Black w/ opacity */
}

/* Modal Content (image) */
.modal-content {
  margin: auto;
  display: block;
  width: 90%;
  max-width: 700px;
}

/* Add Animation */
.modal-content {  
  -webkit-animation-name: zoom;
  -webkit-animation-duration: 0.6s;
  animation-name: zoom;
  animation-duration: 0.6s;
}

@-webkit-keyframes zoom {
  from {-webkit-transform:scale(0)} 
  to {-webkit-transform:scale(1)}
}

@keyframes zoom {
  from {transform:scale(0)} 
  to {transform:scale(1)}
}

.close {
  position: absolute;
  top: 15px;
  right: 35px;
  color: #f1f1f1;
  font-size: 40px;
  font-weight: bold;
  transition: 0.3s;
}

.close:hover,
.close:focus {
  color: #bbb;
  text-decoration: none;
  cursor: pointer;
}

</style>

    <div id="preloder">
        <div class="loader"></div>
    </div>

    <?php require_once __DIR__.'/resource/navbar.php'; ?>

    <section class="blog spad" style="margin-top: 100px;">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title center-title">
                        <h2>Latest Review <?=$customer?><?=$shop?></h2>
                    </div>
                </div>
            </div>
            <div class="row mt-4" style="margin-top: 200px;">
                <?php
                                $sql = "SELECT * FROM tbl_portfolio WHERE type = '".$test_id."'";
                                $stmt=$db->prepare($sql);
                                $stmt->execute();
                                while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
                                    $id = $row['id'];
                                    $picture = $row['picture'];
                                    $detail = $row['detail'];
                                    $user_id = $row['user_id'];

                                    $sql2 = "SELECT * FROM tbl_users WHERE id = :user_id";
                                    $stmt=$db->prepare($sql2);
                                    $stmt->bindparam(':user_id', $user_id);
                                    $stmt->execute();
                                    $row2=$stmt->fetch(PDO::FETCH_ASSOC);
                                        $firstname = $row2['firstname'];
                                        $lastname = $row2['lastname'];
                            ?>
                <div class="col-lg-4 col-md-4 col-sm-6">
                    <div class="blog__item">
                        <div class="blog__item__pic">
                            <img src="backend/img/port/<?=$picture?>" alt="" id="myImg">
                        </div>
                        <div class="blog__item__text">
                            <ul>
                                <li>By <?=$firstname?> <?=$lastname?></li>
                            </ul>
                            <p><?=$detail?></p>
                        </div>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>
    </section>


    <div id="myModal" class="modal">
        <span class="close">&times;</span>
        <img class="modal-content" id="img01">
        <div id="caption"></div>
    </div>

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
                            <label for="prefixname">คำนำหน้านาม</label>
                            <select name="prefixname" id="prefixname" class="form-control">
                                <option>นาย</option>
                                <option>นาง</option>
                                <option>นางสาว</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="firstname" style="margin-top: 10px;">ชื่อ</label>
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
    <script>
// Get the modal
var modal = document.getElementById("myModal");

// Get the image and insert it inside the modal - use its "alt" text as a caption
var img = document.getElementById("myImg");
var modalImg = document.getElementById("img01");
var captionText = document.getElementById("caption");
img.onclick = function(){
  modal.style.display = "block";
  modalImg.src = this.src;
  captionText.innerHTML = this.alt;
}

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks on <span> (x), close the modal
span.onclick = function() { 
  modal.style.display = "none";
}
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