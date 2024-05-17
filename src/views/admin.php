<?php
    $user_id = htmlspecialchars($_SESSION['ID']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="src/public/css/admin.css" />
    <title>Inicio</title>
</head>
<body>
    <header>
        <nav>
            <div class="nav-brand-container">
                <a class="nav-brand-link" href="#"><img src="src/public/assets/brand/logo__svg.svg" alt="logo image"/></a>
            </div>
            <div class="nav-links-container-desktop">
                <!--<a class="nav-link" href="#">Soporte</a>--> 
                <!--<a class="nav-link" href="#">Iniciar sesion</a>-->
                <a id="customer-link-desktop" class="nav-link" href="https://www.puntoaqua.com/info">Clientes</a>
                <a id="logout-link-desktop" class="nav-link" href="https://www.puntoaqua.com/api/sessions/logout?uid=<?php echo $user_id ?>">Cerrar sesión</a>
            </div>
            <div class="nav-links-container-mobile-tablet">
                <!--<a class="nav-link" href="#"><span class="material-symbols-outlined">support_agent</span></a>-->
                <a id="customer-link-mobile" class="nav-link" href="https://www.puntoaqua.com/info">Clientes</a>
                <a id="logout-link-mobile" class="nav-link" href="https://www.puntoaqua.com/api/sessions/logout?uid=<?php echo $user_id ?>"><span class="material-symbols-outlined">logout</span></a>
                <!--<a class="nav-link" href="#"><span class="material-symbols-outlined">login</span></a>-->
            </div>
        </nav>
    </header>
    <main>
        <section>
            <form id="points-form" class="form-container">
                <div class="label">
                    <label>Cliente</label><br>
                </div>
                <div class="input">
                    <input id="client" type="number" min="2" required/><br>     
                </div>
                <div class="label">
                    <label>Puntos</label><br>
                </div>
                <div class="input">
                    <input id="points" type="number" min="0" required/><br> 
                </div>
                <div class="input-submit-login">
                    <input id="points-btn" type="submit" value="Agregar"/>
                </div>
            </form>
        </section>
        <div id="accept-form-container" class="accept-form-container">
            <form id="accept-form" class="accept-form">
                <div class="notification-container">
                    <label>PROMOCION</label>
                </div>
                <div class="input-submit-login">
                    <input id="accept-btn" type="submit" value="Aceptar"/>
                </div>
            </form>
        </div>
    </main>
    <script src="src/public/js/pointsForm.js"></script>
</body>
</html>