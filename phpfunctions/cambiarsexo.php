<?php
session_start();
require_once 'conexion.php';

$id = $_SESSION['iduser'];
$sexo=$_POST['sex'];
$location = "Location: ../micuenta.php";


try {
    $consulta = "UPDATE users SET sex=" . "'" . $sexo . "'";
    $consulta .= "WHERE id=" ."'" . $id . "'";
    $pdo->query($consulta);
    header($location);

} catch (PDOException $e) {
    die();
    header($location);
}
?>