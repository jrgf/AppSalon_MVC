<h1 class="nombre-pagina">Crear Nueva Cita</h1>
<p class="descripcion-pagina">Elige tus servicios y coloca tus datos</p>
<?php include __DIR__.'../../templates/barra.php' ?>
<div class="app">
    <nav class="tabs">
        <button type="button" data-paso="1" > Servicios </button>
        <button type="button" data-paso="2" > Información Cita </button>
        <button type="button" data-paso="3" > Resumen </button>

    </nav>
    <div class="seccion" id="paso-1">
            <h2>Servicios</h2>
            <p class="text-center">Elige tus servicios a continuación</p>
            <div id="servicios" class="listado-servicios"></div>
    </div>
    <div class="seccion" id="paso-2">
            <h2>Tus datos y cita</h2>
            <p class="text-center">Coloca tus datos y fecha de tu cita</p>
            <form class="formulario">
                <div class="campo">
                    <label for="nombre">Nombre</label>
                    <input type="text" 
                    name="nombre" 
                    id="nombre" 
                    placeholder="Tu nombre" 
                    value="<?php echo $nombre;?>"
                    disabled>
                    
                </div>
                <div class="campo">
                    <label for="fecha">Fecha</label>
                    <input type="date" name="fecha" id="fecha" placeholder="Tu fecha" min="<?php echo date('Y-m-d');?>" >
                </div>
                <div class="campo">
                    <label for="hora">Hora</label>
                    <input type="time" name="hora" id="hora" placeholder="Tu hora">
                </div>
                <input type="hidden" name="id" id="id" value="<?php echo $id; ?>">
                
            </form>
    </div>
    <div class="seccion contenido-resumen" id="paso-3">
        <h2>Resumen</h2>
        <p class="text-center
        ">Verifica que tus datos sean correctos</p>
    </div>
    <div class="paginacion">
        <button id="anterior" class="boton">
            &laquo; Anterior
        </button>
        
        <button id="siguiente" class="boton">
            &raquo; Siguiente
        </button>
    </div>
</div>

<?php 
$script = "<script src='//cdn.jsdelivr.net/npm/sweetalert2@11'></script>
            <script src='build/js/app.js'></script>"
?>