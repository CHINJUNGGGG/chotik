<?php 
session_start(); 
include('db/connectpdo.php'); 
?>
<!doctype html>
<html class="no-js" lang="en">

<head><?php require_once __DIR__.'/resources/head.php'; ?></head>
<style>
table.dataTable thead .sorting_asc:before,
table.dataTable thead .sorting_desc:after {
    opacity: 0.0003;
}

table.dataTable thead .sorting:after,
table.dataTable thead .sorting_asc:after,
table.dataTable thead .sorting_desc:after,
table.dataTable thead .sorting_asc_disabled:after,
table.dataTable thead .sorting_desc_disabled:after {
    right: 0.5em;
    content: "\2193";
    opacity: 0.0003;
}

table.dataTable thead .sorting:before,
table.dataTable thead .sorting_asc:before,
table.dataTable thead .sorting_desc:before,
table.dataTable thead .sorting_asc_disabled:before,
table.dataTable thead .sorting_desc_disabled:before {
    right: 1em;
    content: "\2191";
    opacity: 0.0003;
}

.nav-pills .nav-link.active,
.nav-pills .show>.nav-link {
    color: #fff;
    background-color: #4336fb !important;
}
</style>

<body>

    <div id="preloader">
        <div class="loader"></div>
    </div>


    <div class="page-container">

        <?php require_once __DIR__.'/resources/sidebar.php'; ?>

        <div class="main-content">

            <?php require_once __DIR__.'/resources/navbar.php'; ?>

            <div class="page-title-area">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <div class="breadcrumbs-area clearfix">
                            <h4 class="page-title pull-left">Home</h4>
                            <ul class="breadcrumbs pull-left">
                                <li><a href="index.blade.php">Home</a></li>
                                <li><a href="view.user.blade.php">Booking</a></li>
                            </ul>
                        </div>
                    </div>
                    <?php if (isset($_SESSION['id'])) { ?>
                    <div class="col-sm-6 clearfix">
                        <div class="user-profile pull-right">
                            <img class="avatar user-thumb" src="assets/images/author/avatar.png" alt="avatar">
                            <h4 class="user-name dropdown-toggle" data-toggle="dropdown">
                                <?php echo $_SESSION['firstname'];?> <?php echo $_SESSION['lastname'];?> <i
                                    class="fa fa-angle-down"></i></h4>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="logout.blade.php">Log Out</a>
                            </div>
                        </div>
                    </div>
                    <?php 
                        }else{
                            echo "<script>";
                            echo "alert('Please Sign in, Go to login page');";
                            echo "window.location.href='login.blade.php';";
                            echo "</script>";
                        } 
                    ?>
                </div>
            </div>

            <div class="main-content-inner">

                <div class="row">
                    <div class="col-12 mt-5">
                        <div class="card">
                            <div class="card-header" style="border-bottom: 1px solid rgb(247 247 247) !important;">
                                <h5>Data Booking</h5>
                            </div>
                            <div class="card-body">
                                <div class="data-tables datatable-primary">
                                    <table id="dataTable2" class="text-center">
                                        <thead class="text-capitalize" style="background-color: #000;">
                                            <tr>
                                                <th class="text-center">
                                                    <!-- <input type="checkbox" name="check" class="head_input"
                                                    id="example-select-all"> -->
                                                    #
                                                </th>
                                                <th>วันที่จอง</th>
                                                <th>เวลาที่จอง</th>
                                                <th>รายการที่จอง</th>
                                                <th>ลูกค้าที่จอง</th>
                                                <th>ช่างที่รับผิดชอบ</th>
                                                <th>สถานะ</th>
                                                <th></th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <?php
                                                $i=0;
                                                $sql = "SELECT * FROM tbl_booking ORDER BY id DESC";
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
                                                    <?=$id?>
                                                </td>
                                                <td><?=$b_date?></td>
                                                <td><?=$start_time?></td>
                                                <td><?=$list_name?></td>
                                                <td><?=$firstname?> <?=$lastname?></td>
                                                <td><?=$firstname1?> <?=$lastname1?></td>
                                                <td>
                                                <?php 
                                                    if($b_status == '0'){ echo '<font style="color: orange; font-weight: bold;">รอการรับจอง</font>'; 
                                                    }else if($b_status == '1'){ echo '<font style="color: green; font-weight: bold;">รับจองแล้ว</font>'; 
                                                    }else if($b_status == '2'){ echo '<font style="color: red; font-weight: bold;">ยกเลิกการจองโดยระบบ</font>'; 
                                                    }else if($b_status == '3'){ echo '<font style="color: red; font-weight: bold;">ยกเลิกการโดยลูกค้า</font>'; 
                                                    }else{ echo '<font style="color: blue; font-weight: bold;">แบ่งเงินสำเร็จ</font>'; }
                                                ?>
                                                </td>
                                                <td>
                                                    <?php 
                                                    if($b_status == '0'){
                                                        echo '<a href="controller/bookingController.php?id='.$id.'"><button type="button" class="btn btn-sm btn-success" onclick="return confirm("คุณต้องการอนุมัติรายการนี้ ใช่หรือไม่ ?")">รับจอง</button></a> 
                                                              <a href="controller/cancelController.php?id='.$id.'"><button type="button" class="btn btn-sm btn-danger" onclick="return confirm("คุณต้องการทำรายการนี้ ใช่หรือไม่ ?")">ไม่รับจอง</button></a>';
                                                    }else if($b_status == '1'){
                                                        echo '<a href="controller/salaryController.php?id='.$id.'"><button type="button" class="btn btn-sm btn-info" onclick="return confirm("คุณต้องการทำรายการนี้ ใช่หรือไม่ ?")">แบ่งเงิน</button></a> ';
                                                    }else{
                                                        echo " ";
                                                    }
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



        <?php require_once __DIR__.'/resources/script.php'; ?>
        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
            integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
        </script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
        <script>
        $(document).ready(function(e) {
            $("#success").on('submit', (function(e) {
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