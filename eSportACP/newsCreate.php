<?php 

    $pageTitle = "Dashboard";

    include "init.php";

?>
<?php

    if(isset($_POST['news-submit'])) {
        
        $title = $_POST['news-title'];
        $describe = $_POST['news-describe'];
        
        $stmt = $con->prepare("INSERT INTO `news` (`newstitle`, `newsdescribe`, `newsdate`) VALUES (?, ?, now())");
        $stmt->execute([$title, $describe]);
        
        header("Location: newsShow.php");
        
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
                    <h4 class="page-title">إضافة خبر جديد</h4>
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
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <form method="post" action="#" class="form-group">
                        <div class="card-body">
                            <h4 class="card-title m-b-0">إضافة خبر جديد</h4>
                                <label class="news-title-label" for="news-title">العنوان</label>
                                <input class="form-control news-title" type="text" name="news-title">
                            <div class="editor">
                            </div>
                            <input type="hidden" id="input-describe" value="" name="news-describe">
                        </div>
                        <div class="border-top news-submit">
                            <div class="card-body">
                                <button type="submit" name="news-submit" class="btn btn-success">أرسل</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
                
<?php 

    include "includes/templates/footer.php";
        
?>
    
<script>
    
    window.addEventListener('keyup',function(){
        var describe = $(".ql-editor").html();
        $("#input-describe").val(describe);
    });
    
    window.addEventListener('mouseover',function(){
        var describe = $(".ql-editor").html();
        $("#input-describe").val(describe);
    });
    var editor = new Quill('#editor');
        var quill = new Quill('.editor', {
        theme: 'snow'
    });
</script>