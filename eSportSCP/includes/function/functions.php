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
        
        $stmt = $con->prepare("SELECT `id` FROM `users` WHERE `specialty` = 'overwatch' AND `role` != 'pending' OR `specialty` = 'r6s' AND `role` != 'pending' OR `specialty` = 'fortnite' AND `role` != 'pending' OR `specialty` = 'rl' AND `role` != 'pending' OR `specialty` = 'lol' AND `role` != 'pending' OR `specialty` = 'fifa' AND `role` != 'pending' OR `specialty` = 'cod' AND `role` != 'pending'");
        $stmt->execute();
        
        return $stmt->rowCount();
    }

    // pending members

    function pendingCount() {
        
        global $con;
        
        $stmt = $con->prepare("SELECT `id` FROM `users` WHERE `role` = 'pending'");
        
        $stmt->execute();
        
        return $stmt->rowCount();
    }

    function pendingMembers() {
        
        global $con;

        $stmt = $con->prepare("SELECT * FROM `users` JOIN `" . $_SESSION['specialty'] . "` ON `" . $_SESSION['specialty'] . "`.userid = `users`.id WHERE `role` = 'pending' AND `specialty` = ? AND `platform` = ? AND `sex` = ?");
        
        $stmt->execute([$_SESSION['specialty'], $_SESSION['platform'], $_SESSION['sex']]);
        
        return $stmt->fetchAll();
    }

    function allMembers() {
        
        global $con;
        
        $stmt = $con->prepare("SELECT `id` FROM `users` WHERE `role` != 'pending'");
        
        $stmt->execute();
        
        return $stmt->rowCount();
        
    }

    function MembersData() {
        
        global $con;
        
        $members = array();
        
        $stmt = $con->prepare("SELECT `id`, `specialty`, `role` FROM `users` WHERE `role` != 'pending'");
        
        $stmt->execute();
        
        $specialty = $stmt->fetchAll();
        
        foreach ($specialty as $spec) {
          
            if ($spec['role'] == "administration") { 
                
                $stmt = $con->prepare("SELECT * FROM `users` WHERE `role` != 'pending' AND `id` = ?");
                $stmt->execute([$spec['id']]);
                $fetch = $stmt->fetch();
                
            } else {
            
                $stmt = $con->prepare("SELECT * FROM `users` JOIN `" . $spec['specialty'] . "` ON `" . $spec['specialty'] . "`.userid = `users`.id WHERE `role` != 'pending' AND `id` = ?");
                $stmt->execute([$spec['id']]);
                $fetch = $stmt->fetch();
                
            }
            
            $members[] = $fetch;
            
        }
        
        return $members;
    }


    function ticketCount() {
        
        global $con;
        
        $stmt = $con->prepare("SELECT `ticketid` FROM `tickets`");
        
        $stmt->execute();
        
        return $stmt->rowCount();
        
    }

    function getLatest($select, $table, $order, $limit = 5) {

        global $con;

        $getStmt = $con->prepare("SELECT $select FROM $table ORDER BY $order DESC LIMIT $limit");

        $getStmt->execute();

        $rows = $getStmt->fetchAll();

        return $rows;

    }

    function tableData($table) {
        
        global $con;
        
        $stmt = $con->prepare("SELECT * FROM `$table`");
        
        $stmt->execute();
        
        return $stmt->fetchAll();
        
    }

    function getMultiData($select, $table, $where, $whereValue) {
        
        global $con;
        
        $stmt = $con->prepare("SELECT $select FROM $table WHERE $where = ?");
        $stmt->execute([$whereValue]);
        
        return $stmt->fetchAll();
    }

    function userData($userid) {
        
        global $con;
        
        $stmt = $con->prepare("SELECT * FROM `users` WHERE `id` = ?");
        $stmt->execute([$userid]);
        
        return $stmt->fetch();
    }

    function userProfile($userid, $specialty) {
        
        global $con;
        
        $stmt = $con->prepare("SELECT * FROM `users` JOIN `$specialty` ON `$specialty`.userid = `users`.id WHERE `userid` = ?");
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