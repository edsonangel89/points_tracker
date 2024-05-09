<!DOCTYPE html>
<html lang="en">
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
                <a class="nav-brand-link" href="#"><img src="src/public/assets/brand/logo__svg.svg" alt="logo image"/></a>
            </div>
            <div class="nav-links-container-desktop">
                <a class="nav-link" href="#">Soporte</a>
                <a class="nav-link" href="#">Iniciar sesion</a>
                <a class="nav-link" href="http://localhost/checker/api/sessions/logout?uid=1">Cerrar sesion</a>
            </div>
            <div class="nav-links-container-mobile-tablet">
                <a class="nav-link" href="#"><span class="material-symbols-outlined">support_agent</span></a>
                <a class="nav-link" href="#"><span class="material-symbols-outlined">login</span></a>
            </div>
        </nav>
    </header>
    <main>
        <section>
            <form id="login-form">
                <label>User</label><br>
                <input id="email" required/><br>
                <label>Password</label><br>
                <input id="password" required/><br>
                <input type="submit" value="Login"/>
            </form>
            <form id="points-form">
                <label>Points</label><br>
                <input id="points" type="number" min="0" required/><br>
                <input type="submit" value="Puntos"/>
            </form>
        </section>
    </main>
    <footer>

    </footer>
    <script src="src/public/js/testForm.js"></script>
</body>
</html>