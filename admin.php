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

        </header>
        <main>
            <h1>Administación</h1>
            <div class="crear">
               <a href="crearPelicula.php"> <button class="nuevoRegistro">Registrar nueva película</button></a>
            </div>
            <table class="tabla-peliculas">
                <thead>
                    <th>ID</th>
                    <th>Título</th>
                    <th>Precio</th>
                    <th>Modificar</th>
                    <th>Eliminar</th>
                </thead>
                <?php
                    while($pelicula = mysqli_fetch_assoc($lista_peliculas)){ ?>
                        <tr>
                            <td><?php echo $pelicula['id']; ?></td>
                            <td><?php echo $pelicula['titulo']; ?></td>
                            <td class="precio"><?php echo $pelicula['precio'] ?> €</td>
                            <td class="td-icono"><button>🖋️</button></td>
                            <td class="td-icono"><button>❌</button></td>
                        </tr>
                  <?php }
                ?>
                </table>
        </main>
        <footer>

        </footer>
        
    </div>
</body>
</html>