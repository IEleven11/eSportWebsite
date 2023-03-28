<?php

    $pageTitle = "Home";

    include "init.php";

?>

<?php

    $errorLog = array(); // تعريف للإيرور ارراي
    
    $sections = getAllData("*", "sections");

    if (isset($_POST['signInSubmit'])) {
        
        // validation
        
        // XSS Filter
        
        $email = strip_tags($_POST['signInEmail']);
        $password = strip_tags($_POST['signInPassword']);
        
        if (empty($email)) {
            
            $errorLog[] = "لا تترك خانة البريد الإلكتروني فارغة";

        } elseif(empty($password)) {
            
            $errorLog[] = "لا تترك خانة الرمز السري فارغة";

        } elseif(strlen($email) > 40 || strlen($email) < 6) {
            
            $errorLog[] = "يجب أن يكون البريد الإلكتروني بين ال 6 - 40";

        }
        
        $count = DataCount("email", "users", "email", $email);
        
        if ($count == 0) {
            
            $errorLog[] = "البريد الإلكتروني أو الرمز السري خاطئ";

        } elseif(strlen($password) > 255) {
            
            $errorLog[] = "خانة الرمز السري تخطت الحد المسموح";

        }
        
        $data = getData("password", "users", "email", $email);
        
        if (password_verify($password, $data['password']) == false) {
            
            $errorLog[] = "البريد الإلكتروني أو الرمز السري خاطئ";

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
            
            $user = userId("email", $email);
                        
            $_SESSION['userid'] = $user['id'];
            
            header("Location: index.php");
            
        }
        
    }

    if (isset($_POST['forgotPasswordSubmit'])) {
        
        $email = strip_tags($_POST['forgotPasswordEmail']);
        
        $count = DataCount("email", "users", "email", $email);
        
        if ($count <= 0) {
            
            $errorLog[] = "البريد الإلكتروني غير صحيح";

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
            
            $randPassword = randomPassword(); // random password
            $passwordHashed = password_hash($randPassword, PASSWORD_DEFAULT);
            
            $stmt = $con->prepare("UPDATE `users` SET `password` = ? WHERE `email` = ?");
            $stmt->execute([$passwordHashed, $email]);
            
            include("includes/templates/mailSend.php");
            
        }
        
    }
    
    if ($_SERVER['REQUEST_METHOD'] == "POST" && !isset($_POST['ticketSubmit']) && !isset($_POST['forgotPasswordSubmit']) && !isset($_POST['signInSubmit']) ) {
        
        $firstname = strip_tags($_POST['firstname']);
        $lastname = strip_tags($_POST['lastname']);
        $username = strip_tags($_POST['username']);
        $email = strip_tags($_POST['email']);
        $phone = strip_tags($_POST['phone']);
        $twitter = strip_tags($_POST['twitter']);
        $insta = strip_tags($_POST['insta']);
        $sex = strip_tags($_POST['sex']);
        $platform = strip_tags($_POST['platform']);
        $country = strip_tags($_POST['country']);
        
        if (empty($firstname)) {
            
            $errorLog[] = "لا تترك خانة الإسم الأول فارغة";

        } elseif (!preg_match("/^[\p{Arabic}a-zA-Z]+$/u", $firstname)) {
            
            $errorLog[] = "يسمح فقط بالأحرف في خانة الإسم الأول";

        } elseif (strlen($firstname) > 30) {
            
            $errorLog[] = "خانة الإسم الأول يجب أن تكون أقل من 30 حرف";

        } elseif (empty($lastname)) {
            
            $errorLog[] = "لا تترك خانة الإسم الأخير فارغة";

        } elseif (!preg_match("/^[\p{Arabic}a-zA-Z]+$/u", $lastname)) {
            
            $errorLog[] = "يسمح فقط بالأحرف في خانة الإسم الأخير";

        } elseif (strlen($lastname) > 30) {
            
            $errorLog[] = "خانة الإسم الأخير يجب أن تكون أقل من 30 حرف";

        } elseif (empty($username)) {
            
            $errorLog[] = "لا تترك خانة الإسم المستعار فارغة";

        } elseif (strlen($username) > 30) {
            
            $errorLog[] = "خانة الإسم المستعار يجب أن تكون أقل من 30 حرف";

        } elseif (empty($email)) {
            
            $errorLog[] = "لا تترك خانة البريد الإلكتروني فارغة";

        }
        
        $count = DataCount("email", "users", "email", $email);
        
        if ($count > 0) {
            
            $errorLog[] = "البريد الإلكتروني مأخوذ سابقًا";

        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {

            $errorLog[] = "البريد الإلكتروني غير صحيح";

        } elseif (strlen($email) > 40 || strlen($email) < 6) {
            
            $errorLog[] = "خانة البريد الإلكتروني يجب أن تكون بين 6 - 40";

        } elseif (empty($phone)) {
            
            $errorLog[] = "لا تترك خانة رقم الهاتف فارغة";

        }
        
        $count = DataCount("phone", "users", "phone", $phone);
        
        if ($count > 0) {
            
            $errorLog[] = "رقم الجوال مأخوذ سابقًا";

        } elseif (!is_numeric($phone)) {
            
            $errorLog[] = "يسمح فقط بالأرقام في خانة رقم الهاتف";

        } elseif (strlen($phone) > 15 || strlen($phone) < 6) {
            
            $errorLog[] = "خانة رقم الهاتف يجب أن تكون بين 6 - 15";

        } elseif (empty($twitter) && empty($insta)) {
            
            $errorLog[] = "يجب عليك الإختيار بين تويتر أو إنستقرام";

        } elseif (!empty($twitter)) { 
            
            if ($twitter[0] != "@") {
            
                $errorLog[] = "خانة حساب تويتر يجب أن تبدأ ب @";

            } elseif (strlen($twitter) > 18 || strlen($twitter) < 3) {

                $errorLog[] = "خانة حساب تويتر يجب أن تكون بين 3 - 18";

            }
        
        } elseif (!empty($insta)) {
            
             if ($insta[0] != "@") {

                $errorLog[] = "خانة حساب انستقرام يجب أن تبدأ ب @";

            } elseif (strlen($insta) > 18 || strlen($insta) < 3) {
            
                $errorLog[] = "خانة حساب انستقرام يحب أن تكون بين 3 - 18";

            }
        
        } elseif (empty($sex)) {
            
            $errorLog[] = "لا تترك خانة الجنس فارغة";
  
        } elseif (empty($platform)) {
            
            $errorLog[] = "لا تترك خانة المنصة فارغة";
  
        } elseif (empty($country)) {
            
            $errorLog[] = "لا تترك خانة الدولة فارغة";

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
            
            // insert main part of form
                        
            foreach ($sections as $section) {
                
                if (isset($_POST[  $section['sectioncut'] . "Submit"  ])) {
                    
                    $sectionSubmit = $_POST;
                    
                    $specialty = $section['sectioncut'];
                    $sectionName = $section['sectionname'];
                    
                }
            }

            $randPassword = randomPassword(); // random password
            $passwordHashed = password_hash($randPassword, PASSWORD_DEFAULT);

            $stmt = $con->prepare("INSERT INTO `users` (`firstname`, `lastname`, `username`, `email`, `password`, `phone`, `twitter`, `instagram`, `sex`, `country`, `specialty`, `platform`, `role`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 'pending')");

            $stmt->execute([$firstname, $lastname, $username, $email, $passwordHashed, $phone, $twitter, $insta, $sex, $country, $specialty, $platform]);


            $stmt = $con->prepare("SELECT `id` FROM `users` WHERE `email` = ?");
            $stmt->execute([$email]);
            $row = $stmt->fetch();
            $insertid = $row['id'];
            $count = $stmt->rowCount();
        
        }
        
        if (isset($sectionSubmit)) {
            
            if (empty($errorLog)) {

                foreach ($sections as $section) {
                    
                    if ($section['sectioncut'] . "Submit" == $specialty . "Submit") {

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
                        $values = [];
                        $valueFI = [];
                        $sForms = [];

                        foreach ($sectionForms as $form) {

                            if ($form == "") {
                                break;           // don't count the empty forms ..
                            }

                            // validation

                            // XSS Filter                    
                            $value = strip_tags($sectionSubmit[$specialty . $form]);
                            
                             // for insert to mysql after validation
                            array_push($values, $value);

                            $terms = getDatav2("*", "sectionterms", "sectionid", $section['sectionid'] . " AND formname = '$form'");

                            foreach ($terms as $term) {

                                if ($term['number'] == 1) {
                                
                                    if ($value > $term['max'] || $value < $term['min']) {

                                        $errorLog[] = "يجب أن تكون خانة $form بين " . $term['min'] . " - " . $term['max'];

                                    } 
                                    
                                } if ($term['number'] == 0) {
                                    
                                    if (strlen($value) > $term['max'] || strlen($value) < $term['min']) {

                                        $errorLog[] = "يجب أن تكون خانة $form بين " . $term['min'] . " - " . $term['max'];

                                    } 
                                    
                                } if ($term['empty'] == 0) {

                                    if (empty($value)) {

                                        $errorLog[] = "لا تترك خانة $form فارغة";

                                    }

                                } if ($term['number'] == 1) {

                                    if (!is_numeric($value)) {

                                        $errorLog[] = "يسمح فقط بالأرقام في خانة $form";

                                    }

                                } if ($term['selection'] == 1) {
                                    
                                    $selectionpool = explode(", ", $term['selectionpool']);

                                    if (in_array($value, $term['selectionpool'])) {
                                        
                                        $errorLog[] = "يجب أن يكون الإختيار من القائمة المحددة في خانة $form";
                                        
                                    }

                                }

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

                            if ($count > 0) {

                                foreach ($sectionForms as $form) {

                                    if ($form != "") {

                                        array_push($sForms, ", `" . $form . "`");

                                    } else {

                                        array_push($sForms, "");

                                    }                                

                                }
                                
                                for ($n=0; $n<8; $n++) {
                                    
                                    if (isset($values[$n])) {
                                        
                                        array_push($valueFI, ", '" . $values[$n] . "'");
                                        
                                    } elseif (!isset($values[$n])) {
                                        
                                        array_push($valueFI, "");
                                        
                                    }
                                    
                                }

                                $stmt = $con->prepare("INSERT INTO `$specialty` (`userid`" . $sForms[0] . $sForms[1] . $sForms[2] . $sForms[3] . $sForms[4] . $sForms[5] . $sForms[6] . $sForms[7] . ") VALUES (" . $insertid . "" . $valueFI[0] . $valueFI[1] . $valueFI[2] . $valueFI[3] . $valueFI[4] . $valueFI[5] . $valueFI[6] . $valueFI[7] . ")");
                                $stmt->execute();

                                include("includes/templates/mailSend.php");


                            }

                        } else {

                                $stmt = $con->prepare("DELETE FROM `users` WHERE `users`.`id` = ?");
                                $stmt->execute([$insertid]);

                                $errorLog[] = "حدثت مشكلة أثناء العملية يرجى الإعادة لاحقًا او التواصل معنا لحل المشكلة";

                        }

                    }
                    
                }
                
            }
            
        }
        
    }

    if (isset($_POST['ticketSubmit'])) {
        
        // validation
        
        // XSS Filter
        if(isset($_SESSION['userid'])) {
            
            $fullname = $_SESSION['firstname'] . " " . $_SESSION['lastname'];
            $email = $_SESSION['email'];
            
        } elseif(!isset($_SESSION['userid'])) {
            
            $fullname = strip_tags($_POST['fullname']);
            $email = strip_tags($_POST['email']);
            
        }
        
        $type = strip_tags($_POST['type']);
        $subject = strip_tags($_POST['subject']);
        $describe = strip_tags($_POST['describe']);
        

        if (empty($fullname)) {

            $errorLog[] = "لا تترك خانة الإسم الكامل فارغة";

        } elseif (strlen($fullname) > 25 || strlen($fullname) < 5) {

            $errorLog[] = "يجب أن يكون الإسم الكامل بين 5 - 25";

        } elseif (empty($email)) {

            $errorLog[] = "لا تترك خانة الإيميل فارغة";

        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {

            $errorLog[] = "البريد الإلكروني خاطئ";

        } elseif (strlen($email) > 40 || strlen($email) < 6) {

            $errorLog[] = "يجب أن يكون البريد الإلكتروني بين 6 - 40";

        } elseif (empty($type)) {

            $errorLog[] = "لا تترك خانة النوع فارغة";

        } elseif ($type == "مساعدة") {
            
            if (!isset($_SESSION['userid'])) {
                
                $errorLog[] = "ينبغي عليك تسجيل الدخول اولًا للمساعدة";
                
            }
            
        } if (empty($subject)) {

            $errorLog[] = "لا تترك خانة الموضوع فارغة";

        } elseif (strlen($subject) > 60 || strlen($subject) < 8) {

            $errorLog[] = "يجب أن يكون الموضوع بين 8 - 40";

        } elseif (empty($describe)) {

            $errorLog[] = "لا تترك خانة الوصف فارغة";

        } elseif (strlen($describe) > 350 || strlen($describe) < 60) {

            $errorLog[] = "يجب أن يكون الوصف بين 60 - 350";

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
                
            // insert to database after finish validation
            
            $stmt = $con->prepare("INSERT INTO `tickets` (`ticketname`, `ticketemail`,`tickettype`, `ticketsubject`, `ticketdescribe`, `ticketdate`) VALUES (?, ?, ?, ?, ?, now())");
            $stmt->execute([$fullname, $email, $type, $subject, $describe]);
            
            header("Location: insertSuccess.php");
            
            
        }
        
    }
?>
<div class="welcome" id="welcome">
    <div class="hero">
        <div class="hero-inner wow fadeInDown">
            <div class="text-center">
                <div class="welcome-header">
                    <img src="<?php echo $websiteLogo; ?>" class="img-avatar" alt="">
                    <h1>
                        <?php echo $websiteName; ?>
                    </h1>
                </div>
                <div class="welcome-body">
                    <p key="index-title" class="lead lang">للرياضة الإلكترونية <?php echo $websiteName; ?> الموقع الرسمي لفريق</p>
                    <?php if(!isset($_SESSION['userid'])) { ?>
                    <div class="form-group">
                        <a href="#membersShowAndJoin"><button type="submit" class="btn btn-dark lang" key="index-btn-signup">الإنضمام</button></a>
                        <a href="#"><button type="submit" class="btn btn-outline-light lang" data-toggle="modal" data-target="#signIn" key="index-btn-login">تسجيل الدخول</button></a>
                    </div>
                     <?php } elseif (isset($_SESSION['userid'])) { ?>
                    <div class="form-group">
                        <a href="logout.php"><button type="submit" class="btn btn-dark"><i class="fas fa-sign-out-alt"></i></button></a>
                        <a href="<?php if($_SESSION['role'] == "administration") { echo "eSportACP/index.php"; }
                                   elseif($_SESSION['role'] == "manager") { echo "eSportMCP/index.php"; }
                                   elseif($_SESSION['role'] == "support") { echo "eSportSCP/index.php"; }
                                   elseif($_SESSION['role'] == "member") { echo "memberCP/index.php"; }
                                   elseif($_SESSION['role'] == "pending") { echo "memberCP/index.php"; }
                           ?>"><button type="submit" class="btn btn-info lang" key="index-btn-gotoPanel">الانتقال للوحة التحكم</button></a>
                    </div>
                     <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php if(!isset($_SESSION['userid'])) { ?>
<div class="signIn">
    <div class="modal fade" id="signIn" tabindex="-1" role="dialog" aria-labelledby="signIn" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    
                    <br class="clearfloats" />
                    
                    <h5 class="modal-title lang" id="exampleModalLabel" key="index-signin">تسجيل الدخول</h5>
                </div>
                <div class="modal-body">
                    <form onsubmit="return signInValidateForm();" method="post" action="#" name="signIn">
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="signInEmail" class="labelRight lang" key="index-label-email">البريد الإلكتروني</label>
                                <input name="signInEmail" type="email" class="form-control inputRight" id="signInEmail">
                                <div class="invalid-feedback">
                                    <span id="signInEmailLog"></span>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="signInPassword" class="labelRight lang" key="index-label-password">الرمز السري</label>
                                <input name="signInPassword" type="password" class="form-control inputRight" id="signInPassword">
                                <div class="invalid-feedback">
                                    <span id="signInPasswordLog"></span>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="close forgotPassword" data-dismiss="modal" aria-label="Close">
                                <a href="#" class="lang" data-toggle="modal" data-target="#forgotPassword" key="index-passwordforgot">هل نسيت كلمة المرور ؟</a>
                            </button>
                            <button type="submit" name="signInSubmit" class="btn btn-primary lang" key="index-signIn">تسجيل الدخول</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="forgotPassword" tabindex="-1" role="dialog" aria-labelledby="forgotPassword" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    
                    <br class="clearfloats" />
                    
                    <h5 class="modal-title lang" id="exampleModalLabel" key="index-new-password">كلمة مرور جديدة</h5>
                </div>
                <div class="modal-body">
                    <form method="post" action="#" name="forgotPassword">
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="forgotPasswordEmail" class="labelRight lang" key="index-label-email">البريد الإلكتروني</label>
                                <input name="forgotPasswordEmail" type="email" class="form-control inputRight" id="forgotPasswordEmail">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" name="forgotPasswordSubmit" class="btn btn-primary lang" key="index-new-password-send">إرسال كلمة المرور للبريد الإلكتروني</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php } ?>


<div class="aboutUs" id="aboutUs">
    <div class="container">
        <div class="row wow bounceInLeft">
            <div class="col-lg-9 about-body">
                <h2 class="h1 lang" key="index-whoarewe">من نحن ؟</h2>
                <p class="lead lang" key="index-main-about">فريق الإلكتروني  تم اعتماده من قبل اتحاد الرياضات الإلكترونية والذهنية في عام ٢٠١٩ بشكل رسمي
طموحه تمثيل المملكة العربية السعودية في البطولات العالمية وتحقيق البطولات والمراتب متقدمة في البطولات الداخلية</p>
            </div>
            <div class="col-lg-3">
                <img src="<?php echo $websiteLogo; ?>" class="aboutLogo" alt="">
            </div>
        </div>
    </div>
</div>

<div class="membersCount" id="membersCount">
    <div id="bg">
        <canvas></canvas>
        <canvas></canvas>
        <canvas></canvas>
    </div>
    <center>
        <div class="container">
            <h2 class="h1 wow slideInDown lang" key="index-members">أعضاء الفريق</h2>
            <div class="row">
                <div class="col-lg-6 wow flipInX">
                    <div class="card">
                        <div class="card-header card-header-icon">
                            <div class="card-icon">
                                <i class="fas fa-user-friends icon"></i>
                            </div>
                            <p class="card-category lang" key="index-team-count">الفرق</p>
                            <h3 class="card-title"><?php echo DataCount("sectionid", "sections", 1, 1); ?></h3>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 wow flipInX">
                    <div class="card">
                        <div class="card-header card-header-icon">
                            <div class="card-icon">
                                <i class="fas fa-gamepad icon"></i>
                            </div>
                            <p class="card-category lang" key="index-members-count">الأعضاء</p>
                            <h3 class="card-title"><?php echo playersCount(); ?></h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </center>
</div>

<div class="membersShowAndJoin" id="membersShowAndJoin">
    <center>
        <h2 class="h1 wow flipInY lang" key="index-team-join">الفرق وطلب الإنضمام</h2>
        <div class="membersShow" id="membersShow">
            <div class="container">
                <div class="owl-carousel carousel owl-theme">
                    <?php
                    $dataDelay = 0;
                    foreach ($sections as $sectionCard) {
                        
                    
                        $sectionMName = $sectionCard['sectionname'];
                        $sectionCName = $sectionCard['sectioncut'];

                        if (empty($sectionCard['sectionpicture'])) {
                            
                            $sectionBG = "includes/layout/images/Section_Default.jpg";
                            
                        } else {
                        
                            $sectionBG = $sectionCard['sectionpicture'];
                            
                        }
                        
                        
                        $dataDelay += 0.2;
                        
                        if ($dataDelay == 0.8) { $dataDelay = 0.2; };
                        
                    ?>
                    
                    
                  <div class="card wow fadeInUp" id="<?php echo $sectionCName; ?>Card" data-wow-delay="<?php echo $dataDelay; ?>s">
                        <div class="card-img">
                            <img class="card-img-top" src="<?php echo $sectionBG; ?>">
                            <div class="overlay"></div>
                            <div class="card-options">
                                <button class="btn btn-light" onclick="joinShowsIn('<?php echo $sectionCName; ?>Show');">عرض الأعضاء</button>
                                <button class="btn btn-dark" onclick="joinFormsIn('<?php echo $sectionCName; ?>Form');">طلب الإنضمام</button>
                            </div>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $sectionMName; ?></h5>
                            <p class="card-text lang" key="index-team-members-count">عدد اللاعبين: <?php echo membersCount("specialty", $sectionCName); ?></p>
                        </div>
                    </div>
                        
                    
                    
              <?php  } ?>
                    
                </div>
                <br class="clearfloats" />
            </div>
        </div>
        <div class="joinForms">
            
            <?php foreach ($sections as $section) {
            
                $sectionName = $section['sectioncut'];
            
            ?>
            <div class="<?php echo $sectionName; ?>Form joinFormC">
                <div class="container">
                    <form onsubmit="return validateJoinForms('<?php echo $sectionName; ?>Form');" method="post" action="#" name="<?php echo $sectionName; ?>">
                        <?php include "includes/templates/joinformsmain.php"; ?>
                        <div class="form-row">
                            
                            <?php 
                            
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
                                
                                $terms = getDatav2("*", "sectionterms", "sectionid", $section['sectionid'] . " AND formname = '$form'");
                                
                                foreach ($terms as $term) {

                                    if ($term['selection'] == 0) {

                                        if ($term['number'] == 0) {
                                            ?>

                                            <div class="form-group col-md-3">
                                                <label for="<?php echo $sectionName . $form; ?>" class="labelRight"><?php echo $form; ?></label>
                                                <input name="<?php echo $sectionName . $form; ?>" type="text" class="form-control inputRight" id="<?php echo $sectionName . $form; ?>">
                                                <div class="invalid-feedback">
                                                    <span id="<?php echo $sectionName . $form . "Log"; ?>"></span>
                                                </div>
                                            </div>

                                            <?php
                                        } elseif ($term['number'] == 1) {
                                            ?>

                                            <div class="form-group col-md-3">
                                                <label for="<?php echo $sectionName . $form; ?>"><?php echo $form; ?></label>
                                                <input name="<?php echo $sectionName . $form; ?>" type="text" class="form-control inputRight" id="<?php echo $sectionName . $form; ?>">
                                                <div class="invalid-feedback">
                                                    <span id="<?php echo $sectionName . $form . "Log"; ?>"></span>
                                                </div>
                                            </div>

                                            <?php                
                                        }

                                    } elseif ($term['selection'] == 1) {

                                            $selectionpool = explode(", ", $term['selectionpool']);

                                            ?>

                                            <div class="form-group col-md-3">
                                                <label for="<?php echo $sectionName . $form; ?>"><?php echo $form; ?></label>
                                                <select name="<?php echo $sectionName . $form; ?>" class="form-control inputRight" id="<?php echo $sectionName . $form; ?>">
                                                    <option selected></option>


                                                    <?php foreach ($selectionpool as $pool) { ?>



                                                    <option value="<?php echo $pool; ?>"><?php echo $pool; ?></option>


                                                    <?php } ?>

                                                </select>
                                                <div class="invalid-feedback">
                                                    <span class="lang" key="index-form-choose" id="<?php echo $sectionName . $form . "Log"; ?>">
                                                        إختر شيئًا
                                                    </span>
                                                </div>
                                            </div>

                                      <?php  
                                    }

                            }
                            }
    
                            ?>
                        </div>
                        <button type="submit" class="btn btn-primary joinFormsSubmit lang" name="<?php echo $sectionName . "Submit"; ?>" key="index-form-send">أرسل</button>
                    </form>
                    <button type="submit" class="btn btn-dark lang" onclick="joinFormsOut('<?php echo $sectionName; ?>Form');" id="joinFormsBack" key="index-form-back">الرجوع للخلف</button>
                </div>
            </div>
            <?php } ?>
        </div>
        <div class="joinShows">
            <?php 
            
                foreach ($sections as $sectionShow) {
                    
                    $sectionJName = $sectionShow['sectioncut'];
            
                    echo "<div class='"  . $sectionJName .   "Show'>";
                        echo "<div class='container'>";
                            echo "<div class='owl-carousel members-carousel owl-theme'>";
                    
                                $players = joinShow($sectionJName);
                                
                                foreach ($players as $player) {
                                    
                                    if (empty($player['picture'])) {
                                        
                                        $player['picture'] = "includes/layout/images/Member_Default.jpg";
                                        
                                    }
                                    
                                    switch ($player['sex']) {
                                        case "male":
                                            $sex = "<i class='fas fa-mars'></i>";
                                            break;
                                            
                                        case "female":
                                            $sex = "<i class='fas fa-venus'></i>";
                                            break;
                                    }
                                    
                                    switch ($player['platform']) {
                                        case "pc":
                                            $platform = "<i class='fas fa-laptop'></i>";
                                            break;
                                            
                                        case "ps4":
                                            $platform = "<i class='fab fa-playstation'></i>";
                                            break;
                                            
                                        case "xbox":
                                            $platform = "<i class='fab fa-xbox'></i>";
                                            break;
                                    }
                                    
                                    switch ($player['role']) {
                                        case "administration":
                                            $role = "<img src='includes/layout/images/boss.svg' class='role'>";
                                            break;
                                            
                                        case "manager":
                                            $role = "<img src='includes/layout/images/manager.svg' class='role'>";
                                            break;
                                            
                                        case "support":
                                            $role = "<img src='includes/layout/images/admin.svg' class='role'>";
                                            break;
                                            
                                        case "member":
                                            switch ($player['sex']) {
                                                case "male":
                                                    $role = "<img src='includes/layout/images/boy.svg' class='role'>";
                                                    break;
                                                    
                                                case "female":
                                                    $role = "<img src='includes/layout/images/girl.svg' class='role'>";
                                                    break;
                                            }
                                            break;
                                    }
                                    
                                    echo "<div class='card " . $sectionJName . "ShowCard' id='ShowCard'>";
                                        echo "<div class='card-img'>";
                                            echo "<img class='card-img-top' src='" . $player['picture'] . "'>";
                                        echo "</div>";
                                        echo "<div class='card-body'>";
                                            echo "<h5 class='card-title'>"  . $player["username"] .  "</h5>";
                                            echo "<p class='card-text'>"  . $sex . " | " . $platform . " | " . $role ."</p>";
                                        echo "</div>";
                                    echo "</div>";
                                }
                            
                    
                            echo "</div>";
                    
                            echo "<button type='submit' class='btn btn-dark " . $sectionJName . "ShowBtn lang' key='index-form-back' onclick=\"joinShowsOut('" . $sectionJName . "Show');\">الرجوع للخلف</button>";
                    
                    
                        echo "</div>";
                    echo "</div>";
                        
                }
            
            ?>
            </div>
    </center>
</div>
<div class="callUsBackGround">
    <br class="clearfloats" />
    <div class="callUs" id="callUs">
        <div class="container">
            <h2 class="h1 wow lightSpeedIn lang" key="index-contact">تواصل معنا</h2>
            <p class="lead wow lightSpeedIn lang">يمكنك التواصل معنا عن طريق الهاتف أو البريد الإلكتروني ويمكنك أيضا فتح تذكرة</p>
            <div class="tickets wow zoomInDown">
                <form onsubmit="return ticketValidateForm();" method="post" action="#" name="ticket">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="fullname" class="lang" key="index-ticket-fullname">الإسم كاملًا</label>                        
                            <input type="text" class="form-control" id="fullname" <?php if(isset($_SESSION['userid'])) { echo "disabled"; } ?> name="fullname" value="<?php if(isset($_SESSION['userid'])) { echo $_SESSION['firstname'] . " " . $_SESSION['lastname']; } ?>">
                            
                            <div class="invalid-feedback">
                              <span id="fullNameLog"></span>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="email" class="lang" key="index-label-email">البريد الإلكتروني</label>
                            <input type="email" class="form-control" id="email" name="email" <?php if(isset($_SESSION['userid'])) { echo "disabled"; } ?> value="<?php if(isset($_SESSION['userid'])) { echo $_SESSION['email']; } ?>" placeholder="ahmed@gmail.com">
                            <div class="invalid-feedback">
                                <span id="emailLog"></span>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-lg-12">
                            <label for="type" class="lang" key="index-ticket-type">نوع التذكرة</label>
                            <select class="form-control" id="type" name="type">
                                <option selected></option>
                                <option class="lang" key="index-ticket-complaint" value="شكوى">شكوى</option>
                                <option class="lang" key="index-ticket-suggestion" value="اقتراح">اقتراح</option>
                                <option class="lang" key="index-ticket-help" value="مساعدة">مساعدة (تتطلب تسجيل دخول)</option>
                            </select>
                            <div class="invalid-feedback lang" key="index-form-choose">
                              إختر شيئًا
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-lg-12">
                            <label for="subject" class="lang" key="index-ticket-subject">عنوان التذكرة</label>
                            <input type="text" class="form-control" id="subject" name="subject">
                            <div class="invalid-feedback">
                                <span id="subjectLog"></span>  
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-lg-12">
                            <label for="describe" class="lang" key="index-ticket-desc">وصف التذكرة</label>
                            <textarea class="form-control" id="describe" name="describe" rows="4"></textarea>
                            <div class="invalid-feedback">
                                <span id="describeLog"></span>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary lang" name="ticketSubmit" key="index-form-send">أرسل</button>
                </form>
            </div>
            <div class="contact wow rotateInDownRight">
                <div class="row">

                </div>
                <div class="row">
                    <!-- <div class="col-lg-12">
                        <p class="lead">0566983066 :الهاتف <i class="fas fa-phone-square"></i></p>
                    </div> -->
                    <div class="col-lg-12">
                        <p class="lead lang"><span class="lang" key="index-ticket-email"><?php echo $websiteContactEmail; ?> :البريد الإلكتروني</span> <i class="fas fa-envelope-square"></i></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="feeds">
    <div class="container">
        <h2 class="h1 lang" key="index-last-news">آخر الأخبار</h2>
        <div class="feed-container">
                <iframe src="TwitterWidget.html" frameborder="0" class="twitterIframe"></iframe>
        </div>
    </div>
</div>

<a class="scroll-up" href="#welcome">
    <span class="left-bar"></span>
    <span class="right-bar"></span> 
    <svg width="40" height="40">
        <line class="top" x1="0" y1="0" x2="120" y2="0"/>
        <line class="left" x1="0" y1="40" x2="0" y2="-80"/>
        <line class="bottom" x1="40" y1="40" x2="-80" y2="40"/>
        <line class="right" x1="40" y1="0" x2="40" y2="1200"/>
    </svg>
</a>

<section class="loadingOverLay text-center">
    <div class="sk-folding-cube loading">
        <div class="sk-cube1 sk-cube"></div>
        <div class="sk-cube2 sk-cube"></div>
        <div class="sk-cube4 sk-cube"></div>
        <div class="sk-cube3 sk-cube"></div>
    </div>
</section>

<?php

    if (isset($insert)) {
        echo $insert;
    }

?>


<?php include "includes/templates/footer.php"; ?>