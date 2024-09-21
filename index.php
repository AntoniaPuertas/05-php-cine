<?php
    require 'includes/funciones_peliculas.php';
    $lista_peliculas = obtener_peliculas();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cine</title>
    <link rel="stylesheet" href="css/estilos.css">
</head>
<body>
    <div class="container">
        <header>
        <div class="login-container">
        <?php
        if (session_status() == PHP_SESSION_NONE) { ?>
            <form id="loginForm">
                <input type="text" id="username" placeholder="Nombre de usuario" required>
                <input type="password" id="password" placeholder="Contraseña" required>
                <button class="verMas" type="submit">Iniciar Sesión</button>
            </form>
        <?php } ?>
        <div id="bloqueSaludo">
            <h2 id="saludo">Inicio de Sesión</h2>
            <a id="cerrarSesion" href="sesion/logout.php">Cerrar sesión</a>
            <a href="admin.php" id="admin">Admin</a>
        </div>
        
    </div>
        </header>
        <main>
            <h1>Películas</h1>
            <div class="listado-peliculas">
                <?php
                    while($pelicula = mysqli_fetch_assoc($lista_peliculas)){ ?>
                        <section class="pelicula">
                            <p><?php echo $pelicula['titulo']; ?></p>
                            <p class="precio"><?php echo $pelicula['precio']; ?> €</p>
                            <button class="verMas">Ver más</button>
                        </section>
                  <?php }
                ?>
                
            </div>
        </main>
        <footer>

        </footer>
        
    </div>
    <script src="js/funciones.js"></script>
</body>
</html>