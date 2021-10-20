<?php
session_start();
require_once 'conexion.php';

$idmovie = $_POST['idmovie'];
$iduser = $_SESSION['iduser'];
$comentario = $_POST['comentario'];
$location = "Location: ../pelicula.php?id=" . $idmovie;

try {

    $consulta = "INSERT INTO moviecomments(";
    $consulta .= "movie_id, user_id, comment";
    $consulta .= ") VALUES (";
    $consulta .= "'" . $idmovie . "', '" . $iduser . "', '" . $comentario . "');";
    $pdo->query($consulta);
    header($location);
} catch (PDOException $e) {
    die();
    header($location);
}
?>