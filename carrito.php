
<?php
session_start();
$mensaje="";

if(isset($_POST['btnAccion'])) {
    switch($_POST['btnAccion']){
     case 'Agregar':
     if(is_numeric($_POST['id'])){
        $ID= ($_POST['id']);
        $mensaje.="ok id correcto  ".$ID; 
     }else {
        $mensaje.="ok id incorrecto".$ID; 
     }
     if(is_string($_POST['nombre'])){
        $NOMBRE= ($_POST['nombre']);
        $mensaje.="ok nombre correcto  ".$NOMBRE; 
     }else {
        $mensaje.="ok id incorrecto".$NOMBRE; break;
     }
     if(is_numeric($_POST['cantidad'])){
        $CANTIDAD= ($_POST['cantidad']);
        $mensaje.="ok cantidad correcto  ".$CANTIDAD; 
     }else {
        $mensaje.="ok cantidad incorrecto".$CANTIDAD; break;
     }
     if(is_numeric($_POST['precio'])){
        $PRECIO= ($_POST['precio']);
        $mensaje.="ok precio correcto  ".$PRECIO; 
     }else {
        $mensaje.="ok precio incorrecto".$PRECIO; break;
     }
    /* if(is_string($_POST['nombre'])){
        $NOMBRE= ($_POST['nombre']);
        $mensaje.="ok nombre".$NOMBRE;
    }else { $mensaje.="nombre incorrecto";break;}

    if(is_numeric($_POST['cantidad'])){
        $CANTIDAD= ($_POST['cantidad']);
    }else { $mensaje.="cantidad incorrecto"."<br/>";break;}
    
    if(is_numeric($_POST['precio'])){
        $PRECIO= ($_POST['precio']);
    }else { $mensaje.="precio incorrecto"."<br/>";break;}*/


   if(!isset($_SESSION['CARRITO'])){

        $producto=array(
       'ID'=>$ID,
       'NOMBRE'=>$NOMBRE,
       'CANTIDAD'=>$CANTIDAD,
       'PRECIO'=>$PRECIO
        );
        $_SESSION['CARRITO'][0]=$producto;
        $mensaje= "producto agregado al carrito";
    }else{

      $idProductos=array_column($_SESSION['CARRITO'],"ID");
      if(in_array($ID,$idProductos)){
         echo "<script>alert('el producto ya ha sido seleccionado');</script>";
         $mensaje="";
      }else {

        $NumeroProductos=count($_SESSION['CARRITO']);
        $producto=array(
            'ID'=>$ID,
          'NOMBRE'=>$NOMBRE,
            'CANTIDAD'=>$CANTIDAD,
            'PRECIO'=>$PRECIO
             );
             $_SESSION['CARRITO'][$NumeroProductos]=$producto; 
             $mensaje= "producto agregado al carrito";
    }
   }
   // $mensaje=print_r($_SESSION,true);
   
    break;
    case "Eliminar":
    if(is_numeric($_POST['id'])){
      $ID= ($_POST['id']);
    
      foreach ($_SESSION['CARRITO'] as $indice=>$producto){
         if($producto['ID']==$ID){
            unset($_SESSION['CARRITO'][$indice]);
            echo "<script>alert('elemento borrado');</script>";
         }

      }

   }else {
      $mensaje.="ok id incorrecto".$ID; 
   }
    break;
    }
}
?>

