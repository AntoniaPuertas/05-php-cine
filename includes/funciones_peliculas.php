<?php
//Consultas a la tabla películas
function obtener_peliculas(){
    //importar conexion
    require 'database.php';

    //preparar la consulta
    $sql = "SELECT * FROM pelicula;";

    //realizar la consulta
    $resultado = mysqli_query($conexion, $sql);
    return $resultado;

}

function obtener_pelicula_por_id($id){
        //importar conexion
        require 'database.php';

        //preparar la consulta
        $sql = "SELECT * FROM pelicula WHERE id=$id;";
    
        //realizar la consulta
        $resultado = mysqli_query($conexion, $sql);
        return $resultado;
}

function crear_Pelicula($titulo, $precio, $director){
    //importar conexion
    require 'database.php';

    //crear la consulta
    $sql = "INSERT INTO pelicula(titulo, precio, id_director) VALUES ('$titulo', $precio, $director)";

    //realizar la consulta
    $resultado = mysqli_query($conexion, $sql);

    return $resultado;
}

function modificar_pelicula($id, $titulo, $precio, $director){
    //importar conexion
    require 'database.php';

    //crear la consulta
    $sql = "UPDATE pelicula SET titulo = '$titulo', precio = $precio, id_director = $director  WHERE id = $id";

    //realizar la consulta
    $resultado = mysqli_query($conexion, $sql);

    return $resultado;
}

function eliminar_pelicula($id){
    //importar conexion
    require 'database.php';
    //crear la consulta
    $sql = "DELETE FROM pelicula WHERE id=$id;";
    //realizar la consulta
    $resultado = mysqli_query($conexion, $sql);
    return $resultado;
}

