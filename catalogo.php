<?php
session_start();
require_once 'phpfunctions/conexion.php';

$result = $pdo->query("SELECT*FROM  movie");

?>
<!doctype html>

<head>
    <meta charset="UTF-8" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/styles.css">

</head>

<body>
  <div class = "principal">
  <div class = "cabecera">
    <h1>CINEMANÍACOS</h1>
    <?php
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

  <div = "pelis">
    <table id="peliculas" class="table table-striped table-bordered">
  </div>
</div>


        <thead>
            <tr>
                <th width=" 120">
                    <h3>Portada</h3>
                </th>
                <th width="30">
                    <h3>T&Iacute;TULO</h3>
                </th>
                <th width="100">
                    <h3>Fecha de estreno</h3>
                </th>
                <th width="100">
                    <h3>Descripci&oacute;n</h3>
                </th>

            </tr>
        </thead>
        <tbody>
            <?php
            while ($pelicula = $result->fetch(PDO::FETCH_ASSOC)) {

                ?>
                <tr>
                    <td>
                        <img src="images/<?php echo $pelicula['url_pic']; ?>" width="100" height="140"></img>
                    </td>
                    <td>
                        <a href="pelicula.php?id=<?php echo $pelicula['id']; ?>"><?php echo $pelicula['title']; ?> </a>
                    </td>
                    <td>
                        <?php echo $pelicula['date']; ?>
                    </td>
                    <td>
                        <?php echo $pelicula['desc']; ?>
                        <br>
                        <a href="<?php echo $pelicula['url_imdb']; ?>">M&aacute;s informaci&oacute;n en IMDB</a>
                    </td>

                </tr>
            <?php
            }
            ?>
        </tbody>
      </div>

    </table>
    <?php
    $result = null;
    $pdo = null;
    ?>
    <script>
        $(document).ready(function() {
            $('#peliculas').DataTable();
        });
    </script>
</body>

</html>
