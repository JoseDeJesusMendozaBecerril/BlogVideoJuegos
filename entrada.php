<?php require_once 'includes/conexion.php'; ?>
<?php require_once 'includes/helpers.php'; ?>
<?php 

    $entrada_actual = conseguirEntrada($db, $_GET['id']);
    //var_dump($entrada_actual);
    
    if(!isset($entrada_actual)){
        header("Location: index.php");
    }
?>
<?php require_once 'includes/cabecera.php'; ?>
<!--BARRA LATERAL -->
<?php require_once 'includes/lateral.php'; ?>

            
            <!-- CAJA PRINCIPAL -->
            <div id="principal">
                    <h1><?= $entrada_actual['titulo']?></h1>

                    <a href="categoria.php?id=<?= $entrada_actual['id_categoria']?>">
                        <h2><?= $entrada_actual['categoria'] ?> </h2>
                    </a>   
                    
                    <h4><?= $entrada_actual['fecha'] ?> |  <?=$entrada_actual['usuario'] ?></h4>
                
                    <p>
                        <?= $entrada_actual['descripcion']  ?>
                    </p>
                    
                    <?php if(isset($_SESSION['usuario']) && $_SESSION['usuario']['id'] == $entrada_actual['usuario_id']): ?>
                        <a href="editar-entrada.php?id=<?=$entrada_actual['id']?>" class="boton boton-verde">Editar Entrada</a>
                        <a href="borrar-entrada.php?id=<?=$entrada_actual['id']?>" class="boton">Borrar Entrada</a>
                    <?php endif; ?>
            </div> <!-- FIN PRINCIPAL -->
            
            
<!-- PIE DE PAGINA -->
<?php require_once 'includes/pie.php'; ?>


