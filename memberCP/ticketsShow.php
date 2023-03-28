<?php

    $pageTitle = "Tickets";

    include "init.php";

?>

<?php

    $stmt = $con->prepare("SELECT `email` FROM `users` WHERE `id` = ?");
    $stmt->execute([$_SESSION['userid']]);
    $row = $stmt->fetch();
    $email = $row['email'];

    $rows = memberTickets($email);

    $id = isset($_GET['tid']) && is_numeric($_GET['tid']) ? intval($_GET['tid']) : 0;

    if(isset($_GET['do']) && isset($_GET['tid'])) {

        if ($_GET['do'] == "delete") {
            
            $stmt = $con->prepare("DELETE FROM `tickets` WHERE `tickets`.`ticketid` = ? AND `tickets`.`ticketemail` = ?");
            
            $stmt->execute([$id, $email]);
            
            header("Location: ticketsShow.php");
            
        }
        
    }

?>
<div class="page-wrapper">
     <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <div class="ml-auto text-right">
                    <h4 class="page-title">عرض التذاكر</h4>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="membersCount">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">عرض التذاكر</h5>
                            <div class="table-responsive">
                                <table id="zero_config" class="table table-striped table-bordered table-mobile">
                                    <thead>
                                        <tr>
                                            <th>نوع التذكرة</th>
                                            <th>عنوان التذكرة</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        
                                            foreach($rows as $row) {
                                                
                                                echo '<tr>';
                                                    echo '<td>' . $row['tickettype'] . '<strong>نوع التذكرة:</strong></td>';
                                                    echo '<td>' . $row['ticketsubject'] . '<strong>عنوان التذكرة:</strong></td>';
                                                    echo '<td class="settings">';
                                                        echo '<a href="ticketView.php?tid=' . $row['ticketid'] . '" class="btn btn-outline-success btn-sm"> عرض </a>';
                                                        echo '<a href="?tid=' . $row['ticketid'] . '&do=delete" onclick="return memberDeleteAlert();" class="btn btn-danger btn-sm"> حذف </a>';
                                                    echo '</td>';
                                                echo '</tr>';
                                                echo '<tr class="table-mobile-space"></tr>';
                                            }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php
    
    include "includes/templates/footer.php";

?>

<script>
    /****************************************
     *       Basic Table                   *
     ****************************************/
    $('#zero_config').DataTable();
</script>