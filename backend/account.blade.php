<?php 
session_start(); 
include('db/connectpdo.php'); 
$email = $_SESSION['email'];
$sql = "SELECT email FROM tbl_admin WHERE email = :email";
$stmt=$db->prepare($sql);
$stmt->bindparam(':email', $email);
$stmt->execute();
$row=$stmt->fetch(PDO::FETCH_ASSOC);
    $id = $row['email'];

$sql1 = "SELECT salary,id FROM tbl_tech WHERE email = :id";
$stmt1=$db->prepare($sql1);
$stmt1->bindparam(':id', $id);
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
            </div>
        </div>
    </div>    

        <?php require_once __DIR__.'/resources/script.php'; ?>
</body>

</html>