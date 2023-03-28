<?php

    $pageTitle = "Members";

    include "init.php";

    $sections = getAllData("*", "sections");

?>

<?php

    $rows = MembersData();

    $errorLog = array();

    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        
        $id = $_POST['userid'];
        $firstname = strip_tags($_POST['firstname']);
        $lastname = strip_tags($_POST['lastname']);
        $username = strip_tags($_POST['username']);
        $email = strip_tags($_POST['email']);
        $phone = strip_tags($_POST['phone']);
        $twitter = strip_tags($_POST['twitter']);
        $insta = strip_tags($_POST['insta']);
        $sex = strip_tags($_POST['sex']);
        $platform = strip_tags($_POST['platform']);
        $role = strip_tags($_POST['role']);
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
        
        if ($email != $_POST['oldJoinFormEmail']) {
        
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
        
        if ($phone != $_POST['oldJoinFormPhone']) {
        
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
        
        if (empty($sex)) {
            
            $sex = $_POST['oldJoinFormSex'];
            
        } 
        
        if (empty($platform)) {
            
            $platform = $_POST['oldJoinFormPlatform'];
  
        }
        
        if (empty($role)) {
            
            $role = $_POST['oldJoinFormRole'];
  
        }
        
        if (empty($country)) {
            
            $country = $_POST['oldJoinFormCountry'];

        }
        
        foreach ($errorLog as $error) {
            echo "<div class='alert alert-danger alert-dismissible fade show'>";
                echo $error;
                echo "<button type='button' class='close' data-dismiss='alert' aria-label='Close'>";
                    echo "<span aria-hidden='true'>&times;</span>";
                echo "</button>";
            echo "</div>";
        }
        
        $sectionSubmit = $_POST;
        
        if (isset($sectionSubmit)) {
            
            if (empty($errorLog)) {

                foreach ($sections as $section) {
                    
                    $specialty = $section['sectioncut'];
                    $userSection = $sectionSubmit['usersectionname'];
                    $sectionName = $section['sectionname'];
                    
                    if ($section['sectioncut'] == $userSection) {

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
                            
                            if (isset($sectionSubmit[$specialty . $form . "Old"])) {
                                
                                $oldValue = strip_tags($sectionSubmit[$specialty . $form . "Old"]);
                                
                            }
                            
                            $value = strip_tags($sectionSubmit[$specialty . $form]);
                            array_push($values, $value);
                                
                                                        
                             // for insert to mysql after validation

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

                                        if ($term['selection'] == 1) {
                                            
                                            array_pop($values);
                                            array_push($values, $oldValue);

                                        } elseif ($term['selection'] == 0) {

                                            $errorLog[] = "لا تترك خانة $form فارغة";

                                        }

                                    }

                                } if ($term['number'] == 1) {

                                    if (!is_numeric($value)) {

                                        $errorLog[] = "يسمح فقط بالأرقام في خانة $form";

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

                            foreach ($sectionForms as $form) {

                                if ($form != "") {

                                    array_push($sForms, ", `" . $form . "`");

                                } else {

                                    array_push($sForms, "");

                                }                                

                            }

                            for ($n=0; $n<8; $n++) {

                                if (isset($values[$n])) {

                                    array_push($valueFI, "= '" . $values[$n] . "'");

                                } elseif (!isset($values[$n])) {

                                    array_push($valueFI, "");

                                }

                            }

                                $stmt = $con->prepare("UPDATE `users` JOIN `$specialty` ON `$specialty`.userid = `users`.id SET `firstname` = '$firstname', `lastname` = '$lastname', `username` = '$username', `email` = '$email', `phone` = '$phone', `twitter` = '$twitter', `instagram` = '$insta', `sex` = '$sex', `country` = '$country', `platform` = '$platform', `role` = '$role' $sForms[0] $valueFI[0] $sForms[1] $valueFI[1] $sForms[2] $valueFI[2] $sForms[3] $valueFI[3] $sForms[4] $valueFI[4] $sForms[5] $valueFI[5] $sForms[6] $valueFI[6] $sForms[7] $valueFI[7] WHERE `userid` = $id");
                            
                                $stmt->execute();

                                header("refresh: 0");

                        }

                    }
                    
                }
                
            }
            
        }
        
    }

    $id = isset($_GET['uid']) && is_numeric($_GET['uid']) ? intval($_GET['uid']) : 0;

    if(isset($_GET['do']) && isset($_GET['uid'])) {

        if ($_GET['do'] == "delete") {
            
            $stmt = $con->prepare("DELETE FROM `users` WHERE `users`.`id` = ?");
            
            $stmt->execute([$id]);
            
            header("Location: membersShow.php");
            
        }
        
    }

?>
<div class="page-wrapper">
     <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <div class="ml-auto text-right">
                    <h4 class="page-title">عرض الأعضاء</h4>
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
                            <h5 class="card-title">عرض الأعضاء</h5>
                            <div class="table-responsive">
                                <table id="zero_config" class="table table-striped table-bordered table-mobile">
                                    <thead>
                                        <tr>
                                            <th>الإسم الأول</th>
                                            <th>الإسم الأخير</th>
                                            <th>إسم المستخدم</th>
                                            <th>البريد الإلكتروني</th>
                                            <th>رقم الجوال</th>
                                            <th>حساب تويتر</th>
                                            <th>حساب انستاقرام</th>
                                            <th>الجنس</th>
                                            <th>البلد</th>
                                            <th>التخصص</th>
                                            <th>المنصة</th>
                                            <th>الرتبة</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            foreach($rows as $row) {
                                                
                                                if ($row['role'] == "administration") {
                                                    
                                                    $role = "info";
                                                    
                                                } elseif ($row['role'] == "manager") {
                                                    
                                                    $role = "warning";
                                                    
                                                } elseif ($row['role'] == "support") {
                                                    
                                                    $role = "success";
                                                    
                                                } elseif ($row['role'] == "member") {
                                                    
                                                    $role = "secondary";
                                                    
                                                }
                                                
                                                echo '<tr>';
                                                    echo '<td>' . $row['firstname'] . '<strong>الإسم الأول:</strong></td>';
                                                    echo '<td>' . $row['lastname'] . '<strong>الإسم الأخير:</strong></td>';
                                                    echo '<td>' . $row['username'] . '<strong>اسم المستخدم:</strong></td>';
                                                    echo '<td>' . $row['email'] . '<strong>البريد الإلكتروني:</strong></td>';
                                                    echo '<td>' . $row['phone'] . '<strong>رقم الجوال:</strong></td>';
                                                    echo '<td>' . $row['twitter'] . '<strong>حساب تويتر:</strong></td>';
                                                    echo '<td>' . $row['instagram'] . '<strong>حساب انستاقرام:</strong></td>';
                                                    echo '<td>' . $row['sex'] . '<strong>الجنس:</strong></td>';
                                                    echo '<td>' . $row['country'] . '<strong>البلد:</strong></td>';
                                                    echo '<td>' . $row['specialty'] . '<strong>التخصص:</strong></td>';
                                                    echo '<td>' . $row['platform'] . '<strong>المنصة:</strong></td>';
                                                    echo '<td><span class="badge badge-pill badge-' . $role . '">' . $row['role'] . '</span><strong>الرتبة</strong></td>';
                                                    echo '<td class="settings">';
                                                        echo '<button type="button" class="btn btn-outline-success btn-sm" data-toggle="modal" data-target="#memberProfileEdit_' . $row['id'] . '">';
                                                            echo 'تعديل';
                                                        echo '</button>';
                                                        echo '<button type="button" class="btn btn-outline-info btn-sm" data-toggle="modal" data-target="#memberProfile_' . $row['id'] . '">';
                                                            echo 'عرض';
                                                        echo '</button>';
                                                        echo '<a href="?uid=' . $row['id'] . '&do=delete" onclick="return memberDeleteAlert();" class="btn btn-danger btn-sm"> حذف </a>';
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
        <div class="profiles">
            
            <?php
            
                foreach($rows as $row) {
                    echo '<div class="modal fade" id="memberProfile_' . $row['id'] . '" tabindex="-1" role="dialog" aria-labelledby="memberProfile_' . $row['id'] . '" aria-hidden="true">';
                        echo '<div class="modal-dialog modal-dialog-centered" role="document">';
                            echo '<div class="modal-content">';
                                echo '<div class="modal-header">';
                                    echo '<h5 class="modal-title">ملف العضو</h5>';
                                    echo '<button type="button" class="close" data-dismiss="modal" aria-label="Close">';
                                        echo '<span aria-hidden="true">&times;</span>';
                                    echo '</button>';
                                echo '</div>';
                                echo '<div class="modal-body">';
                                    echo '<ul>';
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
                                    echo '</ul>';
                                echo '</div>';
                                echo '<div class="modal-footer">';
                                echo '</div>';
                            echo '</div>';
                        echo '</div>';
                    echo '</div>';
                } 
            ?>
        </div>
        <div class="profilesEdit">
            <?php
            
            foreach ($rows as $row) {
                
                $form = $row['specialty'];
                
            
            echo '<div class="modal fade" id="memberProfileEdit_' . $row['id'] . '" tabindex="-1" role="dialog" aria-labelledby="memberProfileEdit_' . $row['id'] . '" aria-hidden="true">';
    echo '<div class="modal-dialog modal-dialog-centered" role="document">';
        echo '<div class="modal-content">';
            echo '<div class="modal-header">';
                echo '<h5 class="modal-title">تعديل العضو</h5>';
                echo '<button type="button" class="close" data-dismiss="modal" aria-label="Close">';
                    echo '<span aria-hidden="true">&times;</span>';
                echo '</button>';
            echo '</div>';
            echo '<div class="modal-body">';
                    echo '<form class="form-horizontal" onsubmit="return validateJoinForms(\'' . $form . 'Form\',\'' . $row['id'] . '\');" action="#" method="post">';
                        echo '<input type="hidden" name="userid" value="' . $row['id'] . '">';
                        echo '<input type="hidden" name="usersectionname" value="' . $row['specialty'] . '">';
                        echo '<div class="card-body">';
                            echo '<div class="form-group row">';
                                echo '<label for="joinFormFirstname" class="col-sm-3 text-right control-label col-form-label">الإسم الأول</label>';
                                echo '<div class="col-sm-9">';
                                    echo '<input type="text" class="form-control" value="' . $row['firstname'] . '" id="joinFormFirstname" name="firstname" placeholder="">';
                                    echo '<div class="invalid-feedback">';
                                        echo '<span id="joinFormFirstnameLog"></span>';
                                    echo '</div>';
                                echo '</div>';
                            echo '</div>';
                            echo '<div class="form-group row">';
                                echo '<label for="joinFormLastname" class="col-sm-3 text-right control-label col-form-label">الإسم الأخير</label>';
                                echo '<div class="col-sm-9">';
                                    echo '<input type="text" class="form-control"  value="' . $row['lastname'] . '" id="joinFormLastname" name="lastname" placeholder="">';
                                    echo '<div class="invalid-feedback">';
                                        echo '<span id="joinFormLastnameLog"></span>';
                                    echo '</div>';
                                echo '</div>';
                            echo '</div>';
                            echo '<div class="form-group row">';
                                echo '<label for="joinFormUsername" class="col-sm-3 text-right control-label col-form-label">اسم المستخدم</label>';
                                echo '<div class="col-sm-9">';
                                    echo '<input type="text" class="form-control" value="' . $row['username'] . '"  id="joinFormUsername" name="username" placeholder="">';
                                    echo '<div class="invalid-feedback">';
                                        echo '<span id="joinFormUsernameLog"></span>';
                                    echo '</div>';
                                echo '</div>';
                            echo '</div>';
                            echo '<div class="form-group row">';
                                echo '<label for="joinFormEmail" class="col-sm-3 text-right control-label col-form-label">البريد الإلكتروني</label>';
                                echo '<div class="col-sm-9">';
                                    echo '<input type="email" class="form-control" value="' . $row['email'] . '"  id="joinFormEmail" name="email" placeholder="">';
                                    echo '<div class="invalid-feedback">';
                                        echo '<span id="joinFormEmailLog"></span>';
                                    echo '</div>';
                                    echo '<input type="hidden" name="oldJoinFormEmail" value="' . $row['email'] . '">';
                                echo '</div>';
                            echo '</div>';
                            echo '<div class="form-group row">';
                                echo '<label for="joinFormPhone" class="col-sm-3 text-right control-label col-form-label">رقم الهاتف</label>';
                                echo '<div class="col-sm-9">';
                                    echo '<input type="text" class="form-control" name="phone" value="' . $row['phone'] . '"  id="joinFormPhone" placeholder="">';
                                    echo '<div class="invalid-feedback">';
                                        echo '<span id="joinFormPhoneLog"></span>';
                                    echo '</div>';
                                    echo '<input type="hidden" name="oldJoinFormPhone" value="' . $row['phone'] . '">';
                                echo '</div>';
                            echo '</div>';
                            echo '<div class="form-group row">';
                                echo '<label for="joinFormTwitter" class="col-sm-3 text-right control-label col-form-label">تويتر</label>';
                                echo '<div class="col-sm-9">';
                                    echo '<input type="text" class="form-control" value="' . $row['twitter'] . '"  id="joinFormTwitter" name="twitter" placeholder="">';
                                    echo '<div class="invalid-feedback">';
                                        echo '<span id="joinFormTwitterLog"></span>';
                                    echo '</div>';
                                echo '</div>';
                            echo '</div>';
                            echo '<div class="form-group row">';
                                echo '<label for="joinFormInsta" class="col-sm-3 text-right control-label col-form-label">انستقرام</label>';
                                echo '<div class="col-sm-9">';
                                    echo '<input type="text" class="form-control" value="' . $row['instagram'] . '"  id="joinFormInsta" name="insta" placeholder="">';
                                    echo '<div class="invalid-feedback">';
                                        echo '<span id="joinFormInstaLog"></span>';
                                    echo '</div>';
                                echo '</div>';
                            echo '</div>';
                            echo '<div class="form-group row">';
                                echo '<label class="col-md-3 m-t-15">الجنس</label>';
                                echo '<div class="col-md-9">';
                                    echo '<select class="select2 form-control custom-select" name="sex" id="joinFormSex" style="width: 100%; height:36px;">';
                                        echo '<option selected></option>';
                                        echo '<option value="male">ذكر</option>';
                                        echo '<option value="female">أنثى</option>';
                                    echo '</select>';
                                    echo '<div class="invalid-feedback">';
                                        echo '<span id="joinFormSexLog">إختر شيئًا</span>';
                                    echo '</div>';
                                    echo '<input type="hidden" name="oldJoinFormSex" value="' . $row['sex'] . '">';
                                echo '</div>';
                            echo '</div>';
                            echo '<div class="form-group row">';
                                echo '<label class="col-md-3 m-t-15">البلد</label>';
                                echo '<div class="col-md-9">';
                                    echo '<select class="select2 form-control custom-select" name="country" id="joinFormCountry" style="width: 100%; height:36px;">';
                                   echo '<option  value="Albania">Albania</option>';
                                   echo '<option  value="Algeria">Algeria</option>';
                                   echo '<option  value="Australia">Australia</option>';
                                   echo '<option  value="Austria">Austria</option>';
                                   echo '<option  value="Azerbaijan">Azerbaijan</option>';
                                   echo '<option  value="Bahamas">Bahamas</option>';
                                   echo '<option  value="Bahrain">Bahrain</option>';
                                   echo '<option  value="Bangladesh">Bangladesh</option>';
                                   echo '<option  value="Barbados">Barbados</option>';
                                   echo '<option  value="Belarus">Belarus</option>';
                                   echo '<option  value="Belgium">Belgium</option>';
                                   echo '<option  value="Brazil">Brazil</option>';
                                   echo '<option  value="Bulgaria">Bulgaria</option>';
                                   echo '<option  value="Burkina Faso">Burkina Faso</option>';
                                   echo '<option  value="Burundi">Burundi</option>';
                                   echo '<option  value="Cambodia">Cambodia</option>';
                                   echo '<option  value="Cameroon">Cameroon</option>';
                                   echo '<option  value="Canada">Canada</option>';
                                   echo '<option  value="Chad">Chad</option>';
                                   echo '<option  value="Chile">Chile</option>';
                                   echo '<option  value="Cook Islands">Cook Islands</option>';
                                   echo '<option  value="Costa Rica">Costa Rica</option>';
                                   echo '<option  value="Côte d\'Ivoire">Côte d\'Ivoire</option>';
                                   echo '<option  value="Croatia">Croatia</option>';
                                   echo '<option  value="Cuba">Cuba</option>';
                                   echo '<option  value="Curaçao">Curaçao</option>';
                                   echo '<option  value="Cyprus">Cyprus</option>';
                                   echo '<option  value="Czech Republic">Czech Republic</option>';
                                   echo '<option  value="Denmark">Denmark</option>';
                                   echo '<option  value="Ecuador">Ecuador</option>';
                                   echo '<option  value="Egypt">Egypt</option>';
                                   echo '<option  value="Eritrea">Eritrea</option>';
                                   echo '<option  value="Estonia">Estonia</option>';
                                   echo '<option  value="Ethiopia">Ethiopia</option>';
                                   echo '<option  value="Faroe Islands">Faroe Islands</option>';
                                   echo '<option  value="Fiji">Fiji</option>';
                                   echo '<option  value="Finland">Finland</option>';
                                   echo '<option  value="France">France</option>';
                                   echo '<option  value="Gabon">Gabon</option>';
                                   echo '<option  value="Gambia">Gambia</option>';
                                   echo '<option  value="Georgia">Georgia</option>';
                                   echo '<option  value="Germany">Germany</option>';
                                   echo '<option  value="Ghana">Ghana</option>';
                                   echo '<option  value="Gibraltar">Gibraltar</option>';
                                   echo '<option  value="Greece">Greece</option>';
                                   echo '<option  value="Greenland">Greenland</option>';
                                   echo '<option  value="Grenada">Grenada</option>';
                                   echo '<option  value="Guadeloupe">Guadeloupe</option>';
                                   echo '<option  value="Guam">Guam</option>';
                                   echo '<option  value="Guatemala">Guatemala</option>';
                                   echo '<option  value="Guernsey">Guernsey</option>';
                                   echo '<option  value="Guinea">Guinea</option>';
                                   echo '<option  value="Guinea-Bissau">Guinea-Bissau</option>';
                                   echo '<option  value="Guyana">Guyana</option>';
                                   echo '<option  value="Haiti">Haiti</option>';
                                   echo '<option  value="Honduras">Honduras</option>';
                                   echo '<option  value="Hong Kong">Hong Kong</option>';
                                   echo '<option  value="Hungary">Hungary</option>';
                                   echo '<option  value="Iceland">Iceland</option>';
                                   echo '<option  value="India">India</option>';
                                   echo '<option  value="Indonesia">Indonesia</option>';
                                   echo '<option  value="Iraq">Iraq</option>';
                                   echo '<option  value="Ireland">Ireland</option>';
                                   echo '<option  value="Italy">Italy</option>';
                                   echo '<option  value="Jamaica">Jamaica</option>';
                                   echo '<option  value="Japan">Japan</option>';
                                   echo '<option  value="Jersey">Jersey</option>';
                                   echo '<option  value="Jordan">Jordan</option>';
                                   echo '<option  value="Kuwait">Kuwait</option>';
                                   echo '<option  value="Lebanon">Lebanon</option>';
                                   echo '<option  value="Libya">Libya</option>';
                                   echo '<option  value="Mexico">Mexico</option>';
                                   echo '<option  value="Morocco">Morocco</option>';
                                   echo '<option  value="Norway">Norway</option>';
                                   echo '<option  value="Oman">Oman</option>';
                                   echo '<option  value="Poland">Poland</option>';
                                   echo '<option  value="Portugal">Portugal</option>';
                                   echo '<option  value="Qatar">Qatar</option>';
                                   echo '<option  value="Saudi Arabia" selected>Saudi Arabia</option>';
                                   echo '<option  value="South Africa">South Africa</option>';
                                   echo '<option  value="Spain">Spain</option>';
                                   echo '<option  value="Sudan">Sudan</option>';
                                   echo '<option  value="Swaziland">Swaziland</option>';
                                   echo '<option  value="Sweden">Sweden</option>';
                                   echo '<option  value="Switzerland">Switzerland</option>';
                                   echo '<option  value="Syrian Arab Republic">Syrian Arab Republic</option>';
                                   echo '<option  value="Tunisia">Tunisia</option>';
                                   echo '<option  value="Turkey">Turkey</option>';
                                   echo '<option  value="Ukraine">Ukraine</option>';
                                   echo '<option  value="United Arab Emirates">United Arab Emirates</option>';
                                   echo '<option  value="United Kingdom">United Kingdom</option>';
                                   echo '<option  value="United States">United States</option>';
                                   echo '<option  value="Uruguay">Uruguay</option>';
                                   echo '<option  value="Yemen">Yemen</option>';
                                    echo '</select>';
                                    echo '<div class="invalid-feedback">';
                                        echo '<span id="joinFormCountryLog">إختر شيئًا</span>';
                                    echo '</div>';
                                    echo '<input type="hidden" name="oldJoinFormCountry" value="' . $row['country'] . '">';
                                echo '</div>';
                            echo '</div>';
                            echo '<div class="form-group row">';
                                echo '<label class="col-md-3 m-t-15">المنصة</label>';
                                echo '<div class="col-md-9">';
                                    echo '<select class="select2 form-control custom-select" name="platform" id="joinFormPlatform" style="width: 100%; height:36px;">';
                                        echo '<option selected></option>';
                                        echo '<option value="pc">PC</option>';
                                        echo '<option value="ps4">PS4</option>';
                                        echo '<option value="xbox">Xbox</option>';
                                        echo '<option value="nothing">Nothing (for Desginers and Editors)</option>';
                                    echo '</select>';
                                    echo '<div class="invalid-feedback">';
                                        echo '<span id="joinFormPlatformLog">إختر شيئًا</span>';
                                    echo '</div>';
                                    echo '<input type="hidden" name="oldJoinFormPlatform" value="' . $row['platform'] . '">';
                                echo '</div>';
                            echo '</div>';
                            echo '<div class="form-group row">';
                                echo '<label class="col-md-3 m-t-15">الرتبة</label>';
                                echo '<div class="col-md-9">';
                                    echo '<select class="select2 form-control custom-select" name="role" id="joinFormRole" style="width: 100%; height:36px;">';
                                        echo '<option selected></option>';
                                        echo '<option value="manager">Manager</option>';
                                        echo '<option value="support">Support</option>';
                                        echo '<option value="member">Member</option>';
                                    echo '</select>';
                                    echo '<div class="invalid-feedback">';
                                        echo '<span id="joinFormRoleLog">إختر شيئًا</span>';
                                    echo '</div>';
                                    echo '<input type="hidden" name="oldJoinFormRole" value="' . $row['role'] . '">';
                                echo '</div>';
                            echo '</div>';
                
                                        if ($row['role'] != "administration") {
                                            
                                            foreach ($sections as $section) {
                                                
                                                if ($section['sectioncut'] == $row['specialty']) {
                                                
                                                    $sectionName = $section['sectioncut'];

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

                                                <div class="form-group row">
                                                    <label for="<?php echo $sectionName . $form; ?>" class="col-sm-3 text-right control-label col-form-label"><?php echo $form; ?></label>
                                                    <div class="col-sm-9">
                                                        <input name="<?php echo $sectionName . $form; ?>" value="<?php echo $row[$form]; ?>" type="text" class="form-control inputRight" id="<?php echo $sectionName . $form; ?>">
                                                        <div class="invalid-feedback">
                                                            <span id="<?php echo $sectionName . $form . "Log"; ?>"></span>
                                                        </div>
                                                    </div>
                                                </div>

                                                <?php
                                            } elseif ($term['number'] == 1) {
                                                ?>

                                                <div class="form-group row">
                                                    <label for="<?php echo $sectionName . $form; ?>" class="col-sm-3 text-right control-label col-form-label"><?php echo $form; ?></label>
                                                    <div class="col-sm-9">
                                                        <input name="<?php echo $sectionName . $form; ?>" value="<?php echo $row[$form]; ?>" type="text" class="form-control inputRight" id="<?php echo $sectionName . $form; ?>">
                                                        <div class="invalid-feedback">
                                                            <span id="<?php echo $sectionName . $form . "Log"; ?>"></span>
                                                        </div>
                                                    </div>
                                                </div>

                                                <?php                
                                            }

                                        } elseif ($term['selection'] == 1) {

                                                $selectionpool = explode(", ", $term['selectionpool']);

                                                ?>

                                                <div class="form-group row">
                                                    <label for="<?php echo $sectionName . $form; ?>" class="col-sm-3 text-right control-label col-form-label"><?php echo $form; ?></label>
                                                    <div class="col-sm-9">
                                                        <select name="<?php echo $sectionName . $form; ?>" class="form-control inputRight" id="<?php echo $sectionName . $form; ?>">


                                                            <option selected></option>


                                                            <?php foreach ($selectionpool as $pool) { ?>



                                                            <option value="<?php echo $pool; ?>"><?php echo $pool; ?></option>


                                                            <?php } ?>

                                                        </select>
                                                        <input type="hidden" name="<?php echo $sectionName . $form; ?>Old" value="<?php echo $row[$form]; ?>">
                                                    </div>
                                                    <div class="invalid-feedback">
                                                        <span id="<?php echo $sectionName . $form . "Log"; ?>">
                                                            إختر شيئًا
                                                        </span>
                                                    </div>
                                                </div>

                                          <?php  
                                        }

                                    }

                                }

                            }
                        }
                    }
                
                        echo '</div>';
                        echo '<div class="border-top">';
                            echo '<div class="card-body">';
                                echo '<button type="submit" name="' . $form . 'Submit" class="btn btn-success">عدل</button>';
                            echo '</div>';
                        echo '</div>';
                    echo '</form>';
                echo '</div>';
            echo '</div>';
        echo '</div>';
    echo '</div>';
                }
            ?>
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