<?php
include('../models/ProductoDAO.php');
$clase= new ProductosDAO();
if($_REQUEST['id']==''){
    $clase->guardarProducto($_REQUEST['nombre'],$_REQUEST['descripcion']);
}else{
    $clase->actualizarProducto($_REQUEST['nombre'],$_REQUEST['descripcion']);
}

$msg=$clase->eliminarProducto($_GET['id']);
?>