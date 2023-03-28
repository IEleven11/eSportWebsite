<?php

    $pageTitle = "Members";

    include "init.php";

?>

<?php

    $rows = MembersData();

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
                                            <th>إسم المستخدم</th>
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
                                                    echo '<td>' . $row['username'] . '<strong>اسم المستخدم:</strong></td>';
                                                    echo '<td><span class="badge badge-pill badge-' . $role . '">' . $row['role'] . '</span><strong>الرتبة</strong></td>';
                                                    echo '<td class="settings">';
                                                    echo '<button type="button" class="btn btn-outline-info btn-sm" data-toggle="modal" data-target="#memberProfile_' . $row['id'] . '">';
                                                        echo 'عرض';
                                                    echo '</button>';
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
                                        if ($row['specialty'] == "overwatch") {
                                            
                                            echo '<li>الحساب : ' . $row['account'] . '</li>';
                                            echo '<li>نقاط الكومب : ' . $row['sr'] . '</li>';
                                            echo '<li>اللفل : ' . $row['level'] . '</li>';
                                            echo '<li>الشخصية الرئيسية : ' . $row['main'] . '</li>';
                                            
                                        } elseif ($row['specialty'] == "r6s") {
                                            
                                            echo '<li>الحساب : ' . $row['account'] . '</li>';
                                            echo '<li>الرانك : ' . $row['rank'] . '</li>';
                                            echo '<li>اللفل : ' . $row['level'] . '</li>';
                                            
                                        } elseif ($row['specialty'] == "fortnite") {
                                            
                                            echo '<li>الحساب : ' . $row['account'] . '</li>';
                                            echo '<li>القتلات : ' . $row['kills'] . '</li>';
                                            echo '<li>عدد أقيام الفوز : ' . $row['wins'] . '</li>';
                                            echo '<li>معدل القتلات لكل قيم  : ' . $row['kd'] . '</li>';
                                            
                                        } elseif ($row['specialty'] == "rl") {
                                            
                                            echo '<li>الحساب : ' . $row['account'] . '</li>';
                                            echo '<li>اللفل : ' . $row['level'] . '</li>';
                                            echo '<li>الرانك في 1v1 : ' . $row['rank1'] . '</li>';
                                            echo '<li>الرانك في 2v2 : ' . $row['rank2'] . '</li>';
                                            echo '<li>الرانك في 3v3 : ' . $row['rank3'] . '</li>';
                                            echo '<li>الرانك في 3v3 سولو : ' . $row['rank3s'] . '</li>';
                                            
                                        } elseif ($row['specialty'] == "lol") {
                                            
                                            echo '<li>الحساب : ' . $row['account'] . '</li>';
                                            echo '<li>السيرفر : ' . $row['server'] . '</li>';
                                            
                                        } elseif ($row['specialty'] == "fifa") {
                                            
                                            echo '<li>الحساب : ' . $row['account'] . '</li>';
                                            echo '<li>صورة لتشكيلته : ' . $row['link'] . '</li>';
                                            echo '<li>عدد أقيام الفوز : ' . $row['wins'] . '</li>';
                                            echo '<li>عدد أقيام الخسارة : ' . $row['losses'] . '</li>';
                                            echo '<li>عدد أقيام التعادل : ' . $row['draws'] . '</li>';
                                            
                                        } elseif ($row['specialty'] == "cod") {
                                            
                                            echo '<li>الحساب : ' . $row['account'] . '</li>';
                                            echo '<li>التخصص : ' . $row['specialization'] . '</li>';
                                            echo '<li>السلاح : ' . $row['weapon'] . '</li>';
                                            echo '<li>لقطة من لعبه : ' . $row['link'] . '</li>';
                                            
                                        } elseif ($row['specialty'] == "designer" || $row['specialty'] == "editor") {
                                            
                                            echo '<li>عمل من أعماله : ' . $row['link1'] . '</li>';
                                            echo '<li>عمل آخر من أعماله : ' . $row['link2'] . '</li>';
                                            
                                        }
                                    echo '</ul>';
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