<?php
include 'global/config.php';
include 'global/conexion.php';
include 'carrito.php';
include 'templates/cabecera.php';
?>



<?php
if($_POST){
 $total=0;
 $SID=session_id();
 $Correo=$_POST['email'];

    foreach ($_SESSION['CARRITO'] as $indice=>$producto){
     $total=$total+($producto['PRECIO']*$producto['CANTIDAD']);
    }

    $sentencia=$pdo->prepare("INSERT INTO `tblVentas` (`ID`, `ClaveTransaccion`, `Datos`, `Fecha`, `Correo`, `Total`, `Status`) 
    VALUES (NULL, :ClaveTransaccion, '', NOW(), :Correo, :Total, 'pendiente');");
    
    $sentencia->bindParam(":ClaveTransaccion",$SID);
    $sentencia->bindParam(":Correo",$Correo);
    $sentencia->bindParam(":Total",$total);
    $sentencia->execute();

    $idVenta=$pdo->LastInsertID();

    foreach ($_SESSION['CARRITO'] as $indice=>$producto){
        $sentencia=$pdo->prepare("INSERT INTO `tbldetalleventa` (`ID`, `IDVENTA`, `IDPRODUCTO`, `PRECIOUNITARIO`, `CANTIDAD`, `DESCARGADO`)
        VALUES (NULL,:IDVENTA,:IDPRODUCTO,:PRECIOUNITARIO,:CANTIDAD,'0');");

    $sentencia->bindParam(":IDVENTA",$idVenta);
    $sentencia->bindParam(":IDPRODUCTO",$producto['ID']);
    $sentencia->bindParam(":PRECIOUNITARIO",$producto['PRECIO']);
    $sentencia->bindParam(":CANTIDAD",$producto['CANTIDAD']);
    $sentencia->execute();

   
}


    //echo "<h3>".$total."</h3>";
}
?>

<div class="jumbotron text-center">
    <h1 class="display-4">¡Paso final!</h1>
    <hr class="my-4">
    <p class="lead">Estas a punto de pagar la cantidad de:
    <h4><?php echo number_format($total,2); ?>  </h4>
    </p>
    
    <p>Los productos podran ser adquiridos una vez se realice el pago<br/>
 <Strong>(para aclaraciones :felipe99varela1@gmail.com)  </Strong>        
</p>
</div>


<?php
include 'templates/pie.php';?>