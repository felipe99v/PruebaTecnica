<?php
include 'global/config.php';
include 'global/conexion.php';
include 'carrito.php';
include 'templates/cabecera.php';
?>


 <br> 
 <?php if($mensaje!="") {?>
 <div class="alert alert-success" role="alert">
 <?php echo$mensaje?>
     <a href="mostrarcarrito.php" class="badge badge-success">ver carrito</a>
 </div>
 <?php } ?>
 <div class="row">
     <?php
    $sentencia=$pdo->prepare("SELECT * FROM tblproductos"); 
    $sentencia->execute();
    $listaProductos=$sentencia->fetchall(PDO::FETCH_ASSOC);
    //print_r($listaProductos);
     ?>
     <?php foreach($listaProductos as $producto){ ?>
        <div class="col-3">
     <div class="card">
         <img
         title="<?php echo $producto['Nombre'];?>"
         alt="<?php echo $producto['Nombre'];?>"
         src="<?php echo $producto['Imagen'];?>"
         data-toggle="popover"
         data-trigger="hover"
         data-content="<?php echo $producto['Descripcion'];?>"
         height="317px"
          class="card-img-top" src="" alt="">
         <div class="card-body">
             <span><?php echo $producto['Nombre'];?></span>
             <h5 class="card-title">$<?php echo $producto['Precio'];?></h5>
             <p class="card-text">descripcion</p>
             
             
             <form action="" method="post">
              <input type="hidden" name="id" id="id" value="<?php echo $producto['ID'];?>">
              <input type="hidden" name="nombre" id="nombre" value="<?php echo $producto['Nombre'];?>">
              <input type="hidden" name="precio" id="precio" value="<?php echo $producto['Precio'];?>">
              <input type="hidden" name="cantidad" id="cantidad" value="<?php echo 1;?>">
             <button class="btn btn-primary"
              name="btnAccion" 
              value="Agregar" 
              type="submit"
              >
                Agregar al carrito</button>

             </form> 
         </div>
     </div>
     </div>
     <?php } ?>
   
 </div>
</div>
<script>
$(function () {
  $('[data-toggle="popover"]').popover()
})
 </script>
<?php
include 'templates/pie.php';?>
