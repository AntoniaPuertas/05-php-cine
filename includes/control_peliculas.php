<?php
session_start();

require 'funciones_peliculas.php';

$metodo = '';

if(isset($_POST) && isset($_POST['metodo'])){
    $metodo = $_POST['metodo'];
}

if($metodo === 'crear'){
    $titulo = $_POST['titulo'];
    $precio = $_POST['precio'];
    $director = $_POST['directores'];


    $respuesta = crear_Pelicula($titulo, $precio, $director);

    if ($respuesta) {
        $_SESSION['mensaje'] = "Los datos se insertaron correctamente.";
        $_SESSION['accion'] = "Última película guardada";
        $_SESSION['datos_insertados'] = [
            'titulo' => $titulo,
            'precio' => $precio,
            'director' => $director
        ];
    } else {
        $_SESSION['mensaje'] = "Error: " . mysqli_connect_error();
    }
    header("Location: ../crearPelicula.php");
    exit();
}



if ($metodo === 'delete') {

    $id = $_POST['id'];
    //llama a eliminar pelicula
    $respuesta = eliminar_pelicula($id);
    if($respuesta){
        //la pelicula ha sido eliminada
        echo json_encode(['success' => true, 'message' => 'Película eliminada']);
    }else{
        //la base de datos nos devuelve un error
        echo json_encode(['success' => false, 'message' => 'Datos inválidos']);
    }
}


if ($metodo === 'modificar'){
    $_SESSION['idPelicula'] = $_POST['idPelicula'];
    $_SESSION['metodo'] = 'modificar';
    //llamar a crearPelicula.php
    //pasarle el id de la pelicula a modificar
    header("Location: ../crearPelicula.php");
    exit();
}

if($metodo === 'modificacion'){

    $id = $_POST['id'];
    $titulo = $_POST['titulo'];
    $precio = $_POST['precio'];
    $director = $_POST['directores'];

    $respuesta = modificar_pelicula($id, $titulo, $precio, $director);

    if ($respuesta) {
        $_SESSION['mensaje'] = "Los datos se modificaron correctamente.";
        $_SESSION['accion'] = "Película modificada";
        $_SESSION['datos_insertados'] = [
            'titulo' => $titulo,
            'precio' => $precio,
            'director' => $director
        ];
    } else {
        $_SESSION['mensaje'] = "Error: " . mysqli_connect_error();
    }
    header("Location: ../crearPelicula.php");
    exit();
}

