<?php

    include "../db_connect.php";

    $stmt = $con->prepare("DELETE FROM `visitors`");
    $stmt->execute();

?>