<?php
    include('../models/ProductoDAO.php');
    $productoDAO = new ProductosDAO();
    $producto = $productoDAO->TraerProducto();
    print_r(json_encode($producto));
?>