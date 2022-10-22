<div class="campo">
    <label for="nombre" > Nombre</label>
    <input 
        type="text" 
        id="nombre"
        name="nombre"
        placeholder="Nombre Servicio"
        value="<?php echo $servicio->nombre;  ?>"
    />
    
    
</div>
<div class="campo">
    <label for="precio" > Precio </label>
    <input 
        type="number" 
        id="precio"
        name="precio"
        placeholder="Precio Servicio"
        min="0"
        value="<?php echo $servicio->precio; ?>"
        oninput="this.value = 
        !!this.value && Math.abs(this.value) >= 0 ? Math.abs(this.value) : null"
    
    />
    
</div>