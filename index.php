<?php
    session_start();

    if((isset($_COOKIE['Authorization']) && isset($_SESSION['ID'])) || (isset($_COOKIE['User']) && isset($_SESSION['ID']))) {
        
    }
    else {
        session_destroy();
    }

    /*require 'src/utils/jwt.php';
    $test = generate_jwt('eascenciog65@gmail.com');
    echo "JWT => " . $test . "\n";
    verify_jwt($test);*/

    
    /*if ($_SESSION['ROLE'] == 'user') {
        //call_user_func($views_routes[$path], 'user');
        session_destroy();
    }*/
    /*if(isset($_SESSION['ID'])) {
        if($_SESSION['ID'] == 1) {
            if(!isset($_COOKIE['Authorization'])) {
                session_destroy();
                header('Location: /');
            }
        }
    }*/

    require 'src/config/dbInit.php';
    require 'src/routes/index.php';
?>