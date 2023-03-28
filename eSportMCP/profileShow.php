<?php

    $pageTitle = "Members";

    include "init.php";

    $sections = getAllData("*", "sections");

?>

<?php

    if($_SESSION['role'] != "administration") {

        $row = userProfile($_SESSION['userid'], $_SESSION['specialty']);
        
    }

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
                        <?php
                        
                if($_SESSION['role'] != "administration") {
                    
                    foreach ($sections as $section) {

                        $sectionName = $section['sectioncut'];

                        if ($row['specialty'] == $section['sectioncut']) {

                            $sectionForms = [
                                $section['form1'],
                                $section['form2'],
                                $section['form3'],
                                $section['form4'],
                                $section['form5'],
                                $section['form6'],
                                $section['form7'],
                                $section['form8']
                            ];

                            foreach ($sectionForms as $form) {

                                if ($form == "") {
                                    break;           // don't count the empty forms ..
                                }

                                echo '<li>'. $form .' : ' . $row[$form] . '</li>';

                            }

                        }

                    }
                        
                } 
                        ?>
                        
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
    
    include "includes/templates/footer.php";

?>