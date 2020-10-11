<?php 
session_start();
require_once __DIR__.'/db/connectpdo.php';
$user_id = $_SESSION['id'];
$data = array();
$sql = "SELECT id,b_date,b_time,b_end_date,b_list,b_start_time FROM tbl_booking WHERE b_status = '0' AND user_id = '".$user_id."' AND promotion IS NULL";
$stmt=$db->prepare($sql);
$stmt->execute();
while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
    $id = $row['id'];
    $b_list = $row['b_list'];
    $b_date = $row['b_date'];
    $b_time = $row['b_time'];
    $b_start_time = $row['b_start_time'];
    $b_end_date = $row['b_end_date'];

$sql1 = "SELECT list_name FROM tbl_list WHERE id = :b_list";
$stmt1=$db->prepare($sql1);
$stmt1->bindparam(':b_list', $b_list);
$stmt1->execute();
$row1=$stmt1->fetch(PDO::FETCH_ASSOC);
    $list_name = $row1['list_name'];
    $data[] = array(
        'id' => $id,
        'title'=> $list_name,
        'start'=> $b_date,
        'end'=> $b_end_date
    );
}
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



    <div class="container" style="margin-top: 140px;">
        <div class="row">
            <div class="col-8">
                <div id="calendar"></div>
            </div>
            <div class="col-4">
                <?php
                    $sql4 = "SELECT b_date FROM tbl_booking WHERE b_status = '0' AND user_id = '".$user_id."' GROUP BY b_date";
                    $stmt4=$db->prepare($sql4);
                    $stmt4->execute();
                    while($row4=$stmt4->fetch(PDO::FETCH_ASSOC)){
                        $b_date4 = $row4['b_date'];  

                        function DateThai($b_date4){
                            $year = date("Y",strtotime($b_date4))+543;
                            $month= date("n",strtotime($b_date4));
                            $day= date("j",strtotime($b_date4));
                            $monthcut = Array("","มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน","กรกฎาคม","สิงหาคม","กันยายน","ตุลาคม","พฤษจิกายน","ธันวาคม");
                            $monththai=$monthcut[$month];
                            return "$day $monththai $year";
                        }  
                ?>
                <div class="card mb-2">
                    <div class="card-header">
                        <?php echo DateThai($b_date4); ?>
                    </div>
    
                    <div class="card-body">
                <?php
                    $sql2 = "SELECT * FROM tbl_booking WHERE b_date = '".$b_date4."' AND b_status = '0' AND user_id = '".$user_id."' AND promotion IS NULL";
                    $stmt2=$db->prepare($sql2);
                    $stmt2->execute();
                    while($row2=$stmt2->fetch(PDO::FETCH_ASSOC)){
                        $id2 = $row2['id'];
                        $b_list2 = $row2['b_list'];
                        $b_date2 = $row2['b_date'];
                        $b_end_date2 = $row2['b_end_date'];
                        
                    $sql3 = "SELECT list_name FROM tbl_list WHERE id = :b_list2";
                    $stmt3=$db->prepare($sql3);
                    $stmt3->bindparam(':b_list2', $b_list2);
                    $stmt3->execute();
                    $row3=$stmt3->fetch(PDO::FETCH_ASSOC);
                        $list_name3 = $row3['list_name'];  
                    
                ?>
                        <div class="alert alert-secondary" role="alert">
                            <?=$list_name3?>
                        </div>
                <?php } ?>
                <?php
                    $sql5 = "SELECT * FROM tbl_booking WHERE b_date = '".$b_date4."' AND b_status = '0' AND user_id = '".$user_id."' AND b_list IS NULL";
                    $stmt5=$db->prepare($sql5);
                    $stmt5->execute();
                    while($row5=$stmt5->fetch(PDO::FETCH_ASSOC)){
                        $promotion = $row5['promotion'];
                        
                    $sql6 = "SELECT pro_name FROM tbl_promotion WHERE id = :promotion";
                    $stmt6=$db->prepare($sql6);
                    $stmt6->bindparam(':promotion', $promotion);
                    $stmt6->execute();
                    $row6=$stmt6->fetch(PDO::FETCH_ASSOC);
                        $pro_name = $row6['pro_name'];  
                    
                ?>
                        <div class="alert alert-info" role="alert">
                            <?=$pro_name?>
                        </div>
                <?php } ?>
                    </div>
                <?php

                    $sql5 = "SELECT SUM(b_price) as sum,SEC_TO_TIME(SUM(time_to_sec(`tbl_booking`.`b_time`))) 
                    As timeSum FROM tbl_booking WHERE b_date = '".$b_date4."' AND b_status = '0' AND user_id = '".$user_id."'";
                    $stmt5=$db->prepare($sql5);
                    $stmt5->execute();
                    while($row5=$stmt5->fetch(PDO::FETCH_ASSOC)){
                        $time = $row5['timeSum'];
                        $time1 = (substr($time, 0, 2));
                        $time2 = (substr($time, 3, 2));
                        $time3 = (substr($time, 6, 2));
                        $real = $time1.'  '.'ชั่วโมง';
                        $real1 = $time2.'  '.'นาที';
                        $real2 = $time3.'  '.'วินาที';
                        $real_time = $real.' '.$real1;
                        $sum = $row5['sum'];
                        $sum = number_format($sum);
                ?>
                    <div class="card-footer text-muted">
                        <div class="row">
                            <div class="col-6">
                                <?=$real_time?>  
                            </div>
                            <div class="col-6 d-flex justify-content-end">
                                <?=$sum?> บาท
                            </div>
                        </div>
                    </div>
                <?php } ?>    
                </div>
                <?php } ?>
            </div>
        </div>
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
    <script>
    $(document).ready(function() {
        $('#calendar').fullCalendar({
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month,basicWeek,basicDay'
            },
            defaultDate: '<?php echo date('Y-m-d');?>',
            editable: true,
            eventLimit: true, // allow "more" link when too many events
            events: <?php echo json_encode($data);?>,
            textColor: '#ffffff',
            eventColor: '#000'

        });
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