<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="src/public/css/login.css" />
    <title>Inicio</title>
</head>
<body>
    <header>
        <nav>
            <div class="nav-brand-container">
                <a class="nav-brand-link" href="/home"><img src="src/public/assets/brand/logo__svg.svg" alt="logo image"/></a>
            </div>
            <div class="nav-links-container-desktop">
                <!--<a class="nav-link" href="#">Soporte</a>-->
                <!--<a class="nav-link" href="#">Iniciar sesion</a>-->
            </div>
            <div class="nav-links-container-mobile-tablet">
                <!--<a class="nav-link" href="#"><span class="material-symbols-outlined">support_agent</span></a>-->
                <!--<a class="nav-link" href="#"><span class="material-symbols-outlined">login</span></a>-->
            </div>
        </nav>
    </header>
    <main>
        <section class="login-form-container">
            <form id="login-form" class="form-container">
                <div class="label">
                    <label>Correo electrónico</label><br>
                </div>
                <div class="input">
                    <input id="email" type="text" class="input-submit-login" maxlength=60 required/><br>
                </div>
                <div class="label">
                    <label>Contraseña</label><br>
                </div>
                <div class="input">
                    <input id="password" type="password" class="input-submit-login" maxlength=30 required/><br>
                </div>
                <div class="link-sign">
                    <span>Aún no tienes cuenta?</span>
                    <a href="https://www.puntoaqua.com/sign">Regístrate</a><br>
                </div>
                <div class="input-submit-login">
                    <input type="submit" value="Iniciar sesión"/>
                </div>
            </form>
        </section>
    </main>
    <script src="src/public/js/loginForm.js"></script>
</body>
</html>