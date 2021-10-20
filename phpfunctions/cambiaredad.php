<?php
session_start();
require_once 'conexion.php';

$id = $_SESSION['iduser'];
$edad=$_POST['edad'];
$location = "Location: ../micuenta.php";


try {
    $consulta = "UPDATE users SET edad=" . "'" . $edad . "'";
    $consulta .= "WHERE id=" ."'" . $id . "'";
    $pdo->query($consulta);
    header($location);

} catch (PDOException $e) {
    die();
    header($location);
}
?>