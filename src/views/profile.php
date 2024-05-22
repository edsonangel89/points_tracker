<?php
    require 'src/controllers/userControllers.php';
    $user_id = htmlspecialchars($_SESSION['ID']);
    $user_fname = htmlspecialchars($_SESSION['FNAME']);
    $user_lname = htmlspecialchars($_SESSION['LNAME']);
    $user = get_points_prizes($_SESSION['ID']);
    $user_points = $user['Points'];
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="src/public/assets/icons/icon.svg" type="image/svg+xml">
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
                <a class="nav-link" href="/api/sessions/logout?uid=<?php echo $user_id?>">Cerrar sesión</a>
            </div>
            <div class="nav-links-container-mobile-tablet">
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
        <div class="footer-social-media-links">
            <a href="https://www.google.com/maps/place/Punto+Aqua/@20.6551974,-103.2928797,19z/data=!4m6!3m5!1s0x8428b3f170b144a7:0xd3d21c426e3cd34d!8m2!3d20.6551973!4d-103.292236!16s%2Fg%2F11jt5d7d45?entry=ttu"><span class="material-symbols-outlined">location_on</span></a>
            <a href="https://www.facebook.com/profile.php?id=100087263527212"><i class="fa-brands fa-facebook"></i></a>
        </div>
        <div class="footer-rights">
            <p>Powered By</p>
            <a class="footer-lws-link" href="https://www.libertyws.com.mx/"><img src="src/public/assets/Logo-lws.png" alt="lws image"/></a>
            <p>Punto Aqua <?php echo date('Y');?></p>
        </div>
    </footer>
    <script src="https://kit.fontawesome.com/bf56d22860.js" crossorigin="anonymous"></script>
</body>
</html>