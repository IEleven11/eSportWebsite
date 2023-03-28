<?php 
    /* 
    ** هذا الفنكشن يحول المتغير الي تكتبه في اي صفحة الى عنوان الصفحة 
    ** مثال " $pageTitle = 'home' == <title>home</title>"
    ** إذا المتغير ما انكتب بيكتب <title>Devilz</title>
    */

    function getTitle() {
        
        global $pageTitle;

		if (isset($pageTitle)) {

			echo $pageTitle;	

		} else {

			echo "Devilz";

		}
	}

    function DataCount($select, $table, $where, $whereValue) {
        
        global $con;
        
        $stmt = $con->prepare("SELECT $select FROM $table WHERE $where = ?");
        $stmt->execute([$whereValue]);
        
        return $stmt->rowCount();
        
    }

    function getData($select, $table, $where, $whereValue) {
        
        global $con;
        
        $stmt = $con->prepare("SELECT $select FROM $table WHERE $where = ?");
        $stmt->execute([$whereValue]);
        
        return $stmt->fetch();
    }

    function getDatav2($select, $table, $where, $whereValue) {
        
        global $con;
        
        $stmt = $con->prepare("SELECT $select FROM $table WHERE $where = $whereValue");
        $stmt->execute();
        
        return $stmt->fetchAll();
    }

    function joinShow($form) {
        
        global $con;
        
        $stmt = $con->prepare("SELECT * FROM `users` JOIN `$form` ON `$form`.userid = `users`.id WHERE `specialty` = ? AND `role` != 'pending'");
        $stmt->execute([$form]);
        
        return $stmt->fetchAll();
    }


    function membersCount($where, $whereValue) {
        
        global $con;
        
        $stmt = $con->prepare("SELECT `id` FROM `users` WHERE $where = ? AND `role` != 'pending'");
        $stmt->execute([$whereValue]);
        
        return $stmt->rowCount();
    }

    function playersCount() {
        
        global $con;
        
        $stmt = $con->prepare("SELECT `id` FROM `users` WHERE `role` != 'pending'");
        $stmt->execute();
        
        return $stmt->rowCount();
    }


    // random password generator

    function randomPassword() {
        $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
        $password = array();
        $alphaLength = strlen($alphabet) - 1;
        
        for ($i = 0; $i < 16; $i++) {
            $n = rand(0, $alphaLength);
            $password[] = $alphabet[$n];
        }
        
        return implode($password);
    }

    function userId($where, $whereValue) {
        
        global $con;
        
        $stmt = $con->prepare("SELECT `id` FROM `users` WHERE $where = ?");
        $stmt->execute([$whereValue]);
        
        return $stmt->fetch();
        
    }

    function userData($userid) {
        
        global $con;
        
        $stmt = $con->prepare("SELECT * FROM `users` WHERE `id` = ?");
        $stmt->execute([$userid]);
        
        return $stmt->fetch();
    }

    function getAllData($select, $table) {
        
        global $con;
        
        $stmt = $con->prepare("SELECT $select FROM $table");
        $stmt->execute();
        
        return $stmt->fetchAll();
    }
?>