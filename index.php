<?php
include 'funciones.php';

$error = false;
$config = include 'config.php';

try {
  $dsn = 'mysql:host=' . $config['db']['host'] . ';dbname=' . $config['db']['name'];
  $conexion = new PDO($dsn, $config['db']['user'], $config['db']['pass'], $config['db']['options']);

  // formulario donde enviara el apellido del alumno que introduzcamos en la casilla de busqueda
  if (isset($_POST['apellido'])) {
    $consultaSQL = "SELECT * FROM alumnos WHERE apellido LIKE '%" . $_POST['apellido'] . "%'";
  } else {
    $consultaSQL = "SELECT * FROM alumnos";
  }

  // consulta MySQL que usaremos para obtener la lista de alumnos.
  $consultaSQL = "SELECT * FROM alumnos";

  $sentencia = $conexion->prepare($consultaSQL);
  $sentencia->execute();

  $alumnos = $sentencia->fetchAll();

  // Código que obtendrá la lista de alumnos

} catch(PDOException $error) {
  $error = $error->getMessage();
}

// modificamos el titulo del formulario que nos indique el apellido que estamos buscando
$titulo = isset($_POST['apellido']) ? 'Lista de alumnos (' . $_POST['apellido'] . ')' : 'Lista de alumnos';

?>

<?php include "templates/header.php"; ?>
<!-- aqui va el codigo de la aplicacion -->

<?php
if ($error) {
  ?>
  <div class="container mt-2">
    <div class="row">
      <div class="col-md-12">
        <div class="alert alert-danger" role="alert">
          <?= $error ?>
        </div>
      </div>
    </div>
  </div>
  <?php
}
?>

<!-- codigo del boton para crear un alumno en la base de datos -->
<div class="container">
  <div class="row">
    <div class="col-md-12">
      <a href="crear.php" class="btn btn-primary mt-4">Crear alumno</a>
      <hr>
    <!-- boton de busqueda que nos permite buscar usuarios por apellido -->
      <form method="post" class="form-inline">
        <div class="form-group mr-3">
          <input type="text" id="apellido" name="apellido" placeholder="Buscar por apellido" class="form-control">
        </div>
        <button type="submit" name="submit" class="btn btn-primary">Ver Resultados</button>
      </form>
    </div>
  </div>
</div>

<!-- Lista de los alumnos registrados -->
<div class="container">
  <div class="row">
    <div class="col-md-12">
      <h2 class="mt-3">Lista de alumnos</h2>
      <table class="table">
        <thead>
          <tr>
            <th>#</th>
            <th>Nombre</th>
            <th>Apellido</th>
            <th>Email</th>
            <th>Edad</th>
          </tr>
        </thead>
        <tbody>
          <?php
          if ($alumnos && $sentencia->rowCount() > 0) {
            foreach ($alumnos as $fila) {
              ?>
              <tr>
                <td><?php echo escapar($fila["id"]); ?></td>
                <td><?php echo escapar($fila["nombre"]); ?></td>
                <td><?php echo escapar($fila["apellido"]); ?></td>
                <td><?php echo escapar($fila["email"]); ?></td>
                <td><?php echo escapar($fila["edad"]); ?></td>
              </tr>
              <?php
            }
          }
          ?>
        <tbody>
      </table>
    </div>
  </div>
</div>

<?php include "templates/footer.php"; ?>
