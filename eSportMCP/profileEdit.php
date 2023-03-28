<?php

    $pageTitle = "Members";

    include "init.php";

?>

<?php

    $errorLog = array();

    if (isset($_POST['profileEditSubmit'])) {
        
        $img = strip_tags($_POST['img']);
        $username = strip_tags($_POST['username']);
        $email = strip_tags($_POST['email']);
        $phone = strip_tags($_POST['phone']);
        $twitter = strip_tags($_POST['twitter']);
        $insta = strip_tags($_POST['insta']);
        
        if (!empty($_POST['newPassword'])) {
        
            $newPassword = strip_tags($_POST['newPassword']);
            $oldPassword = strip_tags($_POST['oldPassword']);

            $userPassword = getData("password", "users", "id", $_SESSION['userid']);
            $realOldPassword = $userPassword['password'];
            
        }

        if (empty($username)) {
            
            $errorLog[] = "لا تترك خانة الإسم المستعار فارغة";

        } elseif (strlen($username) > 30) {
            
            $errorLog[] = "خانة الإسم المستعار يجب أن تكون أقل من 30 حرف";

        } elseif (empty($email)) {
            
            $errorLog[] = "لا تترك خانة البريد الإلكتروني فارغة";

        } 
        
        if ($email != $_POST['oldprofileEditEmail']) {
        
            $count = DataCount("email", "users", "email", $email);
        
            if ($count > 0) {

                $errorLog[] = "البريد الإلكتروني مأخوذ سابقًا";

            }
            
        }
        
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {

            $errorLog[] = "البريد الإلكتروني غير صحيح";

        } elseif (strlen($email) > 40 || strlen($email) < 6) {
            
            $errorLog[] = "خانة البريد الإلكتروني يجب أن تكون بين 6 - 40";

        } elseif (empty($phone)) {
            
            $errorLog[] = "لا تترك خانة رقم الهاتف فارغة";

        } 
        
        if ($phone != $_POST['oldprofileEditPhone']) {
        
            $count = DataCount("phone", "users", "phone", $phone);

            if ($count > 0) {

                $errorLog[] = "رقم الجوال مأخوذ سابقًا";

            }
            
        }
        
        if (!is_numeric($phone)) {
            
            $errorLog[] = "يسمح فقط بالأرقام في خانة رقم الهاتف";

        } elseif (strlen($phone) > 15 || strlen($phone) < 6) {
            
            $errorLog[] = "خانة رقم الهاتف يجب أن تكون بين 6 - 15";

        } elseif (empty($twitter) && empty($insta)) {
            
            $errorLog[] = "يجب عليك الإختيار بين تويتر أو إنستقرام";

        } 
        
        
        if (!empty($twitter)) { 
            
            if ($twitter[0] != "@") {
            
                $errorLog[] = "خانة حساب تويتر يجب أن تبدأ ب @";

            } elseif (strlen($twitter) > 18 || strlen($twitter) < 3) {

                $errorLog[] = "خانة حساب تويتر يجب أن تكون بين 3 - 18";

            }
        
        }
        
        if (!empty($insta)) {
            
             if ($insta[0] != "@") {

                $errorLog[] = "خانة حساب انستقرام يجب أن تبدأ ب @";

            } elseif (strlen($insta) > 18 || strlen($insta) < 3) {
            
                $errorLog[] = "خانة حساب انستقرام يحب أن تكون بين 3 - 18";

            }
        
        }
        
        if (!empty($newPassword)) {
            
            if (empty($oldPassword)) {
                
                $errorLog[] = "يرجى كتابة كلمة المرور السابقة لتغيير كلمة المرور الجديدة";
                
            } elseif (password_verify($oldPassword, $realOldPassword) == false) {
            
                $errorLog[] = "الرمز السري القديم غير صحيح";

            }
            
            
            $newPassword = password_hash($newPassword, PASSWORD_DEFAULT);
            
            
        } elseif (!empty($oldPassword)) {
            
            if (empty($newPassword)) {
                
                $errorLog[] = "يرجى كتابة كلمة المرور الجديدة لتغيير كلمة المرور";
                
            }
            
        }
        
        foreach ($errorLog as $error) {
            echo "<div class='alert alert-danger alert-dismissible fade show'>";
                echo $error;
                echo "<button type='button' class='close' data-dismiss='alert' aria-label='Close'>";
                    echo "<span aria-hidden='true'>&times;</span>";
                echo "</button>";
            echo "</div>";
        }
        
        if(empty($errorLog)) {

            $sqlPassword = "";

            if (!empty($_POST['newPassword'])) {

                $stmt = $con->prepare("UPDATE `users` SET `username` = ?, `email` = ?, `password` = ?, `phone` = ?, `twitter` = ?, `instagram` = ?, `picture` = ? WHERE `id` = ?");
                $stmt->execute([$username, $email, $newPassword, $phone, $twitter, $insta, $img, $_SESSION['userid']]);

            } elseif (empty($_POST['newPassword'])) {

                $stmt = $con->prepare("UPDATE `users` SET `username` = ?, `email` = ?, `phone` = ?, `twitter` = ?, `instagram` = ?, `picture` = ? WHERE `id` = ?");
                $stmt->execute([$username, $email, $phone, $twitter, $insta, $img, $_SESSION['userid']]);

            }

            header("refresh: 0");

        }
        
    }

?>
<div class="page-wrapper">
     <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <div class="ml-auto text-right">
                    <h4 class="page-title">تعديل معلومات الحساب</h4>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="profileEdit">
            <div class="card">
                <form class="form-horizontal" onsubmit="return validateProfileEdit();" action="#" method="post">   
                    <div class="card-body">
                        <h4 class="card-title">معلومات الحساب</h4>
                        <br class="clearfloats" />
                        <div class="form-group row">
                            <label for="profileEditImg" class="col-sm-3 text-right control-label col-form-label">تغيير الصورة الشخصية</label>
                            <div class="col-sm-9">
                                <button class="imgChangeBtn" id="profileEditImg" type="button" data-toggle="modal" data-target="#imgChangeList" style="background: url('<?php echo $_SESSION['picture']; ?>')"></button>
                                <input type="hidden" name="img" id="profileEditImgInput" value="">
                            </div>
                            <div class="modal fade" id="imgChangeList" tabindex="-1" role="dialog" aria-labelledby="imgChangeList" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <?php
                                                $stmt = $con->prepare("SELECT `imageurl` FROM `images`");
                                                $stmt->execute();
                                                $rows = $stmt->fetchAll();
                                                
                                                foreach($rows as $row) {
                                                    
                                                    ?>
                                                    <button class="imgChange" onclick="imgTrans(event);" data-dismiss="modal" aria-label="Close" value="<?php echo $row['imageurl']; ?>" style="background: url('../<?php echo $row['imageurl']; ?>')"></button>
                                                    <?php
                                                }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="profileEditUsername" class="col-sm-3 text-right control-label col-form-label">اسم المستخدم</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control form-control-lg" value="<?php echo $_SESSION['username']; ?>"  id="profileEditUsername" name="username" placeholder="">
                                <div class="invalid-feedback">
                                    <span id="profileEditUsernameLog"></span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="profileEditEmail" class="col-sm-3 text-right control-label col-form-label">البريد الإلكتروني</label>
                            <div class="col-sm-9">
                                <input type="email" class="form-control form-control-lg" value="<?php echo $_SESSION['email']; ?>" id="profileEditEmail" name="email" placeholder="">
                                <div class="invalid-feedback">
                                    <span id="profileEditEmailLog"></span>
                                </div>
                                <input type="hidden" name="oldprofileEditEmail" value="<?php echo $_SESSION['email']; ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="profileEditPhone" class="col-sm-3 text-right control-label col-form-label">رقم الهاتف</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control form-control-lg" name="phone" value="<?php echo $_SESSION['phone']; ?>" id="profileEditPhone" placeholder="">
                                <div class="invalid-feedback">
                                    <span id="profileEditPhoneLog"></span>
                                </div>
                                <input type="hidden" name="oldprofileEditPhone" value="<?php echo $_SESSION['phone']; ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="profileEditTwitter" class="col-sm-3 text-right control-label col-form-label">تويتر</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control form-control-lg" value="<?php echo $_SESSION['twitter']; ?>" id="profileEditTwitter" name="twitter" placeholder="">
                                <div class="invalid-feedback">
                                    <span id="profileEditTwitterLog"></span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="profileEditInsta" class="col-sm-3 text-right control-label col-form-label">انستقرام</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control form-control-lg" value="<?php echo $_SESSION['insta']; ?>" id="profileEditInsta" name="insta" placeholder="">
                                <div class="invalid-feedback">
                                    <span id="profileEditInstaLog"></span>
                                </div>
                            </div>
                        </div>
                        <br><hr><br>
                        <h5 class="card-title">تغيير كلمة المرور</h5>
                        <br class="clearfloats" />
                        <div class="form-group row">
                            <label for="profileEditNewPassowrd" class="col-sm-3 text-right control-label col-form-label">كلمة المرور الجديدة</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control form-control-lg" id="profileEditNewPassowrd" name="newPassword" placeholder="">
                                <div class="invalid-feedback">
                                    <span id="profileEditNewPassowrdLog"></span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="profileEditInsta" class="col-sm-3 text-right control-label col-form-label">كلمة المرور القديمة</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control form-control-lg" id="profileEditOldPassowrd" name="oldPassword" placeholder="">
                                <div class="invalid-feedback">
                                    <span id="profileEditOldPassowrdLog"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="border-top">
                        <div class="card-body">
                            <button type="submit" name="profileEditSubmit" class="btn btn-success">عدل</button>
                            <br class="clearfloats" />
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php
    
    include "includes/templates/footer.php";

?>