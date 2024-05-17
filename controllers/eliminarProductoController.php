<?php
    include('../models/ProductoDAO.php');
    $productoDAO = new ProductoDAO();
    $msg= $productoDAO->eliminarProducto($_GET['id']);
?>