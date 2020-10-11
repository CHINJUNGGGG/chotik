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
                                <li><a href="view.user.blade.php">Portfolio</a></li>
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
                            <h5>Portfolio</h5>
                            </div>

                            <div class="card-body">
                                <button type="button" class="btn btn-sm btn-secondary mb-4" data-toggle="modal"
                                    data-target="#add_modal">
                                    เพิ่มรูปภาพ
                                </button>
                                <div class="data-tables datatable-primary">
                                    <table id="dataTable2" class="text-center">
                                        <thead class="text-capitalize" style="background-color: #000;">
                                            <tr>
                                                <th>#</th>
                                                <th>รูปภาพที่แนบมา</th>
                                                <th>ชื่อคนที่รีวิว</th>
                                                <th>รายละเอียด</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                $i=0;
                                                $sql3 = "SELECT * FROM tbl_portfolio WHERE user_id > 1";
                                                $stmt3=$db->prepare($sql3);
                                                $stmt3->execute();
                                                while($row3=$stmt3->fetch(PDO::FETCH_ASSOC)){
                                                    $id = $row3['id'];
                                                    $picture = $row3['picture'];
                                                    $user_id = $row3['user_id'];
                                                    $detail = $row3['detail'];
                                                    $i++;

                                                    $sql2 = "SELECT * FROM tbl_admin WHERE id = :user_id";
                                                    $stmt=$db->prepare($sql2);
                                                    $stmt->bindparam(':user_id', $user_id);
                                                    $stmt->execute();
                                                    $row2=$stmt->fetch(PDO::FETCH_ASSOC);
                                                        $firstname = $row2['firstname'];
                                                        $lastname = $row2['lastname'];
                                                ?>
                                            <tr>
                                                <td><?=$i?></td>
                                                <td><img src="img/port/<?=$picture?>"
                                                        style="width: 200px; height: 150px;"></td>
                                                <td><?=$firstname?> <?=$lastname?></td>
                                                <td><?=$detail?></td>
                                                <td>
                                                    <!-- <button type="button" class="btn btn-sm btn-secondary"
                                                        data-toggle="modal" data-target="#view_modal"
                                                        data-id="<?=$id?>">
                                                        <i class="fa fa-search"></i>
                                                    </button> -->
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

        <div class="modal fade" id="add_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Modal</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form id="add_form" method="POST" enctype="multipart/form-data">
                        <div class="modal-body">
                            <div class="form-row">
                                <div class="form-group col-12">
                                    <label for="picture">รูปภาพ</label>
                                    <input type="file" class="form-control" name="picture" id="picture">
                                </div>
                                <div class="form-group col-12">
                                    <label for="exampleInputEmail1">ชื่อแอดมิน</label>
                                    <select class="form-control form-control-lg" name="user_id" id="exampleInputEmail1">
                                        <option>เลือกแอดมิน</option>
                                        <?php
                            
                                                $sql = "SELECT * FROM tbl_admin";
                                                $stmt=$db->prepare($sql);
                                                $stmt->execute();
                                                while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
                                                    $id = $row['id'];
                                                    $firstname = $row['firstname'];
                                                    $lastname = $row['lastname'];
                                          
                                        ?>
                                        <option value="<?=$id?>"><?=$firstname?> <?=$lastname?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-12">
                                    <label for="exampleInputEmail1">รายละเอียด</label>
                                    <textarea name="detail" class="form-control" cols="15" rows="5"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-secondary">Submit</button>
                            <input type="hidden" name="do" value="add1">
                            <input type="hidden" name="type" value="2">
                        </div>
                    </form>
                </div>
            </div>
        </div>

    

        <?php require_once __DIR__.'/resources/script.php'; ?>
        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
            integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
        </script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        <script>
        $(document).ready(function() {
            $('#view_modal').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget)
                var id = button.data('id')
                var modal = $(this)

                $.ajax({
                    type: "POST",
                    url: "controller/customerController.php",
                    data: {
                        id: id,
                        do: 'view_user'
                    },
                    dataType: "json",
                    success: function(response) {
                        console.log(response)
                        var arr_input_key = ['tel', 'firstname', 'lastname', 'prefixname',
                            'username'
                        ]
                        $.each(response, function(indexInArray, valueOfElement) {
                            if (jQuery.inArray(indexInArray, arr_input_key) !== -
                                1) {
                                if (valueOfElement != '') {
                                    modal.find('input[name="' + indexInArray + '"]')
                                        .val(valueOfElement)
                                }
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
            $("#add_form").on('submit', (function(e) {
                e.preventDefault();
                $.ajax({
                    url: "controller/portfolioController.php",
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
                                window.location.href = "portfolio.shop.blade.php";
                            }, 2000);
                        }
                    },
                    error: function() {}
                });
            }));
        });
        $(document).ready(function(e) {
            $("#add_form1").on('submit', (function(e) {
                e.preventDefault();
                $.ajax({
                    url: "controller/portfolioController.php",
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
                                window.location.href = "portfolio.shop.blade.php";
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