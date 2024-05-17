<?php
    include('../models/ProductoDAO.php');
    $productoDAO = new ProductoDAO();
    $producto = $productoDAO->traerDatos($_GET['id']);
    print_r(json_encode($producto));
?>