<?php session_start(); ?>
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
    
            </div>
        </div>

        <?php require_once __DIR__.'/resources/footer.php'; ?> 

    </div>
 
    <?php require_once __DIR__.'/resources/script.php'; ?>
</body>

</html>
