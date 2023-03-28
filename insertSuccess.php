<?php

    $pageTitle = "Success";

    $noNavbar = "";

    include "init.php";

?>

<div class="message">
    <div class="message-body">
        <div class="message-title">لقد تم الإرسال بنجاح</div>
        <?php if(isset($_GET['joinForm'])) { echo '<p class="text-muted m-t-30 m-b-30">لقد تم ارسال كلمة المرور الى بريدك الإلكتروني</p>'; } ?>
        <p class="text-muted m-t-30 m-b-30">سيتم تحويلك للصفحة الرئيسية بعد 3 ثواني</p>
    </div>
</div>


<?php

    header("Refresh: 3; url=index.php");

?>