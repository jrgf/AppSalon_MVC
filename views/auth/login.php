<h1 class="nombre-pagina">Login</h1>
<p class="descripcion-pagina">Introduzca sus datos para autenticarse</p>
<?php 

    include_once __DIR__.'/../templates/alertas.php';


?>
<form action="/" class="formulario" method="POST">
    <div class="campo">
        <label for="email">Email</label>
        <input type="email" placeholder="Tu email" id="email" name="email" value="<?php echo s($auth->email) ?>">
    </div>
    <div class="campo">
        <label for="password">Contraseña</label>
        <input type="password" placeholder="Tu password" id="password" name="password">
    </div>
    <input type="submit" class="boton" value="Iniciar Sesión">

    
</form>
<div class="acciones">
    <a href="/create-cuenta">¿Aun no tienes una cuenta?Crea una</a>
    <a href="/forget">Olvide mi contraseña</a>
</div>