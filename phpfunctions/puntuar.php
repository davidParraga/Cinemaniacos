<?php
session_start();
require_once 'conexion.php';

$idmovie = $_POST['idmovie'];
$iduser = $_SESSION['iduser'];
$score = $_POST['estrellas'];
$time = date("Y-m-d H:i:s", time());
$location = "Location: ../pelicula.php?id=" . $idmovie;

try {
    $consulta2 = "SELECT*FROM user_score WHERE id_user=" . "'" . $iduser . "'" . " AND id_movie =" . "'" . $idmovie . "'";
    $result2 = $pdo->query($consulta2);
    $puntuaciones = $result2->fetch(PDO::FETCH_ASSOC);
    $punt_user = $puntuaciones['score'];
    echo $punt_user;
    if ($punt_user != null) {
        $consulta3 = "UPDATE user_score SET score=" . "'" . $score . "'";
        $consulta3 .= "WHERE id_user=" . "'" . $iduser . "'" . " AND id_movie =" . "'" . $idmovie . "'";
        $pdo->query($consulta3);
        header($location);
    } else {
        $consulta = "INSERT INTO user_score(";
        $consulta .= "id_user, id_movie, score, time";
        $consulta .= ") VALUES (";
        $consulta .= "'" . $iduser . "', '" . $idmovie . "', '" . $score . "', '" . $time . "');";
        $pdo->query($consulta);
        header($location);
    }
} catch (PDOException $e) {
    die();
    header($location);
}
?>