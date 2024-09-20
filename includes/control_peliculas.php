<?php
session_start();

require 'funciones_peliculas.php';

$metodo = '';
if(isset($_POST) && isset($_POST['metodo'])){
    $metodo = $_POST['metodo'];
}

switch($metodo){
    case 'crear':
        crearPelicula();
        break;
    case 'delete':
        deletePelicula();
        break;
    case 'modificar':
        modificarPelicula();
        break;
    case 'modificacion':
        modificacionPelicula();
        break;
    default:
        return 'Método no permitido';
}

function crearPelicula(){
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
function deletePelicula(){
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
function modificarPelicula(){
    $_SESSION['idPelicula'] = $_POST['idPelicula'];
    $_SESSION['metodo'] = $_POST['metodo'];
    header("Location: ../crearPelicula.php");
}
function modificacionPelicula(){
    $id = $_POST['id'];
    $titulo = $_POST['titulo'];
    $precio = $_POST['precio'];
    $director = $_POST['directores'];


    $respuesta = modificar_pelicula($id, $titulo, $precio, $director);

    if ($respuesta) {
        $_SESSION['mensaje'] = "Los datos se modificaron correctamente.";
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


