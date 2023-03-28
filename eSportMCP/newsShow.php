<?php 

    $pageTitle = "Dashboard";

    include "init.php";

?>
<?php

    $stmt = $con->prepare("SELECT * FROM `news` ORDER BY `newsid` DESC LIMIT 20");
    $stmt->execute();
    $rows = $stmt->fetchAll();


    $nid = isset($_GET['nid']) && is_numeric($_GET['nid']) ? intval($_GET['nid']) : 0;

    if(isset($_GET['do']) && isset($_GET['nid'])) {

        if ($_GET['do'] == "delete") {
            
            $stmt = $con->prepare("DELETE FROM `news` WHERE `news`.`newsid` = ?");
            
            $stmt->execute([$nid]);
            
            header("Location: newsShow.php");
            
        }
        
    }

?>
<div class="page-wrapper">
    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
     <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <div class="ml-auto text-right">
                    <h4 class="page-title">الأخبار</h4>
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
                    <div class="card-body">
                        <h4 class="card-title m-b-0">آخر الأخبار</h4>
                    </div>
                    
                    <?php foreach ($rows as $row) { ?>
                    
                        <ul class="list-style-none news-list">
                            <li class="d-flex no-block card-body border-top news-block">
                                <i class="far fa-newspaper w-30px m-t-5"></i>
                                <div>
                                    <h4><?php echo $row['newstitle']; ?></h4>
                                    <?php echo $row['newsdescribe']; ?>
                                </div>
                                <div class="mr-auto">
                                    <div class="text-right">
                                        <span class="text-muted font-16"><?php echo $row['newsdate']; ?></span>
                                        <a href="?nid=<?php echo $row['newsid']; ?>&do=delete" onclick="return memberDeleteAlert();" class="news-delete btn btn-danger btn-sm"> حذف </a>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    
                    <?php } ?>
                    
                </div>
            </div>
        </div>
    </div>
                
<?php 

    include "includes/templates/footer.php";
        
?>