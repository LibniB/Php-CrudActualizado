<?php
    include('../models/ProductoDAO.php');
    $productoDAO = new ProductoDAO();
    $producto = $productoDAO->traerProducto();
    print_r(json_encode($producto));
?>