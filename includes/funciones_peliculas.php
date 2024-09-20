<?php

function ejecutar_consulta($sql){
    require 'database.php';
    return mysqli_query($conexion, $sql);
}
//Consultas a la tabla películas
function obtener_peliculas(){
    $sql = "SELECT * FROM pelicula;";
    return ejecutar_consulta($sql);
}

function obtener_pelicula_por_id($id){
    $sql = "SELECT * FROM pelicula WHERE id=$id;";
    return ejecutar_consulta($sql);
}

function crear_Pelicula($titulo, $precio, $director){
    $sql = "INSERT INTO pelicula(titulo, precio, id_director) VALUES ('$titulo', $precio, $director)";
    return ejecutar_consulta($sql);
}

function modificar_pelicula($id, $titulo, $precio, $director){
    $sql = "UPDATE pelicula SET titulo = '$titulo', precio = $precio, id_director = $director WHERE id = $id;";
    return ejecutar_consulta($sql);
}

function eliminar_pelicula($id){
    //crear la consulta
    $sql = "DELETE FROM pelicula WHERE id=$id;";
    //realizar la consulta
    return ejecutar_consulta($sql);
}

