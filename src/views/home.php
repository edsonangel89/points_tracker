<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="src/public/css/home.css" />
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
                <a class="nav-link" href="/login">Iniciar sesión</a>
            </div>
            <div class="nav-links-container-mobile-tablet">
                <!--<a class="nav-link" href="#"><span class="material-symbols-outlined">support_agent</span></a>-->
                <a class="nav-link" href="/login"><span class="material-symbols-outlined">login</span></a>
            </div>
        </nav>
    </header>
    <main>
        <section>
            <!--<form id="login-form">
                <label>User</label><br>
                <input id="email" required/><br>
                <label>Password</label><br>
                <input id="password" required/><br>
                <input type="submit" value="Login"/>-->
            </form>
        </section>
    </main>
    <footer>
        <div class="">

        </div>
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
    <!--<script src="src/public/js/loginForm.js"></script>-->
    <script src="https://kit.fontawesome.com/bf56d22860.js" crossorigin="anonymous"></script>
</body>
</html>