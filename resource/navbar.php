<?php session_start(); ?>

<nav class="navbar navbar-expand-lg navbar-light bg-light" style="height: 100px !important;">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03"
        aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <img class="mt-2" src="assets/img/logo.png" style="width:270px !important; height:150px !important;">

    <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
        <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
            <li class="nav-item active">
                <a class="nav-link" href="#">หน้าหลัก</a>
            </li>
            <!-- <li class="nav-item">
                <a class="nav-link" href="#">Link</a>
            </li>
            <li class="nav-item">
                <a class="nav-link disabled" href="#">Disabled</a>
            </li> -->
        </ul>
        <ul class="navbar-nav ml-auto" style="margin-right: 40px !important;">
            <?php if (isset($_SESSION['id'])) { ?>
                <li class="nav-item">
                    <a class="nav-link" href="#"><?php echo $_SESSION['firstname']; ?> <?php echo $_SESSION['lastname']; ?></a>
                </li>
            <?php
            }else{
                echo'<li class="nav-item">
                        <a class="nav-link" href="#" data-toggle="modal" data-target="#loginModal">เข้าสู่ระบบ</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" data-toggle="modal" data-target="#regisModal">สมัครสมาชิก</a>
                    </li>';
            }        
        ?>
        </ul>
    </div>
</nav>