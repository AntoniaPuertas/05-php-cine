<?php
    require 'includes/funciones_directores.php';
    $lista_directores = obtener_directores();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administración</title>
    <link rel="stylesheet" href="css/estilos.css">
</head>
<body>
    <div class="container">
        <h1>Registrar nueva película</h1>
        <form class="formulario-creacion" action="includes/control_peliculas.php" method="post">
            <div class="campo-form">
                <label for="titulo">Título:</label>
                <input type="text" name="titulo" required>
            </div>
            <div class="campo-form">
                <label for="precio">Precio:</label>
                <input type="number" name="precio" required>
            </div>
            <select name="directores">
                <option value="">Seleccione un director</option>
                <?php
                    while($director = mysqli_fetch_assoc($lista_directores)){
                        echo "<option value='$director[id]'>$director[nombre]</option>";
                    }
                ?>
            </select>
            <div class="campo-form sub-formulario">
                <input class="verMas" type="submit" value="Enviar datos">
            </div>
        </form>
    </div>
</body>
</html>