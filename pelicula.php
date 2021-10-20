<?php
session_start();
require_once 'phpfunctions/conexion.php';
$id = $_GET['id'];
$consulta = "SELECT*FROM  movie where id=$id";
$consulta2 = "SELECT*FROM  moviecomments where movie_id=$id";
$result = $pdo->query($consulta);
$result2 = $pdo->query($consulta2);
?>
<!doctype html>

<head>
    <meta charset="UTF-8" />
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/styles.css">

</head>

<body>
  <div class = principal>
    <div class = cabecera>
    <a href="catalogo.php"><h1> CINEMANÍACOS</h1></a>
    <?php
    $pelicula = $result->fetch(PDO::FETCH_ASSOC);
    $titulo = $pelicula['title'];
    $portada = $pelicula['url_pic'];
    $desc = $pelicula['desc'];
    if (isset($_SESSION['iduser'])) {
        ?>
        <a href="micuenta.php">Mi cuenta</a>
        <a href="phpfunctions/cerrar_sesion.php">Cerrar sesi&oacute;n</a>
    <?php
    } else {
        ?>
        <a href="index.php">Iniciar sesi&oacute;n</a>
    <?php
    }
    ?>
  </div>

<div class = abajo>
<ul>
    <div>
        <h2><?php echo $titulo ?></h2>
    </div>
    <div>
        <img src="images/<?php echo $portada ?>" alt="<?php echo $titulo ?>"></img>
    </div>
    <div>
        <?php echo $desc ?>
    </div>
    <div>
        <table id="peliculas" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>COMENTARIOS</th>
                </tr>
                <tr>
                    <th width=" 200">
                        <h3>Usuario</h1>
                    </th>
                    <th width="200">
                        <h3>Comentario</h1>
                    </th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($comentario = $result2->fetch(PDO::FETCH_ASSOC)) {
                    $commentuser_id = $comentario['user_id'];
                    $consulta3 = "SELECT*FROM  users where id=$commentuser_id";
                    $result3 = $pdo->query($consulta3);
                    $commentuser = $result3->fetch(PDO::FETCH_ASSOC);

                    ?>
                    <tr>
                        <td> <?php echo $commentuser['name']; ?></td>
                        <td> <?php echo $comentario['comment']; ?></td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </div>
    </div>
    <?php
    if (isset($_SESSION['iduser'])) {
        ?>
        <form class="formpuntuacion" action="phpfunctions/puntuar.php" method="POST">
            <p class="clasificacion">
                <input type="hidden" name="idmovie" id="idmovie" value="<?php echo $id ?>">
                <input id="radio1" type="radio" name="estrellas" value="5">
                <label for="radio1">★</label>
                <input id="radio2" type="radio" name="estrellas" value="4">
                <label for="radio2">★</label>
                <input id="radio3" type="radio" name="estrellas" value="3">
                <label for="radio3">★</label>
                <input id="radio4" type="radio" name="estrellas" value="2">
                <label for="radio4">★</label>
                <input id="radio5" type="radio" name="estrellas" value="1">
                <label for="radio5">★</label>
            </p>
            <input type="submit" value="Puntuar" name="Puntuar">
        </form>
        <?php
            $iduser = $_SESSION['iduser'];
            $consulta4 = "SELECT*FROM user_score WHERE id_user=" ."'" .$iduser ."'" ." AND id_movie =" ."'" .$id ."'";
            $result4 = $pdo->query($consulta4);
            try {
                $puntuaciones = $result4->fetch(PDO::FETCH_ASSOC);
                $punt_user = $puntuaciones['score'];
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
            if ($punt_user != null) {
                ?>
            <h4>Usted ha puntuado esta pel&iacute;cula con: <?php echo $punt_user ?> estrellas</h4>
        <?php
            }
            ?>

        <form action="phpfunctions/comentar.php" method="POST" name="form">
            <fieldset>
                <legend>Suba un comentario</legend>
                <input type="hidden" name="idmovie" id="idmovie" value="<?php echo $id ?>">
                <label for="comentario">Comentario: </label>
                <textarea name="comentario" id="comentario" cols="30" rows="10" placeholder="Comentario" required></textarea>
                <input type="submit" value="ENVIAR">
            </fieldset>
        </form>
    <?php
    }
    ?>
    <?php
    $result = null;
    $pdo = null;
    ?>
    </div>
</body>

</html>
