    
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
                            <li><a class="active" href="index.blade.php">Home</a></li>
                            <li><a href="booking.blade.php">Booking</a></li>
                            <li><a href="promotion.blade.php">Promotion</a></li>
                            <li><a href="portfolio.index.blade.php">Portfolio</a>
                                <ul class="dropdown">
                                        <li><a href="portfolio.blade.php?id=1&id1=Customer">Customer</a></li>
                                        <li><a href="portfolio.blade.php?id=2&id2=Shop">Shop</a></li>
                                    </ul>
                            </li>
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
                            <label for="email">อีเมล์</label>
                            <input type="email" class="form-control" name="email" id="email" required>
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
                <form id="register_form" method="POST"
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
                            <label for="email">ชื่อผู้ใช้งาน</label>
                            <input type="email" class="form-control" name="email" id="email" required>
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
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
