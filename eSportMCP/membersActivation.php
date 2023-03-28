<?php 

    $pageTitle = "Members";

    include "init.php";

    $sections = getAllData("*", "sections");

?>
<?php

    $id = isset($_GET['uid']) && is_numeric($_GET['uid']) ? intval($_GET['uid']) : 0;

    if(isset($_GET['do']) && isset($_GET['uid'])) {
        
        if($_GET['do'] == "accept") {
            
            $stmt = $con->prepare("UPDATE `users` SET `role` = 'member' WHERE `users`.`id` = ?");
            
            $stmt->execute([$id]);
            
            $log = "<div class='alert alert-success alert-dismissible fade show'>
                لقد تم قبول العضو
                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                    <span aria-hidden='true'>&times</span>
                </button>
            </div>";
            
        } elseif($_GET['do'] == "delete") {
            
            $stmt = $con->prepare("DELETE FROM `users` WHERE `users`.`id` = ?");
            
            $stmt->execute([$id]);
            
            $log = "<div class='alert alert-danger alert-dismissible fade show'>
                لقد تم رفض العضو
                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                    <span aria-hidden='true'>&times</span>
                </button>
            </div>";
            
        }
        
    }

?>
<div class="page-wrapper">
     <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <div class="ml-auto text-right">
                    <h4 class="page-title">تفعيل الأعضاء</h4>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="membersActivation">
            <?php 
            
            $rows = pendingMembers();

            ?>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title m-b-0">تفعيل الأعضاء</h5>
                        </div>
                        <table class="table table-mobile">
                              <thead>
                                <tr>
                                    <th scope="col">الإسم الأول</th>
                                    <th scope="col">الإسم الأخير</th>
                                    <th scope="col">اسم المستخدم</th>
                                    <th scope="col">البريد الإلكتروني</th>
                                    <th scope="col">رقم الجوال</th>
                                    <th scope="col">تويتر</th>
                                    <th scope="col">انستقرام</th>
                                    <th scope="col">الجنس</th>
                                    <th scope="col">البلد</th>
                                    <th scope="col">التخصص</th>
                                    <th scope="col">المنصة</th>
                                    <th scope="col"></th>
                                </tr>
                              </thead>
                              <tbody>
                                  <?php
                                      foreach($rows as $row) {
                                          
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
                                                echo '<td>';
                                                    echo '<button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#memberProfile_' . $row['id'] . '">';
                                                        echo 'عرض';
                                                    echo '</button>';
                                                echo '</td>';
                                            echo '</tr>';
                                            echo '<tr class="table-mobile-space-active"></tr>';
                                          
                                      }
                                  ?>
                              </tbody>
                        </table>
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
                                    echo '<a href="?uid=' . $row['id'] . '&do=accept" class="btn btn-success"> قبول </a>&nbsp;';
                                    echo '<a href="?uid=' . $row['id'] . '&do=delete" onclick="return memberDeleteAlert();" class="btn btn-danger"> رفض </a>';
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
