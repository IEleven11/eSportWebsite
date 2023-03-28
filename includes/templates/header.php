<?php

    session_start();
    ob_start();

    if(isset($_SESSION['userid'])) {
        
        $userData = userData($_SESSION['userid']);

        $_SESSION['firstname'] = $userData['firstname'];
        $_SESSION['lastname'] = $userData['lastname'];
        $_SESSION['username'] = $userData['username'];
        $_SESSION['email'] = $userData['email'];
        $_SESSION['phone'] = $userData['phone'];
        $_SESSION['twitter'] = $userData['twitter'];
        $_SESSION['insta'] = $userData['instagram'];
        $_SESSION['specialty'] = $userData['specialty'];
        $_SESSION['platform'] = $userData['platform'];
        $_SESSION['role'] = $userData['role'];
        
    } 

    if(isset($_SESSION['userid']) && empty($userData)) {
        
        header("Location: logout.php");
        
    }

    $visitor_ip = $_SERVER['REMOTE_ADDR'];

    // checking if user not exist

    $stmt = $con->prepare("SELECT COUNT(`visitorid`) FROM `visitors` WHERE `visitorip` = ?");
    $stmt->execute([$visitor_ip]);
    $count = $stmt->fetchColumn();


    if ($count <= 0) {
        
        $stmt = $con->prepare("INSERT INTO `visitors` (`visitorip`, `visitDate`) VALUES (?, now());");
        $stmt->execute([$visitor_ip]);
        
    }


?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="keywords" content="">
        <meta name="theme-color" content="#1F262D" />
        <!-- Favicon icon -->
        <link rel="icon" type="image/png" sizes="16x16" href="<?php echo $websiteLogo; ?>">
        
        <title><?php echo getTitle(); ?></title>

        <link rel="stylesheet" type="text/css" href="includes/layout/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="includes/layout/css/all.min.css"> <!-- font awesome -->
        <link rel="stylesheet" type="text/css" href="includes/layout/css/animate.css">
        <link rel="stylesheet" type="text/css" href="includes/layout/css/style.css">
        <link rel="stylesheet" type="text/css" href="includes/layout/css/owl.carousel.min.css">
        
        <style>
            .welcome {
                background: url(<?php echo $websiteMainBackground; ?>) fixed no-repeat;
            }
        </style>
        
    </head>
<body data-spy="scroll" data-target=".navbar" data-offset="62">