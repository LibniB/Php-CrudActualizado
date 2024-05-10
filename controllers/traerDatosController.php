<?php
include ('../models/ProductoDAO.php');

$productoDAO = new ProductosDAO();
$producto = $productoDAO->traerDatos($_GET['id']);
print_r(json_encode($producto));

?>