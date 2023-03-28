<?php

    $pageTitle = "Members";

    include "init.php";

    $sections = getAllData("*", "sections");

?>
<div class="page-wrapper">
    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
     <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <div class="ml-auto text-right">
                    <h4 class="page-title">الإعدادات العامة</h4>
                </div>
            </div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- End Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Container fluid  -->
    <!-- ============================================================== -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <form method="post" action="#" class="form-group">
                        <div class="card-body">
                            <h4 class="card-title m-b-0">الإعدادات العامة</h4>
                            <div class="form-group">
                                <label class="general-title-label" for="website-name">اسم الموقع</label>
                                <input class="form-control website-name" type="text" name="website-name" value="<?=$websiteName?>">
                            </div>
                            <div class="form-group">
                                <label class="general-title-label" for="website-about">قسم: من نحن</label>
                                <textarea class="form-control website-about" type="text" name="website-about"><?=$websiteWhoAreWe?></textarea>
                            </div>
                            <div class="form-group">
                                <label class="general-title-label" for="website-email">البريد الإلكتروني الخاص بالموقع</label>
                                <textarea class="form-control website-email" type="text" name="website-email"><?=$websiteWhoAreWe?></textarea>
                            </div>
                        </div>
                        <div class="border-top news-submit">
                            <div class="card-body">
                                <button type="submit" name="news-submit" class="btn btn-success">أرسل</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php
    
    include "includes/templates/footer.php";

?>