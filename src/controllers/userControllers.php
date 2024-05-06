<?php

    require 'src/models/userModels.php';

    $server_db = 'localhost';
    $user_db = 'root';
    $password_db = '';
    $name_db = 'pointstrackerdb';
    $name_users_table = 'users';

    function get_users() {
        $table = $name_users_table;
            $sql_get_users = " SELECT * FROM $table ";
            try {
                $conn = new mysqli($server_db, $user_db, $password_db, $name_db);
                $query = $conn->query($sql_get_users);
                if($query->num_rows > 0) {
                    $users = [];
                    while($row = $query->fetch_assoc()) {
                        $users[] = $row;
                    }
                    return $users;
                }
                $conn->close();
                //setcookie('testcookie', 'testvalue', time() + 60,'','', false, true);
                echo json_encode($users);
            }
            catch(mysqli_sql_exception $e) {
                echo $e->GetMessage();
            }
    }

    function get_user_by_id($uid) {
        $table = $name_users_table;
            $sql_query = "SELECT * FROM $table WHERE UserID=$uid";
            try {
                $conn = new mysqli($server_db, $user_db, $password_db, $name_db);
                $query = $conn->query($sql_query);
                if($query->num_rows > 0) {
                    $user = $query->fetch_assoc();
                }
                else {
                    $conn->close();
                    echo json_encode('Usuario no existe');
                }
                $conn->close();
                echo json_encode($user);
            }
            catch(mysqli_sql_exception $e) {
                echo $e->GetMessage();
            }
    }

    //get_user_by_id(2);

    function add_new_user() {
        try {
                
        }
        catch(mysqli_sql_exception $e) {

        }
    }

    function update_user_info_by_id($uid, $fname, $lname, $email, $password, $role) {
        try {
                
        }
        catch(mysqli_sql_exception $e) {

        }
    }

    function update_user_points_by_id($uid, $points) {
        try {
                
        }
        catch(mysqli_sql_exception $e) {

        }
    }

    function delete_user_by_id($uid) {
        try {
                
        }
        catch(mysqli_sql_exception $e) {

        }
    }

?>