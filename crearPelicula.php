<?php
session_start();
//comprobar de dónde viene la llamada
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
            <input type="hidden" name="metodo" value="crear">
            <div class="campo-form">
                <label for="titulo">Título:</label>
                <input type="text" name="titulo" required>
            </div>
            <div class="campo-form">
                <label for="precio">Precio:</label>
                <input type="number" name="precio" required>
            </div>
            <div class="box campo-form">
                <label for="directores">Director</label>
            <select name="directores">
                <?php
                    while($director = mysqli_fetch_assoc($lista_directores)){
                        echo "<option value='$director[id]'>$director[nombre] $director[apellido]</option>";
                    }
                ?>
            </select>
            </div>
            <div class="sub-formulario">
                <a class="nuevoRegistro" href="admin.php">Volver</a>
                <input class="nuevoRegistro" type="submit" value="Enviar datos">
            </div>
        </form>
        <?php
            if (isset($_SESSION['mensaje'])) {
                echo "<p>" . $_SESSION['mensaje'] . "</p>";
                unset($_SESSION['mensaje']); // Limpiar el mensaje después de mostrarlo
            }
            if (isset($_SESSION['datos_insertados'])) {
                echo "<h2>Última película guardada:</h2>";
                echo "<ul>";
                foreach ($_SESSION['datos_insertados'] as $campo => $valor) {
                    echo "<li>" . ucfirst($campo) . ": " . htmlspecialchars($valor) . "</li>";
                }
                echo "</ul>";
                
                unset($_SESSION['datos_insertados']);//limpiar los datos después de mostrarlos
            }
        ?>
    </div>
</body>
</html>