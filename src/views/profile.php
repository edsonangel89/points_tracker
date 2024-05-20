<?php
    require 'src/controllers/userControllers.php';
    $user_id = htmlspecialchars($_SESSION['ID']);
    $user_fname = htmlspecialchars($_SESSION['FNAME']);
    $user_lname = htmlspecialchars($_SESSION['LNAME']);
    $user = get_points_prizes($_SESSION['ID']);
    $user_points = json_encode($user['Points']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="src/public/css/profile.css" />
    <title>Inicio</title>
</head>
<body>
    <header>
        <nav>
            <div class="nav-brand-container">
                <a class="nav-brand-link" href="https://www.puntoaqua.com/"><img src="src/public/assets/brand/logo__svg.svg" alt="logo image"/></a>
            </div>
            <div class="nav-links-container-desktop">
                <!--<a class="nav-link" href="#">Soporte</a>-->
                <!--<a class="nav-link" href="#">Iniciar sesion</a>-->
                <a class="nav-link" href="/api/sessions/logout?uid=<?php echo $user_id?>">Cerrar sesión</a>
            </div>
            <div class="nav-links-container-mobile-tablet">
                <a class="nav-link" href="#"><span class="material-symbols-outlined">support_agent</span></a>
                <a class="nav-link" href="/api/sessions/logout?uid=<?php echo $user_id?>"><span class="material-symbols-outlined">login</span></a>
            </div>
        </nav>
    </header>
    <main>
        <section class="user-info">
            <table class="user-id">
                <thead>
                    <tr>
                        <th>Número de cliente</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td id="uid"><?php echo $user_id;?></td>
                    </tr>
                </tbody>
            </table>
            <table class="user-name">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Apellido</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><?php echo $user_fname;?></td>
                        <td><?php echo $user_lname;?></td>
                    </tr>
                </tbody>
            </table>
            <table class="user-points">
                <thead>
                    <tr>
                        <th>Puntos</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><?php echo $user_points;?></td>
                    </tr>
                </tbody>
            </table>
            </section>
    </main>
    <footer>

    </footer>
    <!--<script src="src/public/js/testForm.js"></script>-->
</body>
</html>