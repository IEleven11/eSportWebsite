<?php

    $pageTitle = "Pending";
    $noNavbar = "";
    include "init.php";


    if ($_SESSION['role'] != 'pending') {
        
        header("Location: index.php");
        
    }

?>
<div class="main-wrapper">
        <!-- ============================================================== -->
        <!-- Preloader - style you can find in spinners.css -->
        <!-- ============================================================== -->
        <div class="preloader">
            <div class="lds-ripple">
                <div class="lds-pos"></div>
                <div class="lds-pos"></div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- Preloader - style you can find in spinners.css -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Login box.scss -->
        <!-- ============================================================== -->
        <div class="error-box">
            <div class="error-body text-center">
                <h1 class="error-title text-danger">عذرًا</h1>
                <h3 class="text-uppercase error-subtitle">لم يتم قبولك بعد</h3>
                <p class="pending-error">الرجاء الانتظار ليتم قبولك واعادة تحميل الصفحة للتأكد من قبولك لاحقًا
                في حالة عدم قبولك سيحذف حسابك</p>
                <a href="../index.php" class="btn btn-danger btn-rounded waves-effect waves-light m-b-40">العودة الى الصفحة الرئيسية</a> </div>
        </div>
<?php
    
    include "includes/templates/footer.php";

?>
    <!-- ============================================================== -->
    <!-- This page plugin js -->
    <!-- ============================================================== -->
    <script>
    $('[data-toggle="tooltip"]').tooltip();
    $(".preloader").fadeOut();
    </script>