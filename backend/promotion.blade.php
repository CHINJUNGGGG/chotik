<?php 
session_start(); 
include('db/connectpdo.php'); 
?>
<!doctype html>
<html class="no-js" lang="en">

<head><?php require_once __DIR__.'/resources/head.php'; ?>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
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
                                <li><a href="Promotion.blade.php">Promotion</a></li>
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
                <div class="card-area">
                    <button type="button" class="btn btn-sm btn-secondary mt-4" data-toggle="modal"
                        data-target="#exampleModalCenter"><i class="fa fa-plus"></i> เพิ่มข้อมูลโปรโมชั่น</button>
                    <div class="row">
                        <?php
                        $sql = "SELECT * FROM tbl_promotion ORDER BY id DESC";
                        $stmt=$db->prepare($sql);
                        $stmt->execute();
                        while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
                            $id = $row['id'];
                            $pro_name = $row['pro_name'];
                            $pro_detail = $row['pro_detail'];
                            $pro_img = $row['pro_img'];
                            $pro_status = $row['pro_status'];
                    ?>
                        <div class="col-lg-4 col-md-6 mt-5">
                            <div class="card card-bordered">
                                <img class="card-img-top img-fluid" src="img/promotion/<?=$pro_img?>" alt="image" style="height:300px;">
                                <div class="card-body">
                                    <h5 class="title"><?=$pro_name?></h5>
                                    <p class="card-text">
                                        <?=$pro_detail?>
                                    </p>
                                    <div class="row">
                                        <div class="col-2 mr-2">
                                            <button type="button" class="btn btn-primary" data-toggle="modal"
                                            data-target="#view_modal" data-id="<?=$id?>">View..</button>
                                        </div>
                                        <div class="col-6">
                                        <?php
                                        if($pro_status == '0'){
                                        ?>
                                            <form id="cancel" method="POST" enctype="multipart/form-data">
                                                <button type="submit" class="btn btn-secondary">Cancel Promotion</button>
                                                <input type="hidden" name="do" value="cancel">
                                                <input type="hidden" name="id" value="<?=$id?>">
                                            </form> 
                                        <?php }else{ ?>
                                            <form id="enabled" method="POST" enctype="multipart/form-data">
                                                <button type="submit" class="btn btn-success">Enable Promotion</button>
                                                <input type="hidden" name="do" value="enabled">
                                                <input type="hidden" name="id" value="<?=$id?>">
                                            </form>
                                        <?php } ?>    
                                        </div>
                                    </div>  
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Modal</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form id="pro_form" method="POST" enctype="multipart/form-data">
                            <div class="modal-body">
                                <div class="form-row">
                                    <div class="form-group col-6">
                                        <label for="exampleInputEmail1">ชื่อโปรโมชั่น</label>
                                        <input type="text" class="form-control" id="exampleInputEmail1" name="pro_name"
                                            required>
                                    </div>
                                    <div class="form-group col-6">
                                        <label for="exampleInputEmail1">ราคา</label>
                                        <input type="text" class="form-control" id="exampleInputEmail1" name="pro_price"
                                            required>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-12">
                                        <label for="picture">รูปภาพประกอบ</label>
                                        <input type="file" class="form-control" name="pro_img" id="pro_img"
                                            onchange="document.getElementById('output1').src = window.URL.createObjectURL(this.files[0])">
                                    </div>
                                    <div class="form-group col-12">
                                        <label for="exampleInputEmail1">รายละเอียด</label>
                                        <textarea name="pro_detail" class="form-control" id="pro_detail" cols="30"
                                            rows="10"></textarea>
                                    </div>
                                </div>
                                <div class="form-row d-flex justify-content-center">
                                    <div class="form-group col-12">
                                        <img src="#" id="output1">
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary"
                                    style="background-color: #4336fb !important; border-color: #4336fb !important;">Submit
                                </button>
                                <input type="hidden" name="do" value="add_pro">
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="view_modal" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Modal</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form id="edit_form" method="POST" enctype="multipart/form-data">
                            <div class="modal-body">
                                <div class="form-row">
                                    <div class="form-group col-6">
                                        <label for="exampleInputEmail1">ชื่อโปรโมชั่น</label>
                                        <input type="text" class="form-control" id="pro_name" name="pro_name" required>
                                    </div>
                                    <div class="form-group col-6">
                                        <label for="exampleInputEmail1">ราคา</label>
                                        <input type="text" class="form-control" id="pro_price" name="pro_price"
                                            required>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-12">
                                        <label for="picture">รูปภาพประกอบ</label>
                                        <input type="file" class="form-control" name="picture" id="picture"
                                            onchange="document.getElementById('pro_img1').src = window.URL.createObjectURL(this.files[0])">
                                    </div>
                                    <div class="form-group col-12">
                                        <label for="exampleInputEmail1">รายละเอียด</label>
                                        <textarea name="pro_detail" class="form-control" id="pro_detail" cols="30"
                                            rows="10"></textarea>
                                    </div>
                                </div>
                                <div class="form-row d-flex justify-content-center">
                                    <div class="form-group col-12">
                                        <img src="#" id="pro_img1" name="pro_img1">
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary"
                                    style="background-color: #4336fb !important; border-color: #4336fb !important;">Submit
                                </button>
                                <input type="hidden" name="do" value="edit_pro">
                                <input type="hidden" name="id" id="id">
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <?php require_once __DIR__.'/resources/script.php'; ?>
            <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
                integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
                crossorigin="anonymous">
            </script>
            <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
            <script>
            $(document).ready(function() {
                $('#view_modal').on('show.bs.modal', function(event) {
                    var button = $(event.relatedTarget)
                    var id = button.data('id')
                    var modal = $(this)

                    $.ajax({
                        type: "POST",
                        url: "controller/promotionController.php",
                        data: {
                            id: id,
                            do: 'view_pro'
                        },
                        dataType: "json",
                        success: function(response) {
                            console.log(response)
                            var arr_input_key = ['id', 'pro_name', 'pro_price', 'pro_img',
                                'pro_detail'
                            ]
                            $.each(response, function(indexInArray,
                                valueOfElement) {
                                if (jQuery.inArray(indexInArray,
                                        arr_input_key) !== -1) {
                                    if (valueOfElement != '') {
                                        modal.find('input[name="' +
                                                indexInArray + '"]')
                                            .val(valueOfElement)
                                    }
                                }
                                if (jQuery.inArray(indexInArray,
                                        arr_input_key) !== -1) {
                                    if (valueOfElement != '') {
                                        modal.find('textarea[name="' +
                                                indexInArray + '"]')
                                            .val(valueOfElement)
                                    }
                                }
                                if (jQuery.inArray(indexInArray) !== -1) {
                                    if (valueOfElement != '') {
                                        modal.find('input[name="' +
                                                indexInArray + '"]')
                                            .attr('old-' + indexInArray,
                                                valueOfElement)
                                    }
                                }
                                if (indexInArray === 'pro_img') {
                                    modal.find('img').attr('src',
                                        'img/promotion/' +
                                        valueOfElement)
                                }
                            });
                            modal.find('#id').val(id)
                        }
                    });
                })
            });
            </script>
            <script>
            $(document).ready(function(e) {
                $("#pro_form").on('submit', (function(e) {
                    e.preventDefault();
                    $.ajax({
                        url: "controller/promotionController.php",
                        type: "POST",
                        data: new FormData(this),
                        contentType: false,
                        cache: false,
                        processData: false,
                        success: function(response) {
                            console.log(response)
                            if (response == "Error") {
                                swal("Please complete all information.", {
                                    icon: "warning",
                                });
                            }
                            if (response == "Success") {
                                swal("Add successfully.", {
                                    icon: "success",
                                });
                                setTimeout(function() {
                                    window.location.href =
                                        "promotion.blade.php";
                                }, 2000);
                            }
                        },
                        error: function() {}
                    });
                }));
            });
            $(document).ready(function(e) {
                $("#edit_form").on('submit', (function(e) {
                    e.preventDefault();
                    $.ajax({
                        url: "controller/promotionController.php",
                        type: "POST",
                        data: new FormData(this),
                        contentType: false,
                        cache: false,
                        processData: false,
                        success: function(response) {
                            console.log(response)
                            if (response == "Error") {
                                swal("Please complete all information.", {
                                    icon: "warning",
                                });
                            }
                            if (response == "Success") {
                                swal("Edit successfully.", {
                                    icon: "success",
                                });
                                setTimeout(function() {
                                    window.location.href =
                                        "promotion.blade.php";
                                }, 2000);
                            }
                        },
                        error: function() {}
                    });
                }));
            });
            $(document).ready(function(e) {
                $("#cancel").on('submit', (function(e) {
                    e.preventDefault();
                    $.ajax({
                        url: "controller/promotionController.php",
                        type: "POST",
                        data: new FormData(this),
                        contentType: false,
                        cache: false,
                        processData: false,
                        success: function(response) {
                            console.log(response)
                            if (response == "Error") {
                                swal("Please complete all information.", {
                                    icon: "warning",
                                });
                            }
                            if (response == "Success") {
                                swal("Cancel successfully.", {
                                    icon: "success",
                                });
                                setTimeout(function() {
                                    window.location.href =
                                        "promotion.blade.php";
                                }, 2000);
                            }
                        },
                        error: function() {}
                    });
                }));
            });
            $(document).ready(function(e) {
                $("#enabled").on('submit', (function(e) {
                    e.preventDefault();
                    $.ajax({
                        url: "controller/promotionController.php",
                        type: "POST",
                        data: new FormData(this),
                        contentType: false,
                        cache: false,
                        processData: false,
                        success: function(response) {
                            console.log(response)
                            if (response == "Error") {
                                swal("Please complete all information.", {
                                    icon: "warning",
                                });
                            }
                            if (response == "Success") {
                                swal("Enabled successfully.", {
                                    icon: "success",
                                });
                                setTimeout(function() {
                                    window.location.href =
                                        "promotion.blade.php";
                                }, 2000);
                            }
                        },
                        error: function() {}
                    });
                }));
            });
            </script>
</body>

</html>