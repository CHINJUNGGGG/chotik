    <header class="header" style="height: 90px;">
        <div class="container">
            <div class="row">
                <div class="col-lg-2">
                    <div class="header__logo">
                        <a href="index.blade.php"></a>
                    </div>
                </div>
                <div class="col-lg-7">
                    <nav class="header__menu">
                        <ul>
                            <li class="active"><a href="index.blade.php">Home</a></li>
                            <li><a href="booking.blade.php">Booking</a></li>
                            <li><a href="promotion.blade.php">Promotion</a></li>
                            <li><a href="portfolio.blade.php">Portfolio</a></li>
                            <li><a href="contact.blade.php">Contact</a></li>
                        </ul>
                    </nav>
                </div>
                <div class="col-lg-3 d-flex justify-content-end">
                <?php if (isset($_SESSION['id'])) { ?>
                    <nav class="header__menu">
                        <ul>
                            <li><a href="#"><?php echo $_SESSION['firstname']; ?> <?php echo $_SESSION['lastname']; ?></a>
                                <ul class="dropdown">
                                    <li><a href="profile.blade.php">Profile</a></li>
                                    <li><a href="logout.blade.php">Logout</a></li>
                                </ul>
                            </li>
                        </ul>
                    </nav>
                <?php }else{ ?>
                    <div class="header__right">
                        <div class="header__right__btn">
                            <a href="#" class="primary-btn" data-toggle="modal" data-target="#loginModal">Login</a>
                        </div>
                        <div class="header__right__btn">
                            <a href="#" class="primary-btn" data-toggle="modal" data-target="#regisModal" style="background-color: #282828;">Register</a>
                        </div>
                    </div>
                <?php } ?>    
                </div>
            </div>
            <div class="canvas__open">
                <span class="fa fa-bars"></span>
            </div>
        </div>
    </header>