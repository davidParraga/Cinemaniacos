<?php
session_start();
require_once 'conexion.php';

$id = $_SESSION['iduser'];
$nombre=$_POST['nombre'];
$location = "Location: ../micuenta.php";


try {
    $consulta = "UPDATE users SET name=" . "'" . $nombre . "'";
    $consulta .= "WHERE id=" ."'" . $id . "'";
    $pdo->query($consulta);
    header($location);

} catch (PDOException $e) {
    die();
    header($location);
}
?>