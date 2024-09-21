<?php
session_start();
require_once 'sesion/check_session.php';
    require 'includes/funciones_directores.php';
    require 'includes/funciones_peliculas.php';

    require_login();
    $lista_directores = obtener_directores();

    //comprobar de dónde viene la llamada
    $pelicula = '';
    if(isset($_SESSION['metodo']) && $_SESSION['metodo'] === 'modificar'){
        //modificar pelicula
        $id = $_SESSION['idPelicula'];
        $respuesta = obtener_pelicula_por_id($id);
        $pelicula = mysqli_fetch_assoc($respuesta);
        //destruyo las variables de sesión
        unset($_SESSION['metodo']);
        unset($_SESSION['idPelicula']);
    }
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
        <header>
            <a id="cerrarSesion" class="derecha" href="sesion/logout.php">Cerrar sesión</a>
        </header>
        <?php echo ($pelicula != '') ? '<h1>Modificar Película</h1>' : '<h1>Registrar nueva película</h1>' ?>
        
        <form class="formulario-creacion" action="includes/control_peliculas.php" method="post">
            <input type="hidden" name="metodo" value="<?php echo ($pelicula != '') ? 'modificacion' : 'crear' ?>">
            <input type="hidden" name="id" value="<?php echo ($pelicula != '') ? $pelicula['id'] : '' ?>">
            <input type="hidden" name="metodo" value="<?php echo ($pelicula != '') ? 'modificacion' : 'crear' ?>">
            <input type="hidden" name="id" value="<?php echo ($pelicula != '') ? $pelicula['id'] : '' ?>">
            <div class="campo-form">
                <label for="titulo">Título:</label>
                <input 
                type="text" 
                name="titulo" 
                value="<?php echo ($pelicula != '') ? $pelicula['titulo'] : '' ?>" 
                required>
            </div>
            <div class="campo-form">
                <label for="precio">Precio:</label>
                <input 
                type="text" 
                pattern="^\d*(\.\d{0,2})?$" 
                inputmode="decimal"
                name="precio" 
                value="<?php echo ($pelicula != '') ? $pelicula['precio'] : '' ?>"
                required>
            </div>
            <div class="box campo-form">
                <label for="directores">Director</label>
            <select name="directores">
                <?php
                    $currentDirector = ($pelicula != '') ? $pelicula['id_director'] : '';
                    $currentDirector = ($pelicula != '') ? $pelicula['id_director'] : '';
                    while($director = mysqli_fetch_assoc($lista_directores)){
                        $selected = ($currentDirector == $director['id']) ? 'selected' : '';
                        echo "<option 
                        value='$director[id]'
                        $selected
                        >$director[nombre] $director[apellido]</option>";
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
                echo '<div class="resultadoConsulta">';
                echo "<p>" . $_SESSION['mensaje'] . "</p>";
                unset($_SESSION['mensaje']); // Limpiar el mensaje después de mostrarlo
            }
            if (isset($_SESSION['datos_insertados'])) {
                echo "<h3>Última película guardada:</h3>";

                foreach ($_SESSION['datos_insertados'] as $campo => $valor) {
                    echo "<p>" . ucfirst($campo) . ": " . htmlspecialchars($valor) . "</p>";
                }
                echo "</div>";
                unset($_SESSION['datos_insertados']);//limpiar los datos después de mostrarlos
                unset($_SESSION['accion']);//limpiar los datos después de mostrarlos
            }
        ?>
        
    </div>
</body>
</html>