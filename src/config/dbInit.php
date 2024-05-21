<?php

    require 'src/utils/crypt.php';

    $server_db = 'localhost';
    $user_db = 'root';  
    $password_db = '';  
    $name_db = 'libertyw_pointstrackerdb';
    $name_users_table = 'users';

    /*$server_db = 'localhost';
    $user_db = 'libertyw_puntoaqua';
    $password_db = 'puntoaquafortheworld';
    $name_db = 'libertyw_pointstrackerdb';
    $name_users_table = 'users';*/
    
    $sql_create_db = "CREATE DATABASE $name_db";
    $sql_create_users_table = "CREATE TABLE $name_users_table (
        UserID INT PRIMARY KEY AUTO_INCREMENT,
        FirstName VARCHAR(60) NOT NULL,
        LastName VARCHAR(60) NOT NULL,
        Email VARCHAR(100) UNIQUE NOT NULL,
        Password VARCHAR(255) NOT NULL,
        Points INT,
        Prize BOOLEAN NOT NULL,
        Role ENUM('superadmin', 'admin', 'user') NOT NULL,
        EmailVerified BOOLEAN NOT NULL 
    )";

    $hashed_password = encrypt_password("puntoaquapointstracker2024");
    $sql_define_superuser = "INSERT INTO $name_users_table (
        FirstName,
        LastName,
        Email,
        Password,
        Prize,
        Role,
        EmailVerified
    ) VALUES (
        'Superadmin',
        'Admin',
        'puntoaquaoficial@gmail.com',
        '$hashed_password',
        0,
        'superadmin',
        1
    )";

    try {
        $conn_db = new mysqli($server_db, $user_db, $password_db, $name_db);
        $conn_db->query($sql_create_users_table);
        $conn_db->query($sql_define_superuser);
        $conn_db->close();
    }
    catch (mysqli_sql_exception $e) {
        try {
            $conn_db = new mysqli($server_db, $user_db, $password_db, $name_db);
            $conn_db->query($sql_create_users_table);
            $conn_db->query($sql_define_superuser);
            $conn_db->close();
        }
        catch (mysqli_sql_exception $e) {
            $conn_db = new mysqli($server_db, $user_db, $password_db, $name_db);
            $conn_db->close();
        }
    }

?>