<?php
    #Conexion
    $conexion= mysqli_connect("localhost","root","","datos_alumnado") 
    or die("Problemas con la conexión");

    #Todos los datos que quiero insertar
    $nombre=$_POST["nombre"];
    $apellidos=$_POST["apellidos"];
    $fecha_nacimiento=$_POST["fecha_nacimiento"];
    $curso=$_POST["curso"];
    $email=$_POST["email"];
    $contrasena=$_POST["password"];

    #Si los datos estan vacíos
    if (empty($nombre) || empty($apellidos) || empty($curso) || empty($email) || empty($contrasena)) {
    die("<h1>Faltan datos obligatorios</h2>
        <form action='formulario_alumnado.php' method='get'>
            <button type='submit'>Volver</button>
        </form>");
    }

    #Contar alumnos en el curso seleccionado
    $consulta_curso="SELECT count(*) AS total FROM alumnos WHERE curso='$curso'";
    $resultado=mysqli_query($conexion, $consulta_curso); #Ejecuta la consulta
    $fila=mysqli_fetch_assoc($resultado); #Convierte el resultado de la consulta en un array

    #Ahora podemos acceder al array
    if ($fila['total']>=25) {
        #Ya hay 25 o más alumnos
        die("<h1>El curso $curso ya tiene el máximo de 25 alumnos</h2>
            <form action='formulario_alumnado.php' method='get'>
                <button type='submit'>Volver</button>
            </form>");
    }

    #Insert
    $query="INSERT INTO alumnos(nombre, apellidos, contrasena, curso, email_educamos, fecha_nacimiento) values('$nombre','$apellidos','$contrasena','$curso','$email','$fecha_nacimiento')";

    #Control de errores
    try{
        mysqli_query($conexion,$query);
        #Si se realiza sin errores
        echo "<h1>Registro realizado con éxito</h2>
            <form action='formulario_alumnado.php' method='get'>
                <button type='submit'>OK</button>
            </form>";
    } catch(mysqli_sql_exception){
        #Si el correo ya estaba registrado(codigo 1062)
        if (mysqli_errno($conexion)==1062) {
            echo "<h1>El correo ya está registrado, usa otro.</h2>
                <form action='formulario_alumnado.php' method='get'>
                    <button type='submit'>Volver</button>
                </form>";
        #Si hay algun otro error
        } else {
            echo "<h1>Error al registrar: " . mysqli_error($conexion) . "</h2>
                <form action='formulario_alumnado.php' method='get'>
                    <button type='submit'>Volver</button>
                </form>";
        }
    }

    #Al final
    mysqli_close($conexion);
?>
