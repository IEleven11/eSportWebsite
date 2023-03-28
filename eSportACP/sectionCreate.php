<?php 

    $pageTitle = "Dashboard";

    include "init.php";

    $errorLog = array();

    if (isset($_POST['sectionCreateSubmit'])) {
        
        if ($_FILES['picture']['size'] != 0) {
        
            $imgtmp = $_FILES['picture']['tmp_name'];
            $imgName = $_FILES['picture']['name'];

            $imgTypes = ['jpg', 'png', 'gif'];


            $list = explode(".", $imgName);
            $img_type = strtolower(end($list));
            $img_name = strtolower(reset($list));
            $img_random_name = uniqid(rand(1000, 1000000)) . $imgName;

            $img_url = "includes/layout/images/$img_random_name";
            
            if (!in_array($img_type, $imgTypes) || empty($imgName)) {
            
                $errorLog[] = "يجب أن تكون صيغة الصورة إما jpg أو png أو gif";

            }
            
        }
        
        $name = strip_tags($_POST['name']);
        $cut = strip_tags($_POST['cut']);
        $form1 = strip_tags($_POST['form1']);
        $max1 = strip_tags($_POST['max1']);
        $min1 = strip_tags($_POST['min1']);
        
        if (isset($_POST['selectionPool1'])) {
        
            $_POST['selectionPool1'] = strip_tags($_POST['selectionPool1']);
            
        }

        
        
        if (empty($name)) {
            
            $errorLog[] = "لا تترك خانة اسم القسم فارغة";

        } elseif (strlen($name) > 32) {
            
            $errorLog[] = "خانة اسم القسم يجب أن تكون أقل من 32 حرف";

        } elseif (empty($cut)) {
            
            $errorLog[] = "لا تترك خانة الإسم المختصر لللقسم فارغة";

        } elseif (strlen($cut) > 8) {
            
            $errorLog[] = "خانة الإسم المختصر للقسم يجب أن تكون أقل من 8 حرف";

        } elseif (empty($form1)) {
            
            $errorLog[] = "لا تترك خانة الخاصية الأولى فارغة";

        } elseif (strlen($form1) > 18) {
            
            $errorLog[] = "خانة الخاصية الأولى يجب أن تكون أقل من 18 حرف";

        } elseif (empty($max1)) {
            
            $errorLog[] = "لا تترك خانة الحد الأقصى لخانة الخاصية الأولى فارغة";

        } elseif (strlen($max1) > 18) {
            
            $errorLog[] = "يجب أن تكون خانة الحد الأقصى لخانة الخاصية الأولى أقل من 18";

        } elseif (!is_numeric($max1)) {

            $errorLog[] = "يسمح فقط بالأرقام في خانة الحد الأقصى لخانة الخاصية الأولى";

        } elseif (empty($min1)) {
            
            $errorLog[] = "لا تترك خانة الحد الأدنى لخانة الخاصية الأولى فارغة";

        } elseif (strlen($min1) > 18) {
            
            $errorLog[] = "يجب أن تكون خانة الحد الأدنى لخانة الخاصية الأولى أقل من 18";

        } elseif (!is_numeric($min1)) {

            $errorLog[] = "يسمح فقط بالأرقام في خانة الحد الأدنى لخانة الخاصية الأولى";

        } elseif ($_POST['select1'] == 1) {
                    
            if (empty($_POST['selectionPool1'])) {

                $errorLog[] = "لا تترك خانة الخيارات الأولى فارغة";

            }

        }
        
        for ($n=2; $n<8; $n++) {
            
            if ($_POST['form' . $n] != "") {
                
                $_POST['form' . $n] = strip_tags($_POST['form' . $n]);
                $_POST['max' . $n] = strip_tags($_POST['max' . $n]);
                $_POST['min' . $n] = strip_tags($_POST['min' . $n]);
                
                if(isset($_POST['selectionPool' . $n])) {
                
                    $_POST['selectionPool' . $n] = strip_tags($_POST['selectionPool' . $n]);
                    
                }
                
                    
                if (strlen($_POST['form' . $n]) > 18) {
            
                    $errorLog[] = "خانة form$n يجب أن تكون أقل من 18 حرف";

                } elseif (empty($_POST["max" . $n])) {

                    $errorLog[] = "لا تترك خانة الحد الأقصى لخانة form$n فارغة";

                } elseif (strlen($_POST["max" . $n]) > 18) {

                    $errorLog[] = "يجب أن تكون خانة الحد الأقصى لخانة form$n أقل من 18";

                } elseif (!is_numeric($_POST["min" . $n])) {

                    $errorLog[] = "يسمح فقط بالأرقام في خانة الحد الأقصى لخانة form$n";

                } elseif (empty($_POST["min" . $n])) {

                    $errorLog[] = "لا تترك خانة الحد الأدنى لخانة form$n فارغة";

                } elseif (strlen($_POST["min" . $n]) > 18) {

                    $errorLog[] = "يجب أن تكون خانة الحد الأدنى لخانة form$n أقل من 18";

                } elseif (!is_numeric($_POST["min" . $n])) {

                    $errorLog[] = "يسمح فقط بالأرقام في خانة الحد الأدنى لخانة form$n";

                } elseif ($_POST['select' . $n] == 1) {
                    
                    if (empty($_POST['selectionPool' . $n])) {
                        
                        $errorLog[] = "لا تترك خانة selectionPool$n فارغة";
                        
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
            
            if (!isset($img_url)) {
                
                $img_url = "";
                
            }
            
            $stmt = $con->prepare("INSERT INTO `sections` (`sectionname`, `sectioncut`, `form1`, `form2`, `form3`, `form4`, `form5`, `form6`, `form7`, `form8`, `sectionpicture`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);");
            $stmt->execute([$name, $cut, $form1, $_POST['form2'], $_POST['form3'], $_POST['form4'], $_POST['form5'], $_POST['form6'], $_POST['form7'], $_POST['form8'], $img_url]);
            
            if ($_FILES['picture']['size'] != 0) {
            
                move_uploaded_file($imgtmp, "../includes/layout/images/" . $img_random_name);
                
            }
            
            $stmt = $con->prepare("SELECT `sectionid`, `form1`, `form2`, `form3`, `form4`, `form5`, `form6`, `form7`, `form8` FROM `sections` ORDER BY `sectionid` DESC LIMIT 1");
            $stmt-> execute();
            $lastRow = $stmt->fetch();
            $insertid = $lastRow['sectionid'];
            $forms = [];
            
            for ($n=1; $n<8; $n++) {
                
                if ($lastRow['form' . $n] != "") {
                    
                    array_push($forms, $lastRow['form' . $n]);
                    
                }
                
            }
            
            $n = 0;
            $selection = "";
            $selectionPool = "";
            foreach ($forms as $form) {
                
                $n++;
                
                if ($_POST['select' . $n] == 1) { $selection =  ", `selectionpool`"; $selectionPool = ", '" . $_POST['selectionPool' . $n] . "'"; }
            
                $stmt = $con->prepare("INSERT INTO `sectionterms` (`sectionid`, `formname`, `max`, `min`, `empty`, `number`, `selection`$selection) VALUES (?, ?, ?, ?, ?, ?, ?$selectionPool);");
                $stmt->execute([$insertid, $form, $_POST['max' . $n], $_POST['min' . $n], $_POST['empty' . $n], $_POST['number' . $n], $_POST['select' . $n]]);
                
            }
            
            $n = 0;
            $tableValues = "";

            foreach ($forms as $form) {
                
                $n++;
                
                if ($_POST['number' . $n] == 0) {
                    
                    $tableValues .= "`$form` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci";
                    
                } elseif ($_POST['number' . $n] == 1) {
                    
                    $tableValues .= " `$form` INT(11)";
                    
                }
                
                if ($_POST['empty' . $n] == 0) {
                
                    $tableValues .= " NOT NULL ,";

                } elseif ($_POST['empty' . $n] == 1) {
                    
                    $tableValues .= " ,";
                    
                }
                
            }

            $stmt = $con->prepare("CREATE TABLE IF NOT EXISTS $cut ( `userid` INT(11) NOT NULL , $tableValues  INDEX (`userid`)) ENGINE = InnoDB CHARSET=utf8 COLLATE utf8_general_ci;");
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
                    <h4 class="page-title">إضافة قسم جديد</h4>
                </div>
            </div>
        </div>
    </div>
        <div class="sectionCreate">
            <div class="card">
                <form class="form-horizontal" onsubmit="return validateSectionCreate();" action="#" method="post" enctype="multipart/form-data">   
                    <div class="card-body">
                        <h4 class="card-title">إضافة قسم جديد</h4>
                        <br class="clearfloats" />
                        <div class="form-group row">
                            <label for="sectionName" class="col-sm-3 text-right control-label col-form-label">اسم القسم</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control form-control-lg" id="sectionName" name="name" placeholder="Overwatch">
                                <div class="invalid-feedback">
                                    <span id="sectionNameLog"></span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="sectionCut" class="col-sm-3 text-right control-label col-form-label">الاسم المختصر للقسم</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control form-control-lg" id="sectionCut" name="cut" placeholder="ow">
                                <div class="invalid-feedback">
                                    <span id="sectionCutLog"></span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="sectionPicture" class="col-sm-3 text-right control-label col-form-label">صورة القسم (218 * 250)</label>
                            <div class="col-sm-9">
                                <input type="file" class="form-control form-control-lg" id="sectionPicture" name="picture">
                                <div class="invalid-feedback">
                                    <span id="sectionPictureLog"></span>
                                </div>
                            </div>
                        </div>
                        <br><hr><br>
                        <h5 class="card-title">معلومات القسم</h5>
                        <br class="clearfloats" />
                        <div class="table-responsive">
                            <table class="table table-borderless formsTable">
                                <thead>
                                    <tr>
                                        <th scope="col">الخاصية رقم</th>
                                        <th scope="col">اسم الخاصية</th>
                                        <th scope="col">الحد الأقصى</th>
                                        <th scope="col">الحد الأدنى</th>
                                        <th scope="col">فارغة</th>
                                        <th scope="col">ارقام فقط</th>
                                        <th scope="col">اختيار متعدد</th>
                                        <th scope="col">الخيارات</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php for ($n=1; $n<=8; $n++) { ?>

                                    <tr>
                                        <th scope="row"><?php echo $n; ?></th>
                                        <td><input type="text" class="form-control form-control" id="form<?php echo $n; ?>" name="form<?php echo $n; ?>"></td>

                                        <td>
                                            <input value="120" type="hidden" name="max<?php echo $n; ?>">
                                            <input type="text" class="form-control form-control" id="max<?php echo $n; ?>" name="max<?php echo $n; ?>">
                                        </td>

                                        <td>
                                            <input value="1" type="hidden" name="min<?php echo $n; ?>">
                                            <input type="text" class="form-control form-control" id="min<?php echo $n; ?>" name="min<?php echo $n; ?>">
                                        </td>

                                        <td>
                                            <div class="form-check">
                                                <input value="0" type="hidden" name="empty<?php echo $n; ?>">
                                                <input class="form-check-input" value="1" type="checkbox" id="empty<?php echo $n; ?>" name="empty<?php echo $n; ?>">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-check">
                                                <input value="0" type="hidden" name="number<?php echo $n; ?>">
                                                <input class="form-check-input" value="1" type="checkbox" id="number<?php echo $n; ?>" name="number<?php echo $n; ?>">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-check">
                                                <input value="0" type="hidden" name="select<?php echo $n; ?>">
                                                <input class="form-check-input" value="1" onclick="selectionPoolOn(<?php echo $n; ?>);" type="checkbox" id="select<?php echo $n; ?>" name="select<?php echo $n; ?>">
                                            </div>
                                        </td>
                                        <td><input type="text" class="form-control form-control" disabled id="selectionPool<?php echo $n; ?>" name="selectionPool<?php echo $n; ?>" placeholder="Makkah, Al Madena"></td>
                                    </tr>

                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <br>
                    <div class="border-top">
                        <div class="card-body">
                            <button type="submit" name="sectionCreateSubmit" class="btn btn-success">احفظ</button>
                            <br class="clearfloats" />
                        </div>
                    </div>
                </form>
            </div>
        </div>
    <!-- ============================================================== -->
    <!-- End Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Container fluid  -->
    <!-- ============================================================== -->
    <div class="container-fluid">
    </div>
    
    
<?php 
    
    include "includes/templates/footer.php";
        
?>