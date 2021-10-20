<?php
session_start();
require_once 'conexion.php';

$id = $_SESSION['iduser'];
$ocupacion=$_POST['ocupacion'];
$location = "Location: ../micuenta.php";


try {
    $consulta = "UPDATE users SET ocupacion=" . "'" . $ocupacion . "'";
    $consulta .= "WHERE id=" ."'" . $id . "'";
    $pdo->query($consulta);
    header($location);

} catch (PDOException $e) {
    die();
    header($location);
}
?>