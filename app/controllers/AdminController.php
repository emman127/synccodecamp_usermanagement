<?php 

    class AdminController {

        public function getAllData() {
            // require_once "../database/config.php";
            require 'config.php';

            // if($_SERVER['REQUEST_METHOD'] == 'POST') {
                $get_all_query = 'SELECT * FROM tb_users';

                $stmt = $pdo->prepare($get_all_query);
                $stmt->execute();
                $stmt->rowCount();
                $users = $stmt->fetchall();

                return $users;
            // }
        }

        public function getSingleData($id) {
            require_once "config.php";

            if($_SERVER['REQUEST_METHOD'] === 'POST') {
                $get_id_query = 'SELECT * FROM tb_users WHERE id = :id';

                $stmt = $pdo->prepare($get_id_query);
                $stmt->bindParam(':id', $id, PDO::PARAM_INT);
                $stmt->execute();
                $row = $stmt->fetch();
                    foreach($row as $user) {
                        $output['firstname'] = $row['firstname'];
                        $output['lastname'] = $row['lastname'];
                        $output['username'] = $row['username'];
                        $output['password'] = $row['password'];
                    }

                    echo json_encode($output);
            }
        }

        public function toActivateUser($id) {
            require_once "config.php";

            if($_SERVER['REQUEST_METHOD'] === 'POST') {
                $activate_user_query = "UPDATE tb_users SET isActive = '1' WHERE id = :id";

                $stmt = $pdo->prepare($activate_user_query);
                $stmt->bindParam(':id', $id, PDO::PARAM_INT);
                if($stmt->execute()) {
                    echo json_encode(array('Status' => 200));
                }
            }
        }

        public function toDeactivateUser($id) {
            require_once "config.php";

            if($_SERVER['REQUEST_METHOD'] === 'POST') {
                $deactivate_user_query = "UPDATE tb_users SET isActive = '0' WHERE id = :id";

                $stmt = $pdo->prepare($deactivate_user_query);
                $stmt->bindParam(':id', $id, PDO::PARAM_INT);
                if($stmt->execute()) {
                    echo json_encode(array('Status' => 200));
                }
            }
        }

        public function update_user_info($data) {
            require_once "config.php";

            if($_SERVER['REQUEST_METHOD'] === 'POST') {
                $update_user_query = "UPDATE tb_users SET firstname = :fname, lastname = :lname, username = :uname WHERE id = :id";

                $stmt = $pdo->prepare($update_user_query);
                $stmt->bindParam(':fname', $data['fname'], PDO::PARAM_STR);
                $stmt->bindParam(':lname', $data['lname'], PDO::PARAM_STR);
                $stmt->bindParam(':uname', $data['uname'], PDO::PARAM_STR);
                $stmt->bindParam(':id', $data['id'], PDO::PARAM_INT);
                if($stmt->execute()) {
                    echo json_encode(array('Status' => 200));
                }
            }
        }
    }

    $adminController = new AdminController();

?>