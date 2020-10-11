<?php 
session_start();
$status = $_SESSION['status'];
?>
       
       <div class="sidebar-menu">
            <div class="sidebar-header">
                <div class="logo">
                    <a href="index.blade.php" style="color: #fff;">CHOTIK</a>
                </div>
            </div>
            <div class="main-menu">
                <div class="menu-inner">
                    <nav>
                        <ul class="metismenu" id="menu">
            
                        <?php
                            if(isset($_SESSION['id'])){
                                if($status == '0'){
                                    echo 
                                    '<li class="">
                                        <a href="index.blade.php"><i class="ti-dashboard"></i><span>Homepage</span></a>
                                    </li>
                                    <li class="">
                                        <a href="customer.blade.php"><i class="ti-user"></i><span>Customer</span></a>
                                    </li>
                                    <li class="">
                                        <a href="booking.blade.php"><i class="fa fa-calendar-check-o"></i><span>Booking</span></a>
                                    </li>
                                    <li class="">
                                        <a href="technician.blade.php"><i class="fa fa-object-group"></i><span>Technician</span></a>
                                    </li>
                                    <li class="">
                                        <a href="promotion.blade.php"><i class="fa fa-heart"></i><span>Promotion</span></a>
                                    </li>
                                    <li class="">
                                        <a href=javascript:void(0)"><i class="fa fa-picture-o"></i><span>Portfolio</span></a>
                                        <ul class="collapse">
                                            <li><a href="portfolio.cus.blade.php">Customer</a></li>
                                            <li><a href="portfolio.shop.blade.php">Shop</a></li>
                                        </ul>
                                    </li>
                                    <li class="">
                                        <a href="admin.blade.php"><i class="fa fa-file-o"></i><span>Admin Management</span></a>
                                    </li>
                                    <li class="">
                                        <a href="logout.blade.php"><i class="ti-dashboard"></i><span>Logout</span></a>
                                    </li>';
                                }else{
                                    echo 
                                    '<li class="">
                                        <a href="account.blade.php"><i class="ti-dashboard"></i><span>Accounting</span></a>
                                    </li>
                                    <li class="">
                                        <a href="logout.blade.php"><i class="ti-dashboard"></i><span>Logout</span></a>
                                    </li>';
                                }
                            }else{
                                echo "<script>";
                                echo "alert('กรุณาล็อคอินเข้าสู่ระบบ');";
                                echo "window.location.href='login.blade.php';";
                                echo "</script>";
                            }     
                         
                        ?> 
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
