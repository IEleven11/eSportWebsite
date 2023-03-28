<?php 

    $pageTitle = "Dashboard";

    include "init.php";

?>


<div class="page-wrapper">
    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
     <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <div class="ml-auto text-right">
                    <h4 class="page-title">لوحة التحكم</h4>
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
        <!-- ============================================================== -->
        <!-- Sales Cards  -->
        <!-- ============================================================== -->
        <div class="row">
            <!-- Column -->
            <div class="col-md-6 col-lg-4 col-xlg-3">
                <div class="card card-hover">
                    <div class="box bg-info text-center">
                        <h1 class="font-light text-white"><i class="fa fa-envelope-open"></i></h1>
                        <h6 class="text-white">عدد التذاكر</h6>
                        <p class="statCount"><strong><?php echo ticketCount(); ?></strong></p>
                    </div>
                </div>
            </div>
            <!-- Column -->
            <!-- Column -->
            <div class="col-md-6 col-lg-4 col-xlg-3">
                <div class="card card-hover">
                    <div class="box bg-cyan text-center">
                        <h1 class="font-light text-white"><i class="fas fa-users"></i></h1>
                        <h6 class="text-white">عدد الفرق</h6>
                        <p class="statCount"><strong><?php echo DataCount("sectionid", "sections", 1, 1); ?></strong></p>
                    </div>
                </div>
            </div>
            <!-- Column -->
            <!-- Column -->
            <div class="col-md-6 col-lg-4 col-xlg-3">
                <div class="card card-hover">
                    <div class="box bg-danger text-center">
                        <h1 class="font-light text-white"><i class="fa fa-gamepad"></i></h1>
                        <h6 class="text-white">اللاعبين</h6>
                        <p class="statCount"><strong><?php echo playersCount(); ?></strong></p>
                    </div>
                </div>
            </div>
            <!-- Column -->
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title m-b-0">آخر الأخبار</h4>
                    </div>
                    <?php
        
                        $stmt = $con->prepare("SELECT * FROM `news` ORDER BY `newsid` DESC LIMIT 5");
                        $stmt->execute();
                        $rows = $stmt->fetchAll();
            
                    ?>
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
                                    </div>
                                </div>
                            </li>
                        </ul>
                    
                    <?php } ?>
                    
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title m-b-0">آخر التذاكر</h4>
                    </div>
                    <div class="table-responsive">
                        <table class="table">
                        <?php

                            $stmt = $con->prepare("SELECT ticketid, tickettype, ticketsubject, ticketdate FROM `tickets` WHERE `ticketemail` = ? ORDER BY `ticketid` DESC LIMIT 5");
                            $stmt->execute([$_SESSION['email']]);
                            $rows = $stmt->fetchAll();

                        ?>
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">نوع التذكرة</th>
                                    <th scope="col">عنوان التذكرة</th>
                                    <th scope="col">تاريخ التذكرة</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php

                                foreach($rows as $row) {

                                    echo '<tr>';
                                        echo '<th scope="row">' . $row['ticketid'] . '</th>';
                                        echo '<td>' . $row['tickettype'] . '</td>';
                                        echo '<td>' . $row['ticketsubject'] . '</td>';
                                        echo '<td>' . $row['ticketdate'] . '</td>';
                                    echo '</tr>';

                                }

                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- Sales chart -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- End Container fluid  -->
        <!-- ============================================================== -->
    </div>
        
<?php 

    include "includes/templates/footer.php";
        
?>