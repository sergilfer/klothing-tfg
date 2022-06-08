<?php
require 'includes/app.php';
$db = conectarDB();
$campos_vacios = [];


if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $email = mysqli_real_escape_string($db, filter_var($_POST['email'], FILTER_VALIDATE_EMAIL));
    $password = mysqli_real_escape_string($db, $_POST['password']);

    if (!$email) {
        $campos_vacios[] = "Debe añadir un email para registrarse";
    }

    if (!$password) {
        $campos_vacios[] = "Debe añadir un password para registrarse";
    }

    if (empty($campos_vacios)) {
        //Comprueba si existe el usuario en la db

        $query = "SELECT * FROM usuarios WHERE Email = '${email}'";
        $resultado = realizarConsulta($db, $query);

        //si hay resultados en num_rows el codigo existe
        if ($resultado->num_rows) {
            //Revisar el password
            $usuario = mysqli_fetch_assoc($resultado);
            $autenticado = password_verify($password, $usuario['password']);
            if($autenticado){
                session_start();
                $_SESSION['usuario'] = $usuario['email'];
                $_SESSION['logueado'] = true;
                	
                header('Location: /klothing-tfg/admin');
            }else{
                $campos_vacios[] = "La contraseña introducida no es correcta";
            }
        } else {
            $campos_vacios[] = "El usuario no existe";
        }
    }
}


incluirTemplates('header');
?>

<main class="contenedor seccion contenido-centrado">
    <h1>Iniciar Sesion</h1>
    <?php foreach ($campos_vacios as $errores) : ?>
        <div class="alerta error">
            <?php echo $errores; ?>
        </div>
    <?php endforeach; ?>
    <form class="formulario" method="POST">
        <fieldset>
            <legend>Email y Password</legend>

            <label for="email">E-mail</label>
            <input type="email" name="email" placeholder="Introduce el email" id="email">

            <label for="password">Password</label>
            <input type="password" name="password" placeholder="Introduce el telefono" id="password">

            <input type="submit" value="Iniciar Sesion" class="boton boton-verde">

        </fieldset>
    </form>
</main>
<?php incluirTemplates('footer'); ?>