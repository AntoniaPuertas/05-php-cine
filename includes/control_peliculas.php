<?php
session_start();

require 'funciones_peliculas.php';

if(isset($_POST) && isset($_POST['metodo']) && $_POST['metodo'] === 'crear'){
    $titulo = $_POST['titulo'];
    $precio = $_POST['precio'];
    $director = $_POST['directores'];


    $respuesta = crear_Pelicula($titulo, $precio, $director);

    if ($respuesta) {
        $_SESSION['mensaje'] = "Los datos se insertaron correctamente.";
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



if (isset($_POST) && isset($_POST['metodo']) && $_POST['metodo'] === 'delete') {

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
}else{
        //no vienen los datos necesarios
        echo json_encode(['success' => false, 'message' => 'Método no permitido']);
}   

