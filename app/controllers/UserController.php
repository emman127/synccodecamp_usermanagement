<?php 

    class UserController {

        public function registerUser($data) {
            require_once 'config.php';

            if($_SERVER['REQUEST_METHOD'] == 'POST') {
                $register_query = 'CALL sproc_register (:fname, :lname, :username, :password, :isType, :isActive)';
                $istype_query = 'SELECT isType FROM tb_users WHERE isType = 1';
                $user_exists = 'SELECT username FROM tb_users WHERE username = :username';

                $stmt_istype_query = $pdo->prepare($istype_query);
                $stmt_istype_query->execute();
                // if there is an administrator
                if($stmt_istype_query->rowCount() > 0) {
                    // then check the username if exists
                    $stmt_user_exists = $pdo->prepare($user_exists);
                    $stmt_user_exists->bindParam(':username', $data['username'], PDO::PARAM_STR);
                    $stmt_user_exists->execute();
                    if($stmt_user_exists->rowCount() > 0) {
                        echo json_encode(array('Status' => 'Username Already Exists!'));
                    }
                    else {
                        // insert new user
                        $is_type = '0';
                        $is_active = '0';
                        $password_hash = password_hash($data['password'], PASSWORD_DEFAULT);

                        $stmt_register_query = $pdo->prepare($register_query);

                        $stmt_register_query->bindParam(':fname', $data['fname'], PDO::PARAM_STR);
                        $stmt_register_query->bindParam(':lname', $data['lname'], PDO::PARAM_STR);
                        $stmt_register_query->bindParam(':username', $data['username'], PDO::PARAM_STR);
                        $stmt_register_query->bindParam(':password', $password_hash, PDO::PARAM_STR);
                        $stmt_register_query->bindParam(':isType', $is_type, PDO::PARAM_STR);
                        $stmt_register_query->bindParam(':isActive', $is_active, PDO::PARAM_STR);

                        if($stmt_register_query->execute()) {
                            echo json_encode(array('Status' => 'User Inserted!'));
                        }

                    }
                }
                // if not have an administrator
                else {
                    // and check if the username is existing
                    if($stmt_user_exists = $pdo->prepare($user_exists)) {
                        $stmt_user_exists->bindParam(':username', $data['username'], PDO::PARAM_STR);
                        $stmt_user_exists->execute();
                        if($stmt_user_exists->rowCount() > 0) {
                            echo json_encode(array('Status' => 'Already Exists!'));
                        }
                        else {
                            $is_active = '1';
                            $is_type = '1';
                            $password_hash = password_hash($data['password'], PASSWORD_DEFAULT);
    
                            $stmt_register_query = $pdo->prepare($register_query);
    
                            $stmt_register_query->bindParam(':fname', $data['fname'], PDO::PARAM_STR);
                            $stmt_register_query->bindParam(':lname', $data['fname'], PDO::PARAM_STR);
                            $stmt_register_query->bindParam(':username', $data['username'], PDO::PARAM_STR);
                            $stmt_register_query->bindParam(':password', $password_hash, PDO::PARAM_STR);
                            $stmt_register_query->bindParam(':isType', $is_type, PDO::PARAM_STR);
                            $stmt_register_query->bindParam(':isActive', $is_active, PDO::PARAM_STR);
    
                            if($stmt_register_query->execute()) {
                                echo json_encode(array('Status' => 200));
                            }
                            else {
                                echo json_encode(array('Status' => 500));
                            }
                        }
                    }
                }
            }
        }

        public function loginUser($data) {
            require_once 'config.php';

            if($_SERVER['REQUEST_METHOD'] == 'POST') {
                $password_hashed = $data['login_password'];

                $login_query = 'SELECT * FROM tb_users WHERE username = :username';
                $stmt = $pdo->prepare($login_query);
                $stmt->bindParam(':username', $data['login_username'], PDO::PARAM_STR);
                if($stmt->execute()) {
                    if($stmt->rowCount() > 0) {
                        if($row = $stmt->fetch()) {
                            $firstname = $row['firstname'];
                            $lastname = $row['lastname'];
                            $username = $row['username'];
                            $password = $row['password'];
                            $isType = $row['isType'];
                            $isActive = $row['isActive'];
                            
                            if(password_verify($password_hashed, $password)) {
                                if($isActive == 1) {
                                    // Administrator
                                    if($isType == 1) {
                                        echo json_encode(array('Status' => 200));
                                        // $session_start();
                                        // $_SESSION['fname'] = $firstname;
                                        // $_SESSION['lname'] = $lastname;
                                        // $_SESSION['uname'] = $username;
                                    }
                                    // Normal User
                                    // else {
                                    //     echo json_encode(array('Status' => 199));
                                    //     $session_start();
                                    //     $_SESSION['fname'] = $firstname;
                                    //     $_SESSION['lname'] = $lastname;
                                    //     $_SESSION['uname'] = $username;
                                    // }
                                }
                                else {
                                    echo json_encode(array('Status' => 201));
                                }
                            }
                            else {
                                // Invalid password
                                echo json_encode(array('Status' => 404));
                            }
                        }
                    }
                    else {
                        // username not found
                        echo json_encode(array('Status' => 400));
                    }
                }
            }
        }
    }

?>