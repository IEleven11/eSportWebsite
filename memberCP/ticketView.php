<?php

    $pageTitle = "Tickets";

    include "init.php";

?>

<?php

    if(!$_GET['tid']) {
        header("Location: index.php");
        exit();
    }

    $errorLog = [];

    $tid = isset($_GET['tid']) && is_numeric($_GET['tid']) ? intval($_GET['tid']) : 0;

    $uid = $_SESSION['userid'];


    $stmt = $con->prepare("SELECT `email` FROM `users` WHERE `id` = ?");
    $stmt->execute([$uid]);
    $row = $stmt->fetch();
    $email = $row['email'];



    $stmt = $con->prepare("SELECT * FROM `tickets` WHERE `ticketid` = ? AND `ticketemail` = ?");
    $stmt->execute([$tid, $email]);
    $row = $stmt->fetch();


    $id = isset($_GET['tid']) && is_numeric($_GET['tid']) ? intval($_GET['tid']) : 0;

    if(isset($_GET['do']) && isset($_GET['tid'])) {

        if ($_GET['do'] == "delete") {
            
            $stmt = $con->prepare("DELETE FROM `tickets` WHERE `tickets`.`ticketid` = ? AND `tickets`.`ticketemail` = ?");
            
            $stmt->execute([$id, $email]);
            
            header("Location: ticketsShow.php");
            
        }
        
    }

    if(isset($_POST['commentSubmit'])) {
        
        $comment = $_POST['comment'];
        
         if (empty($comment)) {

            $errorLog[] = "لا تترك خانة التعليق فارغة";

        } elseif (strlen($comment) > 350 || strlen($comment) < 60) {

            $errorLog[] = "يجب أن يكون التعليق بين 60 - 350";

        }
        
        foreach ($errorLog as $error) {
            echo "<div class='alert alert-danger alert-dismissible fade show'>";
                echo $error;
                echo "<button type='button' class='close' data-dismiss='alert' aria-label='Close'>";
                    echo "<span aria-hidden='true'>&times;</span>";
                echo "</button>";
            echo "</div>";
        }
        
        if (empty($errorLog)) {

                // insert to database after finish validation
           
            $stmt = $con->prepare("INSERT INTO `ticketcomments` (`ticketid`, `userid`, `commentdescribe`, `commentdate`) VALUES (?, ?, ?, now())");
            $stmt->execute([$tid, $uid, $comment]);
            
            header("refresh: 0");
        }
        
    }

?>
<div class="page-wrapper">
     <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <div class="ml-auto text-right">
                    <h4 class="page-title view-title">عرض التذكرة</h4>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <div class="viewStatus d-none d-md-block">
                    <h3>معلومات التذكرة :</h3>
                    <ul>
                        <li><strong>الإسم :<br></strong> <?php echo $row['ticketname']; ?></li>
                        <li><strong>البريد الإلكتروني :<br></strong> <?php echo $row['ticketemail']; ?></li>
                        <li><strong>نوع التذكرة :<br></strong> <?php echo $row['tickettype']; ?></li>
                        <li><strong>تاريخ التذكرة :<br></strong> <?php echo $row['ticketdate']; ?></li>
                    </ul>
                    <a href="?tid=<?php echo $row['ticketid']; ?>&do=delete" onclick="return memberDeleteAlert();" class="btn btn-outline-danger"> حذف </a>
                </div>
            </div>
            <div class="col-md-9">
                <div class="view col-md-12">
                    <div class="viewHeader">
                        <h5> <i>الإسم :</i> <?php echo $row['ticketname']; ?></h5>&nbsp;&nbsp;&nbsp;&nbsp;
                        <h5> <i>تاريخ التذكرة :</i> <span><?php echo $row['ticketdate']; ?></span></h5>
                    </div>
                    <div class="viewBody">
                        <p class="lead"><?php echo $row['ticketdescribe']; ?></p>
                    </div>
                </div>
                <?php
                    $rows = getMultiData("*", "ticketcomments", "ticketid", $tid);
                
                    foreach ($rows as $row){
                        
                        $user = getData("*", "users", "id", $row['userid']);
                        
                        if ($user['role'] == "administration") {

                            $role = "info";

                        } elseif ($user['role'] == "manager") {

                            $role = "warning";

                        } elseif ($user['role'] == "support") {

                            $role = "success";

                        } elseif ($user['role'] == "member") {

                            $role = "secondary";

                        }
                        
                        echo '<div class="comment col-md-12">';
                            echo '<div class="commentHeader">';
                                echo '<h5> <i>الإسم :</i> ' . $user['firstname'] . " " . $user['lastname'] . '</h5>&nbsp;&nbsp;&nbsp;&nbsp;';
                                echo '<h5> <i>تاريخ الرسالة :</i> ' . $row['commentdate'] . '</h5>&nbsp;&nbsp;&nbsp;&nbsp;';
                                echo '<h5><span class="badge badge-pill badge-' . $role . '">' . $user['role'] . '</span></h5>';
                            echo '</div>';
                            echo '<div class="commentBody">';
                                echo '<p class="lead">' . $row['commentdescribe'] . '</p>';
                            echo '</div>';
                        echo '</div>';
                                    
                    }
                ?>
                <div class="col-md-12 collapse" id="addComment">
                    <form onsubmit="return addCommentValidate();" method="post" action="#">
                        <textarea class="form-control addComment col-md-12" name="comment" id="comment" rows="3"></textarea>
                        <div class="invalid-feedback">
                            <span id="commentLog"></span>
                        </div>
                        <br class="clearfloats">
                        <button type="submit" name="commentSubmit" class="btn btn-success mr-auto send">ارسل</button>
                    </form>
                </div>
                <br class="clearfloats">
                <div class="addCommentBtn col-md-12">
                    <a class="btn btn-outline-dark col-md-12" data-toggle="collapse" href="#addComment" role="button" aria-expanded="false" aria-controls="addComment">
                        إضافة رد
                    </a>
                </div>
            </div>
        </div>
    </div>
<?php
    
    include "includes/templates/footer.php";

?>