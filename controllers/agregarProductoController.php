<?php
    include('../models/ProductoDAO.php');
    $productoDAO = new ProductoDAO();
    $msg = $productoDAO-> agregarProducto($_GET['id'],$_GET['nombre'],$_GET['descripcion']);
?>
