<?php
    header("Cache-Control: no-cache");
    header("Pragma: no-cache");
    header("Expires: 0");
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="src/public/css/login.css" />
    <link rel="stylesheet" href="src/public/css/sign.css" />
    <title>Registro</title>
</head>
<body>
    <header>
        <nav>
            <div class="nav-brand-container">
                <a class="nav-brand-link" href="https://www.puntoaqua.com"><img src="src/public/assets/brand/logo__svg.svg" alt="logo image"/></a>
            </div>
            <div class="nav-links-container-desktop">
                
            </div>
            <div class="nav-links-container-mobile-tablet">
                
            </div>
        </nav>
    </header>
    <main>
        <section>
            <form id="sign-form" class="form-container">
                <div class="label">
                    <label>Nombre</label><br>
                </div>
                <div class="input">
                    <input id="fname" type="text" class="input-submit-login" maxlength=35 required/><br>
                </div>
                <div class="label">
                    <label>Apellido</label><br>
                </div>
                <div class="input">
                    <input id="lname" type="text" class="input-submit-login" maxlength=35 required/><br>
                </div>
                <div class="label">
                    <label>Correo electrónico</label><br>
                </div>
                <div class="input">
                    <input id="email" type="text" class="input-submit-login" maxlength=60 required/><br>
                </div>
                <div class="password-advice">
                    <p>La contraseña solo puede contener letras mayúsculas o minúsculas y números</p>
                </div>
                <div class="label">
                    <label>Contraseña</label><br>
                </div>
                <div class="input">
                    <input id="password" type="password" class="input-submit-login" maxlength=30 required/><br>
                    <span class='contrasena-alert'>No coinciden las contraseñas</span><br>
                </div>
                <div class="label">
                    <label>Confirmar contraseña</label><br>
                </div>
                <div class="input">
                    <input id="confirm-password" type="password" class="input-submit-login" maxlength=30 required/><br>
                    <span class='contrasena-alert'>No coinciden las contraseñas</span><br>
                </div>
                <div class="input-submit-login">
                    <input type="submit" value="Registrar"/>
                </div>
            </form>
        </section>
    </main>
    <script src="src/public/js/signForm.js"></script>
</body>
</html>