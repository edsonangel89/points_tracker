<?php

    class User {

        static public $server_db = 'localhost';
        static public $user_db = 'libertyw_puntoaqua';
        static public $password_db = 'puntoaquafortheworld';
        static public $name_db = 'libertyw_pointstrackerdb';
        static public $name_users_table = 'users';

        static public function get_users() {
            $table = self::$name_users_table;
            $sql_get_users = " SELECT * FROM $table ";
            try {
                $conn = new mysqli(self::$server_db, self::$user_db, self::$password_db, self::$name_db);
                $query = $conn->query($sql_get_users);
                if($query->num_rows > 0) {
                    $users = [];
                    while($row = $query->fetch_assoc()) {
                        $users[] = $row;
                    }
                    return $users;
                }
                $conn->close();
            }
            catch(mysqli_sql_exception $e) {
                echo $e->GetMessage();
            }
        }

        static public function get_user_by_id($uid) {
            $table = self::$name_users_table;
            $sql_query = "SELECT * FROM $table WHERE UserID=$uid";
            try {
                $conn = new mysqli(self::$server_db, self::$user_db, self::$password_db, self::$name_db);
                $query = $conn->query($sql_query);
                if($query->num_rows > 0) {
                    $user = $query->fetch_assoc();
                    $conn->close();
                    return $user;
                }
                else {
                    $conn->close();
                    return false;
                }
            }
            catch(mysqli_sql_exception $e) {
                echo $e->GetMessage();
            }
        }

        static public function get_user_by_email($email) {
            $table = self::$name_users_table;
            $sql_query = "SELECT * FROM $table WHERE Email='$email'";
            try {
                $conn = new mysqli(self::$server_db, self::$user_db, self::$password_db, self::$name_db);
                $query = $conn->query($sql_query);
                if($query->num_rows > 0) {
                    $user = $query->fetch_assoc();
                    $conn->close();
                    return $user;
                }
                else {
                    $conn->close();
                    return false;
                }
            }
            catch (sqli_sql_exception $e) {
                echo $e->GetMessage();
                exit;
            }
        }

        static public function add_user($fname, $lname, $email, $password, $role, $points, $prize, $verify) {
            $table = self::$name_users_table;
            $sql_create_user = "INSERT INTO $table (
                FirstName,
                LastName,
                Email,
                Password,
                Role,
                Points,
                Prize,
                EmailVerified
            ) VALUES (
                '$fname',
                '$lname',
                '$email',
                '$password',
                '$role',
                '$points',
                '$prize',
                '$verify'
            )";
            try {
                $conn = new mysqli(self::$server_db, self::$user_db, self::$password_db, self::$name_db);
                $create = $conn->query($sql_create_user);
                if($create) {
                    $conn->close();
                    return true;
                }
            }
            catch (mysqli_sql_exception $e) {
                $error = $e->GetMessage();
                if(preg_match_all('/Duplicate/', $error)) {
                    echo json_encode('duplicated-user');
                }
                else {
                    echo json_encode('db-error');
                }
                return false;
            }
        }

        static public function update_user_info($uid, $fname, $lname) {
            $table = self::$name_users_table;
            $sql_update_info = "UPDATE $table SET 
            FirstName='$fname',
            LastName='$lname'
            WHERE UserID=$uid";
            try {
                $conn = new mysqli(self::$server_db, self::$user_db, self::$password_db, self::$name_db);
                $update_info = $conn->query($sql_update_info);
                if($update_info) {
                    $conn->close();
                    return true;
                }
            }
            catch (mysqli_sql_exception $e) {
                echo $e->GetMessage();
            }
        }

        static public function update_user_points($uid, $points, $prize) {
            $table = self::$name_users_table;
            $sql_update_points = "UPDATE $table SET
            Points='$points',
            Prize='$prize' 
            WHERE UserID='$uid'
            ";
            try {
                $conn = new mysqli(self::$server_db, self::$user_db, self::$password_db, self::$name_db);
                $update_points = $conn->query($sql_update_points);
                if($update_points) {
                    $conn->close();
                    return true;
                }
            }
            catch (sqli_sql_exception $e) {
                echo $e->GetMessage();
            }
        }

        static public function update_user_prize($uid, $prize) {
            $table = self::$name_users_table;
            $sql_update_points = "UPDATE $table SET
            Prize='$prize' 
            WHERE UserID='$uid'
            ";
            try {
                $conn = new mysqli(self::$server_db, self::$user_db, self::$password_db, self::$name_db);
                $update_prize = $conn->query($sql_update_points);
                if($update_prize) {
                    $conn->close();
                    return true;
                }
            }
            catch (sqli_sql_exception $e) {
                echo $e->GetMessage();
            }
        }

        static public function get_points_prizes($uid) {
            $table = self::$name_users_table;
            $sql_get_points_prizes = "SELECT
            Points,
            Prize
            FROM $table WHERE UserID='$uid'
            ";
            try {
                $conn = new mysqli(self::$server_db, self::$user_db, self::$password_db, self::$name_db);
                $points_prizes = $conn->query($sql_get_points_prizes);
                if($points_prizes->num_rows > 0) {
                    $points = $points_prizes->fetch_assoc();
                }
                else {
                    $conn->close();
                    return 'Usuario no existe';
                }
                $conn->close();
                return $points;
            }
            catch (sqli_sql_exception $e) {
                echo $e->GetMessage();
            }
        }

        static public function delete_user($uid) {
            $table = self::$name_users_table;
            $sql_delete = "DELETE FROM $table WHERE UserID=$uid";
            try {
                $conn = new mysqli(self::$server_db, self::$user_db, self::$password_db, self::$name_db);
                $delete = $conn->query($sql_delete);
                if($delete) {
                    $conn->close();
                    return true;
                }
                else {
                    $conn->close();
                    return false;
                }
            }
            catch (sqli_sql_exception $e) {
                echo $e->GetMessage();
                return false;
            }
        }

        static public function update_email_verify($email) {
            $table = self::$name_users_table;
            $sql_email_verify = "UPDATE $table SET
            EmailVerified=1 WHERE Email='$email'
            ";
            try {
                $conn = new mysqli(self::$server_db, self::$user_db, self::$password_db, self::$name_db);
                $email_verify = $conn->query($sql_email_verify);
                if($email_verify) {
                    $conn->close();
                    return true;
                }
                else {
                    $conn->close();
                    return false;
                }
            }
            catch (sqli_sql_exception $e) {
                echo $e->GetMessage();
            }
        }

    }
?>