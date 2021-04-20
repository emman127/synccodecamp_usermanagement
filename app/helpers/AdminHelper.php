<?php 

    spl_autoload_register('admin_route');
    
    if(isset($_POST['get_id']) === true) {
        $admin = new AdminController();
        $admin->getSingleData($_POST['id']);
    }

    if(isset($_POST['activate_user']) === true) {
        $admin = new AdminController();
        $admin->toActivateUser($_POST['id']);
    }

    if(isset($_POST['deactivate_user']) === true) {
        $admin = new AdminController();
        $admin->toDeactivateUser($_POST['id']);
    }

    if(isset($_POST['update_user']) === true) {
        $data = [
            'fname' => $_POST['fname'],
            'lname' => $_POST['lname'],
            'uname' => $_POST['uname'],
            'id' => $_POST['id']
        ];
        $admin = new AdminController();
        $admin->update_user_info($data);
    }

    function admin_route() {
        include_once "../controllers/AdminController.php";
    }

?>