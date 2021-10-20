<?php
session_start();
if (isset($_SESSION['iduser'])){
    header("Location: catalogo.php");
}
else{
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="chrome">
    <title>Peliculitas</title>
    <link rel="icon" type="icon" href="img/favicon.ico"/>
    <script src="js/scripts.js"></script>
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
  <div class = principal>
    <div class = cabecera>
    <a href="catalogo.php"><h1> CINEMANÍACOS</h1></a>
    </div>
    <form action="phpfunctions/consultar_login.php" method="POST" name="formlogin" id="formlogin">
        <fieldset>
            <legend>Inicie sesi&oacute;n</legend>
            <label for="nombre">Nombre: </label>
            <input type="text" name="nombre" id="nombre" placeholder="Nombre" required>
            <label for="nombre">Contraseña: </label>
            <input type="password" name="password" id="password" placeholder="Contraseña" required>
            <input type="submit" value="ENVIAR">
        </fieldset>
    </form>
    <a href="javascript:mostrarregistro()" id="enlaceregistrar">Registrarse</a>
    <?php
    if(isset($_COOKIE['fallido'])){
        ?>
        <h3>El usuario o contraseña introducidos no son correctos, pruebe de nuevo</h3>
    <?php
    }
    ?>
    <form action="phpfunctions/registrar.php" method="POST" name="formregistro" id="formregistro" style="visibility: hidden; display: none;" enctype="multipart/form-data">
        <fieldset>
            <legend>Registrarse</legend>
            <label for="nombre">Nombre: </label>
            <input type="text" name="nombre" id="nombre" placeholder="Nombre" required>
            <label for="edad">Edad: </label>
            <input type="number" name="edad" id="edad" placeholder="Edad" min="18" required>
            <label for="sexo">Sexo: </label>
            <input type="radio" name="sexo" id="sexo" value="M" required>Hombre
            <input type="radio" name="sexo" id="sexo" value="F" required>Mujer
            <label for="ocupacion">Ocupacion: </label>
            <select name="ocupacion" id="ocupacion" class="default">
                <option value="none" selected>None</option>
                <option value="administrator">Administrator</option>
                <option value="artist">Artist</option>
                <option value="doctor">Doctor</option>
                <option value="educator">Educator</option>
                <option value="engineer">Engineer</option>
                <option value="entertainment">Entertainment</option>
                <option value="executive">Executive</option>
                <option value="healtchare">Healthcare</option>
                <option value="homemaker">Homemaker</option>
                <option value="lawyer">Lawyer</option>
                <option value="librarian">Librarian</option>
                <option value="marketing">Marketing</option>
                <option value="other">Other</option>
                <option value="programmer">Programmer</option>
                <option value="retired">Retired</option>
                <option value="salesman">Salesman</option>
                <option value="sciencist">Sciencist</option>
                <option value="student">Student</option>
                <option value="technician">Technician</option>
                <option value="writer">Writer</option>
            </select>
            <label for="password">Contraseña: </label>
            <input type="password" name="password" id="password" placeholder="Contraseña" required>
            <label for="fileToUpload">Foto de perfil: </label>
            <input type="file" name="fileToUpload" id="fileToUpload">
            <input type="submit" value="ENVIAR">
        </fieldset>
    </form>
    <a href="javascript:mostrarlogin()" id="enlacelogin" style="visibility: hidden; display: none;">Si tiene cuenta, Inicie sesi&oacute;n.</a>
    <?php
    if(isset($_COOKIE['registrofallido'])){
        ?>
        <h3>El procedimiento de registro ha fallado, pruebe de nuevo</h3>
    <?php
    }
}
    ?>
  </div>
</body>
</html>
