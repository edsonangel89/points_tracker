<?php

    $path = substr(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), 8);
    
    $main_routes = [
        '/' => 'src/routes/viewRoutes.php',
        '/api/users' => 'src/routes/userRoutes.php',
        '/api/sessions' => 'src/routes/sessionRoutes.php',
        '404' => 'src/views/404.php'
    ];

    if (preg_match_all('/\//', $path) == 1 && $path == '/') {
        header('Location: home');
    }
    elseif (preg_match_all('/\//', $path) == 1) {
        require $main_routes['/'];
    }
    elseif (preg_match_all('[\/api\/users]', $path)) {
        require $main_routes['/api/users'];
    }
    elseif (preg_match_all('[\/api\/sessions]', $path)) {
        require $main_routes['/api/sessions'];
    }
    else {
        require $main_routes['404'];
    }

?>