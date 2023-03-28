<?php 

    $pageTitle = "Dashboard";

    include "init.php";



    $id = isset($_GET['sid']) && is_numeric($_GET['sid']) ? intval($_GET['sid']) : 0;

    if(isset($_GET['do']) && isset($_GET['sid']) && isset($_GET['sname'])) {

        if ($_GET['do'] == "delete") {
            
            $stmt = $con->prepare("DELETE FROM `sections` WHERE `sections`.`sectionid` = ?");
            $stmt->execute([$id]);
            
            $stmt = $con->prepare("DROP TABLE `" . $_GET['sname'] . "`");
            $stmt->execute();

            header("Location: sectionsShow.php");
            
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
                    <h4 class="page-title">أقسام الموقع</h4>
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
        <a href="sectionCreate.php" class="btn btn-success sectionAdd">إضافة قسم جديد <strong>+</strong></a>
        <div class="sectionsShow">
            <div class="row sections-row">
                <?php
                
                    $sections = getAllData("*", "sections");
                
                    foreach ($sections as $sectionCard) {
                        
                    
                        $sectionMName = $sectionCard['sectionname'];
                        $sectionCName = $sectionCard['sectioncut'];
                        
                        if (empty($sectionCard['sectionpicture'])) {
                            
                            $sectionBG = "../includes/layout/images/Section_Default.jpg";
                            
                        } else {
                        
                            $sectionBG = "../" . $sectionCard['sectionpicture'];
                            
                        }
                        
                    ?>
                <div class="col-md-12 col-lg-3">
                  <div class="card">
                    <center>
                        <div class="card-img">
                            <img class="card-img-top" src="<?php echo $sectionBG; ?>">
                            <div class="overlay"></div>
                            <div class="card-options">
                                <a href="?sid=<?php echo $sectionCard['sectionid']; ?>&sname=<?php echo $sectionCName ?>&do=delete" onclick="return memberDeleteAlert();" class="btn btn-outline-danger"> حذف القسم </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $sectionMName; ?></h5>
                        </div>
                    </center>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>
    </div>
    
    
<?php 
    
    include "includes/templates/footer.php";
        
?>