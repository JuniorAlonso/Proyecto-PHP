<?php
$error = isset($_GET['error']) ? 1 : 0;
?>


<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Colegio Hijos de Dios</title>
    <link rel="stylesheet" href="CSS/estilos2.css">
</head>

<body>
    <section class="izquierda">
        <div class="info">
            <img src="IMG/Image_fx-removebg-preview.webp" alt="Logo Colegio Hijos de Dios" class="logo">
            <h1>COLEGIO <span class="titulo">HIJOS DE DIOS</span></h1>
        </div>
    </section>

    <section class="derecha">
        <main class="login-container">
            <form class="card" action="login.php" method="post">
                <h1>Iniciar sesión</h1>


                <?php if ($error == 1): ?>
                    <div class="alerta">Correo o contraseña incorrectos</div>
                <?php endif; ?>

                
                <label for="Usuario">Usuario o Correo</label>
                <input id="Usuario" name="usuario" type="text" required autofocus>

                <label for="Contrasena">Contraseña</label>
                <input id="Contrasena" name="contrasena" type="password" required>

                <button type="submit">Iniciar Sesión</button>
            </form>
        </main>
    </section>
</body>

</html>