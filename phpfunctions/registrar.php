<?php
session_start();
require_once 'conexion.php';
$id = 0;
$nombre = $_POST['nombre'];
$edad = $_POST['edad'];
$sexo = $_POST['sexo'];
$ocupacion = $_POST['ocupacion'];
$form_pass = $_POST['password'];
$password = sha1($form_pass);

$consulta = "SELECT*FROM users";
$result = $pdo->query($consulta);

while ($userexistente = $result->fetch(PDO::FETCH_ASSOC)) {
    if ($id == $userexistente['id']) {
        $id++;
    }
}

$target_dir = "../img/";
$target_file = $target_dir ."user=" .$nombre ."-" . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
}

// Check file size
if ($_FILES["fileToUpload"]["size"] > 500000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}

try {
    $consulta2 = "INSERT INTO users(";
    $consulta2 .= "id, name, edad, sex, ocupacion, passwd, pic";
    $consulta2 .= ") VALUES (";
    $consulta2 .= "'" .$id ."', '" .$nombre ."', '" .$edad ."', '" .$sexo ."', '" .$ocupacion ."', '" .$password ."', '" .$target_file ."');";
    $pdo->query($consulta2);
    $_SESSION['iduser']=$id;
    $_SESSION['nombre']=$nombre;
    header("Location: ../catalogo.php");
} catch (PDOexception $e) {
    die();
    $registrofallido=true;
    setcookie("registrofallido", $registrofallido, time()+3, "/");
    header("Location: ../index.php");
}
?>