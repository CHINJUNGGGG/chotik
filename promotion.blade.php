<?php 
session_start();
require_once __DIR__.'/db/connectpdo.php';
?>

<!DOCTYPE html>
<html lang="zxx">

<head>
    <?php require_once __DIR__.'/resource/head.php'; ?>
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/css/bootstrap-datetimepicker.min.css" />
</head>


<body>

    <div id="preloder">
        <div class="loader"></div>
    </div>

    <?php require_once __DIR__.'/resource/navbar.php'; ?>

    <section class="application-form courses--page spad" style="margin-top: 100px;">
        <div class="container">
            <div class="application__form__content">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="section-title center-title">
                            <h2>BOOKING</h2>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 text-center">
                        <?php if (isset($_SESSION['id'])) { ?>
                        <button type="button" class="site-btn second-bg" data-toggle="modal"
                            data-target="#buyModal">BOOKING NOW</button>
                        <?php }else{ ?>
                        <button type="button" class="site-btn second-bg" data-toggle="modal"
                            data-target="#loginModal">BOOKING NOW</button>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="courses spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-7 col-md-7 col-sm-7">
                    <div class="section-title">
                        <h2>Our Promotion</h2>
                    </div>
                </div>
                <div class="col-lg-5 col-md-5 col-sm-5">
                    <div class="courses__all">

                    </div>
                </div>
            </div>
            <div class="row">
                <?php
                    $sql = "SELECT * FROM tbl_promotion ORDER BY id DESC";
                    $stmt=$db->prepare($sql);
                    $stmt->execute();
                    while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
                        $id = $row['id'];
                        $pro_name = $row['pro_name'];
                        $pro_price = $row['pro_price'];
                        $pro_img = $row['pro_img'];
                        $pro_detail = $row['pro_detail'];
                ?>
                <div class="col-lg-4 col-md-4 col-sm-6">
                    <div class="course__item">
                        <img src="backend/img/promotion/<?=$pro_img?>" alt="">
                        <h5><?=$pro_name?></h5>
                        <h4>฿ <?=$pro_price?></h4>
                        <p><?=$pro_detail?></p>
                        <?php if (isset($_SESSION['id'])) { ?>
                        <a href="#" data-toggle="modal" data-target="#promotion" data-id="<?=$id?>">Buy</a>
                        <?php }else{ ?>
                        <a href="#" data-toggle="modal" data-target="#loginModal">Buy</a>
                        <?php } ?>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>
    </section>


    <div class="modal fade" id="promotion" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Modal</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="promotion_form" method="POST" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="pro_name">ชื่อโปรโมชั่น</label>
                            <input type="text" class="form-control" name="pro_name" id="pro_name" readonly>
                        </div>
                        <div class="form-group" style="margin-top: 20px;">
                            <label for="b_date">วันที่จะจอง</label>
                            <input type="date" class="form-control" name="b_date" id="b_date" required>
                        </div>
                        <div class="form-group" style="margin-top: 20px;">
                            <label for="start_time">ช่วงเวลาจอง</label>
                            <input type="text" class="form-control" name="start_time" id="time" value="23:06"
                                min="08:30" max="18:30">
                        </div>
                        <div class="form-group" style="margin-bottom: 40px;">
                            <label for="tech_id">ช่างที่ท่านต้องการจองคิว</label>
                            <select class="form-control" name="tech_id" id="tech_id">
                                <option>กรุณาเลือก</option>
                                <?php
                                    $sql = "SELECT * FROM tbl_tech WHERE status = 0";
                                    $stmt=$db->prepare($sql);
                                    $stmt->execute();
                                    while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
                                        $id = $row['id'];
                                        $firstname = $row['firstname'];
                                        $lastname = $row['lastname'];
                                        $picture = $row['picture'];
                                ?>
                                <option data-thumbnail="backend/img/tech/<?=$picture?>" value="<?=$id?>"><?=$firstname?>
                                    <?=$lastname?>
                                </option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="pro_price">ราคา (บาท)</label>
                            <input type="text" class="form-control" name="pro_price" id="pro_price" readonly>
                        </div>
                        <div class="form-group" style="margin-top: 20px; margin-left: -20px;">
                            <div class="form-check">
                                <input class="number1" type="checkbox" id="check2">
                                <label class="form-check-label" for="check">
                                    test1
                                </label>
                            </div>
                        </div>
                        <div class="form-group" style="margin-top: 10px; margin-left: -20px;">
                            <div class="form-check">
                                <input class="number1" type="checkbox" id="check2">
                                <label class="form-check-label" for="check">
                                    test2
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิดหน้าต่าง</button>
                        <button type="submit" name="submit" id="btn1" class="btn btn-primary" disabled>ซื้อ</button>
                        <input type="hidden" name="do" value="promotion">
                        <input type="hidden" name="id" id="id">
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="buyModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Booking</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="booking_form" method="POST" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="form-group mb-2">
                            <div class="row">
                                <?php
                                $sql = "SELECT * FROM tbl_list";
                                $stmt=$db->prepare($sql);
                                $stmt->execute();
                                while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
                                    $id1 = $row['id'];
                                    $list_name = $row['list_name'];
                            ?>
                                <div class="col-6">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="<?=$id1?>"
                                            name="check[ ]" id="defaultCheck1">
                                        <label class="form-check-label" for="defaultCheck1">
                                            <?=$list_name?>
                                        </label>
                                    </div>
                                </div>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="form-group" style="margin-top: 20px;">
                            <label for="lastname">วันที่จะจอง</label>
                            <input type="date" class="form-control" name="b_date" id="b_date" required>
                        </div>
                        <div class="form-group" style="margin-top: 20px;">
                            <label for="lastname">ช่วงเวลาจอง</label>
                            <input type="text" class="form-control" name="b_start_time" id="time" value="00:00"
                                min="08:30" max="18:30">
                        </div>
                        <div class="form-group" style="margin-bottom: 40px;">
                            <label for="firstname">ช่างที่ท่านต้องการจองคิว</label>
                            <select class="form-control" name="tech_id" id="tech_id">
                                <option value="0">กรุณาเลือก</option>
                                <?php
                                    $sql = "SELECT * FROM tbl_tech WHERE status = 0";
                                    $stmt=$db->prepare($sql);
                                    $stmt->execute();
                                    while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
                                        $id = $row['id'];
                                        $firstname = $row['firstname'];
                                        $lastname = $row['lastname'];
                                        $picture = $row['picture'];
                                ?>
                                <option data-thumbnail="backend/img/tech/<?=$picture?>" value="<?=$id?>"><?=$firstname?>
                                    <?=$lastname?>
                                </option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group" style="margin-top: 60px; margin-left: -20px;">
                            <div class="form-check">
                                <input class="number" type="checkbox" id="check">
                                <label class="form-check-label" for="check">
                                    test1
                                </label>
                            </div>
                        </div>
                        <div class="form-group" style="margin-top: 10px; margin-left: -20px;">
                            <div class="form-check">
                                <input class="number" type="checkbox" id="check1">
                                <label class="form-check-label" for="check">
                                    test2
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิดหน้าต่าง</button>
                        <button type="submit" name="submit" id="btn" class="btn btn-primary" disabled>ยืนยัน</button>
                        <input type="hidden" name="do" value="booking">
                    </div>
                </form>
            </div>
        </div>
    </div>

    <?php require_once __DIR__.'/resource/script.php'; ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.6/moment.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <script
        src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js">
    </script>
    <script>
        $(".number").on("click", function() {
            if($(".number:checked").length >= 2){
                $('#btn').prop('disabled', false);
            }else{
                $('#btn').prop('disabled', true);
            }  
        });
    </script>
       <script>
        $(".number1").on("click", function() {
            if($(".number1:checked").length >= 2){
                $('#btn1').prop('disabled', false);
            }else{
                $('#btn1').prop('disabled', true);
            }  
        });
    </script>
    <script>
    $(document).ready(function() {
        $('#promotion').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var id = button.data('id')
            var modal = $(this)

            $.ajax({
                type: "POST",
                url: "controller/bookingController.php",
                data: {
                    id: id,
                    do: 'view_promotion'
                },
                dataType: "json",
                success: function(response) {
                    console.log(response)
                    var arr_input_key = ['pro_name', 'pro_price', 'id']
                    $.each(response, function(indexInArray, valueOfElement) {
                        if (jQuery.inArray(indexInArray, arr_input_key) !== -
                            1) {
                            if (valueOfElement != '') {
                                modal.find('input[name="' + indexInArray + '"]')
                                    .val(valueOfElement)
                            }
                        }
                    });
                    modal.find('#id').val(id)
                }
            });
        })
    });
    </script>
    <script>
    $('[name="b_start_time"]').datetimepicker({
        format: 'HH:mm:ss'
    });
    </script>
    <script>
    $('[name="start_time"]').datetimepicker({
        format: 'HH:mm:ss'
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
                    if (response == "no") {
                        swal("ช่างถูกจองคิวไปแล้ว", {
                            icon: "warning",
                        });
                    }
                    if (response == "time") {
                        swal("กรุณาเลือกช่วงเวลา", {
                            icon: "warning",
                        });
                    }
                    if (response == "tech") {
                        swal("กรุณาเลือกช่าง", {
                            icon: "warning",
                        });
                    }
                    if (response == "Time_out") {
                        swal("วัน-เวลานี้ได้มีทำการจองไปแล้ว หรือ ช่างที่ท่านเลือกคิวไม่ว่าง", {
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
    $(document).ready(function(e) {
        $("#promotion_form").on('submit', (function(e) {
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
                    if (response == "Time_out") {
                        swal("วัน-เวลานี้ได้มีทำการจองไปแล้ว หรือ ช่างที่ท่านเลือกคิวไม่ว่าง", {
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