<!-- POR SI NO ESTA EN SESION QUE ME REGRESE -->
<?php require_once 'includes/redireccion.php'; ?>

<!--CABECERA -->
<?php require_once 'includes/cabecera.php'; ?>

<!--BARRA LATERAL -->
<?php require_once 'includes/lateral.php'; ?>


<!-- CAJA PRINCIPAL -->
<div id="principal">
    <h1>Crear entradas</h1>
    <p>Añade nuevas Entradas al blog para que los usuarios puedan disfrutar de nuestro contenido</p>
    <br>
    <form action="guardar-entrada.php" method="POST">
        <label for="titulo">Titulo</label>
        <input type="text" name="titulo">
        <?php echo isset($_SESSION['errores_entrada']) ? mostrarError($_SESSION['errores_entrada'],'titulo') : ''?>
        
        <label for="descripcion">Descripcion</label>
        <textarea name="descripcion"></textarea>
        <?php echo isset($_SESSION['errores_entrada']) ? mostrarError($_SESSION['errores_entrada'],'descripcion') : ''?>
        
        <label for="categoria">Categoria</label>
        <select name="categoria">
            <?php 
                    $categorias = conseguirCategorias($db);
                    if(!empty($categorias)):
                        while($categoria = mysqli_fetch_assoc($categorias)):
            ?>
                <option value="<?= $categoria['id'] ?>">
                    <?= $categoria['nombre']; ?>
                </option>
            
            <?php
                        endwhile;
                    endif;
            ?>
            
            
        </select>
        <?php echo isset($_SESSION['errores_entrada']) ? mostrarError($_SESSION['errores_entrada'],'categoria') : ''?>
        
        
        
        <input type="submit" value="Guardar">
    </form>
    <?= borrarErrores(); ?>
    
</div>


<!-- PIE -->
<?php require_once 'includes/pie.php'; ?>
