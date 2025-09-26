<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Formulario de alumnado</title>
  <link rel="stylesheet" href="formulario_alumnado.css">
</head>
<body>
  <div class="cuerpo">
    <h1>Registro de alumnado</h1>
    
    <form action="datos_alumnado.php" method="POST">
      <label>Nombre:</label>
      <input type="text" id="nombre" name="nombre" required>
      <br><br>
      
      <label>Apellidos:</label>
      <input type="text" id="apellidos" name="apellidos" required>
      <br><br>
      
      <label>Fecha de nacimiento:</label>
      <input type="date" id="fecha_nacimiento" name="fecha_nacimiento" required>
      <br><br>
      
      <label>Curso:</label>
      <select id="curso" name="curso" required>
        <option value="">-- Selecciona un curso --</option>
        <option value="1º ESO">1º ESO</option>
        <option value="2º ESO">2º ESO</option>
        <option value="3º ESO">3º ESO</option>
        <option value="4º ESO">4º ESO</option>
      </select>
      <br><br>
      
      <label>Email de Educamos:</label>
      <input type="email" id="email" name="email" required>
      <br><br>
      
      <label>Contraseña de Educamos:</label>
      <input type="password" id="password" name="password" required>
      <br><br>
      
      <button type="submit">Envíar</button>
      <br>
      <br>
    </form>
</body>
</html>

<?php
#Conexión
$conexion= mysqli_connect("localhost","root","","datos_alumnado") 
or die("Problemas con la conexión");

$query="SELECT id, nombre, apellidos, contrasena, curso, email_educamos, fecha_nacimiento FROM alumnos ORDER BY curso, apellidos";

$resultado=mysqli_query($conexion, $query);
?>

<html>
    <div class="tabla">
      <table>
        <tr>
          <th>ID DEL USUARIO</th>
          <th>NOMBRE</th>
          <th>APELLIDOS</th>
          <th>CURSO</th>
          <th>EMAIL DE EDUCAMOS</th>
        </tr>
        <?php
        #Para recorrer los campos
        while ($fila=mysqli_fetch_assoc($resultado)) {
            echo "<tr>";
              echo "<td>".$fila['id']."</td>";
              echo "<td>".$fila['nombre']."</td>";
              echo "<td>".$fila['apellidos']."</td>";
              echo "<td>".$fila['curso']."</td>";
              echo "<td>".$fila['email_educamos']."</td>";
            echo "</tr>";
        }
        ?>
      </table>
    </div>
  </div>

</html>
