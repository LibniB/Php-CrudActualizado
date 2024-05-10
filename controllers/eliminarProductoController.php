<?php
include('../models/ProductoDAO.php');

$clase= new ProductosDAO();
$msg=$clase->eliminarProducto($_GET['id']);
?>