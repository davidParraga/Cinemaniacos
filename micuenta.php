<?php
session_start();
require_once 'phpfunctions/conexion.php';
$iduser = $_SESSION['iduser'];
$consulta = "SELECT*FROM  users where id=$iduser";
$result = $pdo->query($consulta);

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="chrome">
    <title>Mi Cuenta</title>
    <link rel="icon" type="icon" href="img/favicon.ico" />
    <script src="js/scriptsusuario.js"></script>
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
    <?php
    if (isset($_SESSION['iduser'])) {
        $user = $result->fetch(PDO::FETCH_ASSOC);
        $nombre = $user['name'];
        $edad = $user['edad'];
        $sexo = $user['sex'];
        $ocupacion = $user['ocupacion'];
        $foto = $user['pic'];
        ?>
        <div class = "cabecera">
        <a href="catalogo.php"><h1>CINEMANÍA</h1></a>
      </div>


<div class = container>
  <div class = item>
      <h2>Mi Perfil</h2>
      <a href="phpfunctions/cerrar_sesion.php">Cerrar sesi&oacute;n</a>
  </div>
  <div class = item>
      <h3>Foto de perfil</h3>
      <p><img src="<?php echo $foto; ?>" alt="<?php echo $nombre; ?>"></p>
      <a href="javascript:mostrarformfoto()" id="enlacecambiarfoto">Cambiar foto de perfil.</a>
      <form action="phpfunctions/cambiarfoto.php" method="POST" name="formcambiarfoto" id="formcambiarfoto" style="visibility: hidden; display: none;" enctype="multipart/form-data">
          <fieldset>
              <input type="hidden" name="nombre" value="<?php echo $nombre; ?>">
              <label for="pic">Introduzca su nueva foto: </label>
              <input type="file" name="pic" id="pic">
              <input type="submit" value="CAMBIAR">
          </fieldset>
      </form>
  </div>

  <div class = item>
      <h3>Nombre de usuario</h3>
      <p><?php echo $nombre; ?></p>
      <a href="javascript:mostrarformnombre()" id="enlacecambiarnombre">Cambiar nombre de usuario.</a>
      <form action="phpfunctions/cambiarnombre.php" method="POST" name="formcambiarnombre" id="formcambiarnombre" style="visibility: hidden; display: none;" enctype="multipart/form-data">
          <fieldset>
              <label for="nombre">Introduzca su nuevo nombre: </label>
              <input type="text" name="nombre" id="nombre">
              <input type="submit" value="CAMBIAR">
          </fieldset>
      </form>
  </div>
  <div class = item>
      <h3>Edad</h3>
      <p><?php echo $edad; ?></p>
      <a href="javascript:mostrarformedad()" id="enlacecambiaredad">Cambiar edad.</a>
      <form action="phpfunctions/cambiaredad.php" method="POST" name="formcambiaredad" id="formcambiaredad" style="visibility: hidden; display: none;" enctype="multipart/form-data">
          <fieldset>
              <label for="edad">Introduzca su nueva edad: </label>
              <input type="number" name="edad" id="edad">
              <input type="submit" value="CAMBIAR">
          </fieldset>
      </form>
  </div>

          <div class = item>
              <h3>Sexo</h3>
              <p><?php echo $sexo; ?></p>
              <a href="javascript:mostrarformsexo()" id="enlacecambiarsexo">Cambiar sexo.</a>
              <form action="phpfunctions/cambiarsexo.php" method="POST" name="formcambiarsexo" id="formcambiarsexo" style="visibility: hidden; display: none;" enctype="multipart/form-data">
                  <fieldset>
                      <label for="sexo">Sexo: </label>
                      <input type="radio" name="sexo" id="sexo" value="M" required>Hombre
                      <input type="radio" name="sexo" id="sexo" value="F" required>Mujer
                      <input type="submit" value="CAMBIAR">
                  </fieldset>
              </form>
          </div>
          <div class>
              <h1>Ocupaci&oacute;n</h1>
              <p><?php echo $ocupacion; ?></p>
              <a href="javascript:mostrarformocupacion()" id="enlacecambiarocupacion">Cambiar ocupaci&oacute;n.</a>
              <form action="phpfunctions/cambiarocupacion.php" method="POST" name="formcambiarocupacion" id="formcambiarocupacion" style="visibility: hidden; display: none;" enctype="multipart/form-data">
                  <fieldset>
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
                      <input type="submit" value="CAMBIAR">
                  </fieldset>
              </form>
          </div>

</div>





        <div class = cabecera>
            <a href="generar_recomendaciones.php">Generar recomendaciones</a>
        </div>
        <div>
            <table id='recs' class="table table-striped table-bordered"">
                <thead>
                    <tr>
                        <th>Portada</th>
                        <th>T&iacute;tulo</th>
                        <th>Calificaci&oacute;n recomendada</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $consulta2 = "SELECT id, title, url_pic, movie_id, user_id, rec_score FROM movie INNER JOIN recs WHERE movie.id = recs.movie_id AND recs.user_id =" . $_SESSION['iduser'] . " ORDER BY rec_score DESC";
                        $result2 = $pdo->query($consulta2);
                        while ($recomendaciones = $result2->fetch(PDO::FETCH_ASSOC)) {

                            ?>
                        <tr>
                            <td>
                                <img src="images/<?php echo $recomendaciones['url_pic']; ?>"></img>
                            </td>
                            <td>
                                <a href="pelicula.php?id=<?php echo $recomendaciones['id']; ?>"><?php echo $recomendaciones['title']; ?> </a>
                            </td>
                            <td>
                                <?php echo $recomendaciones['rec_score']; ?>
                            </td>
                        </tr>
                    <?php
                        }
                        ?>
                </tbody>
            </table>
        </div>
    <?php
    } else {
        ?>
        <p>No ha iniciado sesi&oacute;n</p>
        <a href="index.php">Iniciar sesi&oacute;n</a>
    <?php
    }
    ?>
    <script>
        $(document).ready(function() {
            $('#recs').DataTable();
        });
    </script>
  </div>
</body>

</html>
