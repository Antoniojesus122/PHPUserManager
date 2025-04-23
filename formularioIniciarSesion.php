<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" author="Antonio Jesus">
    <title>Red Social - Registrar</title>
    <style>
        :root {
            --primary-color: #4361ee;
            --secondary-color: #3f37c9;
            --light-color: #f8f9fa;
            --dark-color: #212529;
            --success-color: #4cc9f0;
            --border-radius: 8px;
        }
        
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        body {
            background-color: #f5f5f5;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 20px;
        }
        
        .form-container {
            background-color: white;
            border-radius: var(--border-radius);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            padding: 40px;
            width: 100%;
            max-width: 500px;
        }
        
        h1 {
            color: var(--primary-color);
            text-align: center;
            margin-bottom: 30px;
            font-size: 28px;
        }
        
        .form-group {
            margin-bottom: 20px;
        }
        
        label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            color: var(--dark-color);
        }
        
        input {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid #ddd;
            border-radius: var(--border-radius);
            font-size: 16px;
            transition: all 0.3s ease;
        }
        
        input:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(67, 97, 238, 0.2);
        }
        
        .iniciar {
            background-color: var(--primary-color);
            color: white;
            border: none;
            border-radius: var(--border-radius);
            padding: 14px 20px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            width: 50%;
            transition: background-color 0.3s ease;
        }
        
        .iniciar:hover {
            background-color: var(--secondary-color);
        }
        
        .limpiar {
            background-color: white;
            color: var(--primary-color);
            border: solid var(--primary-color);
            border-radius: var(--border-radius);
            padding: 14px 20px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            width: 50%;
            transition: background-color 0.3s ease;
        }

        .limpiar:hover {
            background-color:rgba(67, 98, 238, 0.16);
        }

        .botones {
            display: flex;
            justify-content: space-between;
            column-gap: 10px;
        }

        .error {
            color: red;
        }

        .correcto {
            color: green;
        }

        .registrarlink{
           text-decoration: none;
           color: var(--primary-color);
           font-size: 16px;
           font-weight: 600;
           }

        

    </style>
</head>
<body>

<?php 
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "registros";
        
        // Crear conexión con la base de datos
        $conn = new mysqli($servername, $username, $password, $dbname);
        
        // Comprobar conexión
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Creamos las variables que contendrán los datos recogidos de cada usuario en el formulario.
        $NombreUsuario = $_POST['usuario'];
        $contraseña = $_POST['contraseña'];

        // Ahora creamos las variables que almacenarán las consultas que comprobarán los datos del usuario.
        $consultarContraseña = "SELECT * FROM usuarios WHERE email = '$contraseña'";
            $resultadoContraseña = mysqli_query($conn, $consultarContraseña);

        $consultarUsuario = "SELECT * FROM usuarios WHERE Nombreusuario = '$NombreUsuario'";
            $resultadoUsuario = mysqli_query($conn, $consultarUsuario);


        // Ahora hacemos el codigo para comprobar los resultados.

            if (mysqli_num_rows($resultadoUsuario) == 0 && mysqli_num_rows($resultadoContraseña) == 0) {
            $error = "El usuario o la contraseña no son correctos";
            }  
        
        $conn->close();
    }
    ?>

    <div class="form-container">
        <h1>Iniciar Sesión</h1>
        <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
            
            <div class="form-group">
                <label for="NombreUsuario">Usuario:</label>
                <input type="text" id="usuario" name="usuario" required>
                <div class="error"><?= $error['usuario'] ?? '' ?></div>
            </div>
            
            <div class="form-group">
                <label for="contraseña">Contraseña:</label>
                <input type="password" id="contraseña" name="contraseña" required>
            </div>

            <div class="error"> <?php echo $error ?? ''; ?></div>
            <br>
            <a href="registrar.php" class="registrarlink">¿No tienes cuenta? Registrese acá</a>
            <br>
            <br>
            <div class="botones">
            <button type="submit" class="iniciar">Iniciar Sesión</button>  
            <button type="reset" class="limpiar">Limpiar</button>
            </div>
        </form>
    </div>
</body>
</html>