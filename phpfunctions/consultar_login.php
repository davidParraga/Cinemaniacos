<?php
session_start();
require_once 'conexion.php';

$nombre=$_POST['nombre'];
$form_pass=$_POST['password'];
$password = sha1($form_pass);
$name="name";

$consulta="SELECT*FROM users WHERE ";
$consulta.= "name = '" .$nombre ."'AND passwd = '" .$password ."'";
try{
    $result=$pdo->query($consulta);
    $user=$result->fetch(PDO::FETCH_ASSOC);
    if ($user['id']==null){
        $fallido=true;
        setcookie('fallido', $fallido, time()+3, "/");
        header("Location: ../index.php");
    }
    else{
        $_SESSION['iduser']=$user['id'];
        $_SESSION['nombre']=$nombre;
        header("Location: ../catalogo.php");
    }
}
catch(PDOException $e){
    $fallido=true;
    setcookie("fallido", $fallido, time()+3, "/");
    header("Location: ../index.php");
}

?>