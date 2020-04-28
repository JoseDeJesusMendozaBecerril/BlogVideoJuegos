<!-- POR SI NO ESTA EN SESION QUE ME REGRESE -->
<?php require_once 'includes/redireccion.php'; ?>

<!--CABECERA -->
<?php require_once 'includes/cabecera.php'; ?>

<!--BARRA LATERAL -->
<?php require_once 'includes/lateral.php'; ?>


<!-- CAJA PRINCIPAL -->
<div id="principal">
    <h1>Crear categoria</h1>
    <p>Añade nuevas categorias al blog para que los usuarios puedan usarlas al crear sus entradas</p>
    <br>
    <form action="guardar-categoria.php" method="POST">
        <label for="nombre">Nombre de la categoria</label>
        <input type="text" name="nombre">
        
        
        <input type="submit" value="Guardar">
    </form>
    
</div>


<!-- PIE -->
<?php require_once 'includes/pie.php'; ?>
