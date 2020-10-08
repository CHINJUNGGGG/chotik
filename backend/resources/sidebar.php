<?php 
session_start();
$provider = $_SESSION['provider'];
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
                                        <a href="portfolio.blade.php"><i class="fa fa-picture-o"></i><span>Portfolio</span></a>
                                    </li>
                                    <li class="">
                                        <a href="admin.blade.php"><i class="fa fa-file-o"></i><span>Admin Management</span></a>
                                    </li>
                                    <li class="">
                                        <a href="logout.blade.php"><i class="ti-dashboard"></i><span>Logout</span></a>
                                    </li>';
                                }else{
                                    echo 
                                    '<li class="active">
                                        <a href="javascript:void(0)" aria-expanded="true"><i class="ti-dashboard"></i><span>Homepage2</span></a>
                                        <ul class="collapse">
                                            <li class="active"><a href="check.blade.php">Check in-out</a></li>
                                        </ul>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0)" aria-expanded="true"><i class="fa fa-align-left"></i> <span>
                                                User Management</span></a>
                                        <ul class="collapse">
                                            <li><a href="profile.blade.php">Profile</a></li>
                                            <li><a href="logout.blade.php">Logout</a></li>
                                        </ul>
                                    </li>';
                                }
                         
                        ?> 
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
