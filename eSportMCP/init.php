<?php 
    // هذا الملف يجمع كل الملفات الي تحتاج للانكلود زي الهيدر والناف بار والاتصال بقاعدة البيانات في ملف واحد

    include "../db_connect.php";
    include "../config.php";

    // متغيرات للوصول للملفات
    $tmp = "includes/templates/";
    $func = "includes/function/";

    include $func . "functions.php";
    include $tmp . "header.php";

    /* امر شرطي لحذف الناف بار (الشريط اعلى الصفحة)بحيث اذا حطيت متغير 
    ** $noNavbar
    ** ما يسوي انكلود للناف بار
    */
    if(!isset($noNavbar)) { include $tmp . "navbar.php"; }

    /************ الفوتر تسويله انكلود آخر الصفحة الي تسويها ************/
?>