<?php 
session_start();
require_once __DIR__.'/db/connectpdo.php';
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

.image1 {
  display: block;
  width: 100%;
  height: auto;
}

.overlay1 {
  position: absolute;
  top: 0;
  bottom: 0;
  left: 0;
  right: 0;
  height: 100%;
  width: 100%;
  opacity: 0;
  transition: .5s ease;
  background-color: #008CBA;
}

.container:hover .overlay1 {
  opacity: 1;
}

.text1 {
  color: white;
  font-size: 20px;
  position: absolute;
  top: 50%;
  left: 50%;
  -webkit-transform: translate(-50%, -50%);
  -ms-transform: translate(-50%, -50%);
  transform: translate(-50%, -50%);
  text-align: center;
}

</style>
<style>
.column {
	margin: 15px 15px 0;
	padding: 0;
}
.column:last-child {
	padding-bottom: 60px;
}
.column::after {
	content: '';
	clear: both;
	display: block;
}
.column div {
	position: relative;
	float: left;
	width: 300px;
	height: 200px;
	margin: 0 0 0 25px;
	padding: 0;
}
.column div:first-child {
	margin-left: 0;
}
.column div span {
	position: absolute;
	bottom: -20px;
	left: 0;
	z-index: -1;
	display: block;
	width: 300px;
	margin: 0;
	padding: 0;
	color: #444;
	font-size: 18px;
	text-decoration: none;
	text-align: center;
	-webkit-transition: .3s ease-in-out;
	transition: .3s ease-in-out;
	opacity: 0;
}
figure {
	width: 300px;
	height: 200px;
	margin: 0;
	padding: 0;
	background: #fff;
	overflow: hidden;
}
figure:hover+span {
	bottom: -36px;
	opacity: 1;
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
                                $sql = "SELECT * FROM tbl_portfolio WHERE type = 2 ORDER BY id DESC";
                                $stmt=$db->prepare($sql);
                                $stmt->execute();
                                $row=$stmt->fetch(PDO::FETCH_ASSOC);
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
                            <div class="column">
                                <div>
                                    <figure>
                                        <a href="portfolio.blade.php?id=2&id2=Shop">
                                            <img src="backend/img/port/<?=$picture?>" alt="" class="image" style="widht: 150px; height:220px;">
                                        </a>
                                    </figure>
                                    <span>Review by Shop</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <?php
                                $sql4 = "SELECT * FROM tbl_portfolio WHERE type = 1 ORDER BY id DESC";
                                $stmt4=$db->prepare($sql4);
                                $stmt4->execute();
                                $row4=$stmt4->fetch(PDO::FETCH_ASSOC);
                                    $id4 = $row4['id'];
                                    $picture4 = $row4['picture'];
                                    $detail4 = $row4['detail'];
                                    $user_id4 = $row4['user_id'];

                                    $sql5 = "SELECT * FROM tbl_users WHERE id = :user_id4";
                                    $stmt5=$db->prepare($sql5);
                                    $stmt5->bindparam(':user_id4', $user_id4);
                                    $stmt5->execute();
                                    $row5=$stmt5->fetch(PDO::FETCH_ASSOC);
                                        $firstname4 = $row5['firstname'];
                                        $lastname4 = $row5['lastname'];
                            ?>
                <div class="col-lg-4 col-md-4 col-sm-6">
                    <div class="blog__item">
                        <div class="blog__item__pic">
                            <div class="column">
                                <div>
                                    <figure>
                                        <a href="portfolio.blade.php?id=1&id1=Customer">
                                            <img src="backend/img/port/<?=$picture4?>" alt="" class="image" style="widht: 150px; height:220px;">
                                        </a>
                                    </figure>
                                    <span>Review by Customer</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </section>


    <div id="myModal" class="modal">
        <span class="close">&times;</span>
        <img class="modal-content" id="img01">
        <div id="caption"></div>
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