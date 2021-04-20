<?php 

    spl_autoload_register('user_route');

    if(isset($_POST['post_register']) == true) {
        $register_data = [
            'fname' => $_POST['fname'],
            'lname' => $_POST['lname'],
            'username' => $_POST['username'],
            'password' => $_POST['password'],
        ];

        $user = new UserController();
        $user->registerUser($register_data);
    }

    if(isset($_POST['post_login']) == true) {
        $login_data = [
            'login_username' => $_POST['login_username'],
            'login_password' => $_POST['login_password']
        ];

        $user = new UserController();
        $user->loginUser($login_data);
    }

    function user_route() {
        include_once '../controllers/UserController.php';
    }

?>