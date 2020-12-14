<?php
    include_once "User.php";
    $data1 = new \Crud\App\User();

    if(isset($_REQUEST['user_id'])) {
        $id = $_REQUEST['user_id'];
        print_r($id);
        die();
    }
?>