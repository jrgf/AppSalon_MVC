<h1 class="nombre-pagina">Olvide la contraseña</h1>
<p class="descripcion-pagina">Restablece tu contraseña escribiendo tu email a continuación</p>
<?php 

    include_once __DIR__.'/../templates/alertas.php';


?>
<form action="/forget" class="formulario" method="POST">
    <div class="campo">
        <label for="email">Tu email</label>
        <input type="email"  id="email" name="email" placeholder="Tu email"/>
    </div>
    <input type="submit" value="Enviar instrucciones" class="boton">
</form>
<div class="acciones">
    <a href="/">¿Ya tienes una cuenta? Inicia Sesión</a>
    <a href="/create-cuenta">¿Aun no tienes una cuenta?Crea una</a>
</div>