<?php

    function get_home($current_role) {
        $roles = [
            'admin' => 'src/views/admin.php',
            'user' => 'src/views/profile.php',
            'nouser' => 'src/views/home.php'
        ];
        
        require $roles[$current_role];
    }

    function not_found_page() {
        require 'src/views/404.php';
    }

?>