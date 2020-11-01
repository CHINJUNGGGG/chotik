<?php 
session_start();
require_once __DIR__.'/db/connectpdo.php';
$user_id = $_SESSION['id'];
$data = array();
$sql = "SELECT id,b_date,b_time,b_end_date,b_list,b_start_time FROM tbl_booking WHERE user_id = '".$user_id."' AND promotion IS NULL";
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
            <div class="col-7">
                <div id="calendar"></div>
            </div>
            <div class="col-5">
                <?php
                    $sql4 = "SELECT * FROM tbl_booking WHERE user_id = '".$user_id."' GROUP BY b_date";
                    $stmt4=$db->prepare($sql4);
                    $stmt4->execute();
                    while($row4=$stmt4->fetch(PDO::FETCH_ASSOC)){
                        $b_date4 = $row4['b_date']; 
                        $b_status = $row4['b_status'];  

                        // function DateThai($b_date4){
                        //     $year = date("Y",strtotime($b_date4))+543;
                        //     $month= date("n",strtotime($b_date4));
                        //     $day= date("j",strtotime($b_date4));
                        //     $monthcut = Array("","มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน","กรกฎาคม","สิงหาคม","กันยายน","ตุลาคม","พฤษจิกายน","ธันวาคม");
                        //     $monththai=$monthcut[$month];
                        //     return "$day $monththai $year";
                        // }  
                ?>
                <div class="card mb-2">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-6 text-left">
                                <?=$b_date4?>
                            </div>
                            <!-- <div class="col-6 text-right">
                                <?php if($b_status == '0'){ ?>
                                <p style="color: orange; font-weight: bold; margin-bottom: -20px;">รอการรับจอง</p>
                                <?php }else if($b_status == '1'){ ?>
                                <p style="color: green; font-weight: bold; margin-bottom: -20px;">รับจองแล้ว</p>
                                <?php }else if($b_status == '2'){ ?>
                                <p style="color: red; font-weight: bold; margin-bottom: -20px;">ยกเลิกการจองโดยระบบ</p>
                                <?php }else if($b_status == '3'){ ?>
                                <p style="color: red; font-weight: bold; margin-bottom: -20px;">ยกเลิกการจองของลูกค้า</p>
                                <?php }else{ ?>
                                <p style="color: green; font-weight: bold; margin-bottom: -20px;">ทำรายการเสร็จสิ้น</p>
                                <?php } ?>
                            </div> -->
                        </div>
                    </div>
    
                    <div class="card-body">
                <?php
                    $sql2 = "SELECT * FROM tbl_booking WHERE b_date = '".$b_date4."' AND user_id = '".$user_id."' AND promotion IS NULL";
                    $stmt2=$db->prepare($sql2);
                    $stmt2->execute();
                    while($row2=$stmt2->fetch(PDO::FETCH_ASSOC)){
                        $id2 = $row2['id'];
                        $b_list2 = $row2['b_list'];
                        $b_start_date = $row2['b_start_date'];
                        $b_date2 = $row2['b_date'];
                        $b_status = $row2['b_status'];
                        $b_end_date2 = $row2['b_end_date'];
                        
                    $sql3 = "SELECT list_name FROM tbl_list WHERE id = :b_list2";
                    $stmt3=$db->prepare($sql3);
                    $stmt3->bindparam(':b_list2', $b_list2);
                    $stmt3->execute();
                    $row3=$stmt3->fetch(PDO::FETCH_ASSOC);
                        $list_name3 = $row3['list_name'];  
                    
                ?>
                        <div class="alert alert-secondary" role="alert">
                            <div class="row">
                                <div class="col-1 text-left">
                                    <?php if($b_status == '0'){ ?>
                                        <a href="controller/cancelController.php?id=<?=$id2?>" onclick="return confirm('คุณต้องการทำรายการนี้ ใช่หรือไม่ ?')"><span class="badge badge-danger">X</span></a>
                                    <?php } ?>
                                    <?php if($b_status == '1'){ ?>
                                        <a href="controller/cancelController.php?id=<?=$id2?>" onclick="return confirm('คุณต้องการทำรายการนี้ ใช่หรือไม่ ?')"><span class="badge badge-danger">X</span></a>
                                    <?php } ?>   
                                    <?php if($b_status == '4'){ ?>
                                        <span class="badge badge-success" style="width: 17px;">/</span>
                                    <?php } ?>   
                                </div>
                                <div class="col-3 text-left">
                                    <?=$list_name3?>
                                </div>
                                <div class="col-8 text-right">
                                    <?php if($b_status == '0'){ ?>
                                    <p style="color: orange; font-weight: bold; margin-bottom: -20px;">รอการรับจอง</p>
                                    <?php }else if($b_status == '1'){ ?>
                                    <p style="color: green; font-weight: bold; margin-bottom: -20px;">รับจองแล้ว</p>
                                    <?php }else if($b_status == '2'){ ?>
                                    <p style="color: red; font-weight: bold; margin-bottom: -20px;">ยกเลิกการจองโดยระบบ</p>
                                    <?php }else if($b_status == '3'){ ?>
                                    <p style="color: red; font-weight: bold; margin-bottom: -20px;">ยกเลิกการจองโดยลูกค้า</p>
                                    <?php }else{ ?>
                                    <p style="color: green; font-weight: bold; margin-bottom: -20px;">ทำรายการเสร็จสิ้น</p>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                <?php } ?>
                <?php
                    $sql5 = "SELECT * FROM tbl_booking WHERE b_date = '".$b_date4."' AND user_id = '".$user_id."' AND b_list IS NULL ";
                    $stmt5=$db->prepare($sql5);
                    $stmt5->execute();
                    while($row5=$stmt5->fetch(PDO::FETCH_ASSOC)){
                        $promotion = $row5['promotion'];
                        $id3 = $row5['id'];
                        
                    $sql6 = "SELECT pro_name FROM tbl_promotion WHERE id = :promotion";
                    $stmt6=$db->prepare($sql6);
                    $stmt6->bindparam(':promotion', $promotion);
                    $stmt6->execute();
                    $row6=$stmt6->fetch(PDO::FETCH_ASSOC);
                        $pro_name = $row6['pro_name'];  
                    
                ?>
                        <div class="alert alert-info" role="alert">
                            <div class="row">
                                <div class="col-1 text-left">
                                    <a href="controller/cancelController.php?id=<?=$id3?>"><span class="badge badge-danger">x</span></a>
                                </div>
                                <div class="col-3 text-left">
                                    <?=$pro_name?>
                                </div>
                                <div class="col-8 text-right">
                                    <?php if($b_status == '0'){ ?>
                                    <p style="color: orange; font-weight: bold; margin-bottom: -20px;">รอการรับจอง</p>
                                    <?php }else if($b_status == '1'){ ?>
                                    <p style="color: green; font-weight: bold; margin-bottom: -20px;">รับจองแล้ว</p>
                                    <?php }else if($b_status == '2'){ ?>
                                    <p style="color: red; font-weight: bold; margin-bottom: -20px;">ยกเลิกการจองโดยระบบ</p>
                                    <?php }else if($b_status == '3'){ ?>
                                    <p style="color: red; font-weight: bold; margin-bottom: -20px;">ยกเลิกการจองของลูกค้า</p>
                                    <?php }else{ ?>
                                    <p style="color: green; font-weight: bold; margin-bottom: -20px;">ทำรายการเสร็จสิ้น</p>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                <?php } ?>
                    </div>
                <?php

                    $sql5 = "SELECT SUM(b_price) as sum,SEC_TO_TIME(SUM(time_to_sec(`tbl_booking`.`b_time`))) 
                    As timeSum FROM tbl_booking WHERE b_date = '".$b_date4."' AND user_id = '".$user_id."'";
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