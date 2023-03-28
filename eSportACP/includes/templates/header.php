<?php 

session_start();
ob_start();

?>
<?php 

if (!isset($_SESSION['userid'])) {
    
    header("Location: ../index.php");
    
} elseif ($_SESSION['role'] != "administration") {
    
    header("Location: ../index.php");
    
}

$userData = userData($_SESSION['userid']);

$_SESSION['firstname'] = $userData['firstname'];
$_SESSION['lastname'] = $userData['lastname'];
$_SESSION['username'] = $userData['username'];
$_SESSION['email'] = $userData['email'];
$_SESSION['phone'] = $userData['phone'];
$_SESSION['twitter'] = $userData['twitter'];
$_SESSION['insta'] = $userData['instagram'];
$_SESSION['specialty'] = $userData['specialty'];
$_SESSION['sex'] = $userData['sex'];
$_SESSION['country'] = $userData['country'];
$_SESSION['platform'] = $userData['platform'];
$_SESSION['role'] = $userData['role'];
$_SESSION['picture'] = $userData['picture'];

if(isset($_SESSION['userid']) && empty($userData)) {

    header("Location: ../logout.php");

}

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo $websiteLogo; ?>">
    
    <title><?php echo getTitle(); ?></title>
    
    
    <link rel="stylesheet" type="text/css" href="includes/layout/css/multicheck.css">
    <link href="includes/layout/css/dataTables.bootstrap4.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="includes/layout/css/style.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="includes/layout/css/float-chart.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="includes/layout/css/style.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="includes/layout/quilljs/quill.snow.css" rel="stylesheet">    
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
    
    <!-- Chart js -->
    <script src="includes/layout/js/Chart.min.js"></script>
</head>

<body>