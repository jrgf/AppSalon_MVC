<h1 class="nombre-pagina">Recuperar Contraseña</h1>
<p class="descripcion-pagina">Coloca tu nuevo password a continuación</p>
<?php 

    include_once __DIR__.'/../templates/alertas.php';


?>
<?php if($error) return; ?>
<form class="formulario" method="POST">
    <div class="campo">
        <label for="password">Password</label>
        <input 
        type="password"
        id="password"
        name="password"
        placeholder="Tu Nuevo Password" />
    </div>
    <input type="submit" value="Crear Nuevo Password" class="boton">

</form>
<div class="acciones">
    
    <a href="/">¿Ya tienes una cuenta? Inicia Sesión</a>
    <a href="/create-cuenta">¿Aun no tienes una cuenta?Crea una</a>
</div>