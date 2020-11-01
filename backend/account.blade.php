<?php 
session_start(); 
include('db/connectpdo.php'); 
$id = $_SESSION['id'];
$sql = "SELECT * FROM tbl_users WHERE id = :id";
$stmt=$db->prepare($sql);
$stmt->bindparam(':id', $id);
$stmt->execute();
$row=$stmt->fetch(PDO::FETCH_ASSOC);
    $email = $row['email'];

$sql1 = "SELECT salary,id FROM tbl_tech WHERE email = :email";
$stmt1=$db->prepare($sql1);
$stmt1->bindparam(':email', $email);
$stmt1->execute();
$row1=$stmt1->fetch(PDO::FETCH_ASSOC);
    $salary = $row1['salary']; 
    $tech_id = $row1['id'];    

$sql2 = "SELECT COUNT(id) as count FROM tbl_booking WHERE id = :tech_id";
$stmt2=$db->prepare($sql2);
$stmt2->bindparam(':tech_id', $tech_id);
$stmt2->execute();
$row2=$stmt2->fetch(PDO::FETCH_ASSOC);
    $count = $row2['count'];        
?>
<!doctype html>
<html class="no-js" lang="en">

<head><?php require_once __DIR__.'/resources/head.php'; ?></head>

<body>

    <div id="preloader">
        <div class="loader"></div>
    </div>

    <div class="page-container">
        <?php require_once __DIR__.'/resources/sidebar.php'; ?>

        <div class="main-content">
            <?php require_once __DIR__.'/resources/navbar.php'; ?>

            <div class="main-content-inner">
                <div class="row">
                    <!-- seo fact area start -->
                    <div class="col-lg-12">
                        <div class="row">
                            <div class="col-md-6 mt-5 mb-3">
                                <div class="card">
                                    <div class="seo-fact sbg1">
                                        <div class="p-4 d-flex justify-content-between align-items-center">
                                            <div class="seofct-icon"><i class="ti-thumb-up"></i> Quere</div>
                                            <h2><?=$count?></h2>
                                        </div>
                                        <canvas id="seolinechart1" height="50"></canvas>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mt-md-5 mb-3">
                                <div class="card">
                                    <div class="seo-fact sbg2">
                                        <div class="p-4 d-flex justify-content-between align-items-center">
                                            <div class="seofct-icon"><i class="ti-share"></i> Accounting</div>
                                            <h2>฿ <?=$salary?></h2>
                                        </div>
                                        <canvas id="seolinechart2" height="50"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <!-- seo fact area start -->
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header" style="border-bottom: 1px solid rgb(247 247 247) !important;">
                                <h5>Accounting</h5>
                            </div>
                            <div class="card-body">
                                <div class="data-tables datatable-primary">
                                    <table id="dataTable2" class="text-center">
                                        <thead class="text-capitalize" style="background-color: #000;">
                                            <tr>
                                                <th>#</th>
                                                <th>วันที่จอง</th>
                                                <th>เวลาที่จอง</th>
                                                <th>รายการที่จอง</th>
                                                <th>ลูกค้าที่จอง</th>
                                                <th>สถานะ</th>
                                      
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                                $i=0;
                                                $sql = "SELECT * FROM tbl_booking WHERE tech_id = '".$id."' ORDER BY id DESC";
                                                $stmt1=$db->prepare($sql);
                                                $stmt1->execute();
                                                while($row=$stmt1->fetch(PDO::FETCH_ASSOC)){
                                                    $id = $row['id'];
                                                    $b_list = $row['b_list'];
                                                    $start_time = $row['b_start_time'];
                                                    $b_date = $row['b_date'];
                                                    $user_id = $row['user_id'];
                                                    $tech_id = $row['tech_id'];
                                                    $b_status = $row['b_status'];
                                                    $i++;

                                                $sql1 = "SELECT * FROM tbl_list WHERE id = :b_list";
                                                $stmt=$db->prepare($sql1);
                                                $stmt->bindparam(':b_list', $b_list);
                                                $stmt->execute();
                                                $row1=$stmt->fetch(PDO::FETCH_ASSOC);
                                                    $list_name = $row1['list_name'];

                                                $sql2 = "SELECT * FROM tbl_users WHERE id = :user_id";
                                                $stmt=$db->prepare($sql2);
                                                $stmt->bindparam(':user_id', $user_id);
                                                $stmt->execute();
                                                $row2=$stmt->fetch(PDO::FETCH_ASSOC);
                                                    $firstname = $row2['firstname'];
                                                    $lastname = $row2['lastname'];

                                                $sql3 = "SELECT * FROM tbl_tech WHERE id = :tech_id";
                                                $stmt=$db->prepare($sql3);
                                                $stmt->bindparam(':tech_id', $tech_id);
                                                $stmt->execute();
                                                $row3=$stmt->fetch(PDO::FETCH_ASSOC);
                                                    $firstname1 = $row3['firstname'];
                                                    $lastname1 = $row3['lastname'];    
                                                ?>
                                             <tr>
                                                <td>
                                                    <!-- <input type="checkbox" name="id[]" class='checkbox1' value="<?=$id?>"> -->
                                                    <?=$i?>
                                                </td>
                                                <td>
                                                    <!-- <input type="checkbox" name="id[]" class='checkbox1' value="<?=$id?>"> -->
                                                    <?=$b_date?>
                                                </td>
                                                <td><?=$start_time?></td>
                                                <td><?=$list_name?></td>
                                                <td><?=$firstname?> <?=$lastname?></td>
                                                <td>
                                                <?php 
                                                    if($b_status == '0'){ echo '<font style="color: orange; font-weight: bold;">รอการรับจอง</font>'; 
                                                    }else if($b_status == '1'){ echo '<font style="color: green; font-weight: bold;">รับจองแล้ว</font>'; 
                                                    }else if($b_status == '2'){ echo '<font style="color: red; font-weight: bold;">ยกเลิกการจองโดยระบบ</font>'; 
                                                    }else if($b_status == '3'){ echo '<font style="color: red; font-weight: bold;">ยกเลิกการโดยลูกค้า</font>'; 
                                                    }else{ echo '<font style="color: blue; font-weight: bold;">แบ่งเงินสำเร็จ</font>'; }
                                                ?>
                                                </td>                                             
                                            </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>    

        <?php require_once __DIR__.'/resources/script.php'; ?>
</body>

</html>