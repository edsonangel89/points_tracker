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
            <div class="instructions-container">
                <div class="instructions-ad">
                    <h2>Ya puedes verificar tus puntos en línea!!!</h2>
                </div>
                <div class="instructions-title">
                    <h3>Sigue estos sencillos pasos</h3>
                </div>
                <div class="instructions-steps">
                    <ol>
                        <li>Regístrate</li>
                        <p>Ingresa al botón de inicio de sesión que se encuentra en la parte superior derecha</p>
                        <p>En el formulario presiona el link con la leyenda "Regístrate"</p>
                        <img class="img-desktop" src="src/public/assets/images/signup_form_desktop.jpg"/>
                        <img class="img-mobile" src="src/public/assets/images/signup_form_mobile.jpg"/>
                        <p>Llena el formulario con tus datos y un correo electrónico válido</p>
                        <li>Verifica tu correo</li>
                        <p>Abre la bandeja de entrada del correo electrónico que registraste</p>
                        <img class="img-desktop" src="src/public/assets/images/mail_desktop.jpg"/>
                        <img class="img-mobile" src="src/public/assets/images/mail_mobile.jpg"/>
                        <p><span class="alert">NOTA:</span> Si el correo no esta en la bandeja de entrada verifica tu bandeja de spam</p>
                        <p>Presiona en la liga con la leyenda "Confirmar correo"</p>
                        <p>Te enviará a la siguiente pantalla y significa que has confirmado tu correo correctamente</p>
                        <img class="img-desktop" src="src/public/assets/images/email_verified_desktop.jpg"/>
                        <img class="img-mobile" src="src/public/assets/images/email_verified_mobile.jpg"/>
                        <li>Inicia sesión</li>
                        <p>Ingresa al botón de inicio de sesión que se encuentra en la parte superior derecha</p>
                        <p>Ingresa el correo con el que te registraste y tu contraseña</p>
                        <img class="img-desktop" src="src/public/assets/images/login_form_desktop.jpg"/>
                        <img class="img-mobile" src="src/public/assets/images/login_form_mobile.jpg"/>
                        <li>Comienza a generar puntos</li>
                        <p>En la pantalla verás tu número de cliente, tus datos y los puntos que tienes en ese momento</p>
                        <img class="img-desktop" src="src/public/assets/images/profile_screen_desktop.jpg"/>
                        <img class="img-mobile" src="src/public/assets/images/profile_screen_mobile.jpg"/>
                        <p>Recuerda dar al vendedor tu número de cliente cuando realices compras para que aumente tus puntos</p>
                    </ol>
                </div>
            </div>
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
    <!--<script src="src/public/js/loginForm.js"></script>-->
    <script src="https://kit.fontawesome.com/bf56d22860.js" crossorigin="anonymous"></script>
</body>
</html>