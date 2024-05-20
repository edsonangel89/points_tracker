<?php
    header("Cache-Control: no-cache, no-store, must-revalidate");
    header("Pragma: no-cache");
    header("Expires: 0");
    $user_id = htmlspecialchars($_SESSION['ID']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="src/public/css/info.css" />
    <title>Clientes</title>
</head>
<body>
<header>
        <nav>
            <div class="nav-brand-container">
                <a class="nav-brand-link" href="https://www.puntoaqua.com"><img src="src/public/assets/brand/logo__svg.svg" alt="logo image"/></a>
            </div>
            <div class="nav-links-container-desktop">
                <!--<a class="nav-link" href="#">Soporte</a>-->
                <!--<a class="nav-link" href="#">Iniciar sesion</a>-->
                <a class="nav-link" href="/">Puntos</a>
                <a class="nav-link" href="/api/sessions/logout?uid=<?php echo $user_id ?>">Cerrar sesión</a>
            </div>
            <div class="nav-links-container-mobile-tablet">
                <!--<a class="nav-link" href="#"><span class="material-symbols-outlined">support_agent</span></a>-->
                <a class="nav-link" href="/">Puntos</a>
                <a class="nav-link" href="/api/sessions/logout?uid=<?php echo $user_id ?>"><span class="material-symbols-outlined">logout</span></a>
                <!--<a class="nav-link" href="#"><span class="material-symbols-outlined">login</span></a>-->
            </div>
        </nav>
    </header>
    <main>
        <section class="login-form-container">
            <form id="info-form" class="form-container">
                <div class="label">
                    <label>Cliente</label><br>
                </div>
                <div class="input">
                    <input id="client" type="number" min="2" required/><br>     
                </div>
                <div class="input-submit-login">
                    <input type="submit" value="Ver información"/>
                </div>
            </form>
        </section>
        <section class="user-info">
            <table>
                <thead>
                    <tr>
                        <th id="tid">ID</th>
                        <th id="tfn">Nombre</th>
                        <th id="tln">Apellido</th>
                        <!--<th id="tem">Correo electrónico</th>-->
                        <th id="tpo">Puntos</th>
                    </tr>
                </thead>
                <tbody id="user-table"></tbody>
            </table>
        </section>
    </main>
    <script src="src/public/js/infoForm.js"></script>
</body>
</html>