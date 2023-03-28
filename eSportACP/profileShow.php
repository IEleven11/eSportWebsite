<?php

    $pageTitle = "Members";

    include "init.php";

?>
<div class="page-wrapper">
     <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <div class="ml-auto text-right">
                    <h4 class="page-title">معلومات الحساب</h4>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="profile">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">معلومات الحساب</h4>
                    <ul>
                            <li>الإسم كاملًا : <?php echo $_SESSION['firstname'] . " " . $_SESSION['lastname']; ?></li>
                            <li>اسم المستخدم : <?php echo $_SESSION['username']; ?></li>
                            <li>البريد الإلكتروني : <?php echo $_SESSION['email']; ?></li>
                            <li>رقم الجوال : <?php echo $_SESSION['phone']; ?></li>
                            <li>تويتر : <?php echo $_SESSION['twitter']; ?></li>
                            <li>إنستقرام : <?php echo $_SESSION['insta']; ?></li>
                            <li>الجنس : <?php echo $_SESSION['sex']; ?></li>
                            <li>البلد : <?php echo $_SESSION['country']; ?></li>
                            <li>التخصص : <?php echo $_SESSION['specialty']; ?></li>
                            <li>المنصة : <?php echo $_SESSION['platform']; ?></li>
                            <li>الرتبة : <?php echo $_SESSION['role']; ?></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
    
    include "includes/templates/footer.php";

?>