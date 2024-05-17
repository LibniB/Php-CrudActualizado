<?php
    require('../conexiones/conexion.php');
    class productoDAO{
       public $id;
       public $nombre;
       public $descripcion;

       function __construct($id=null,$nombre=null,$descripcion=null){
        $this->id=$id;
        $this->nombre=$nombre;
        $this->descripcion=$descripcion;
       } 
       function traerProducto(){
        $conn = new Conexion('localhost', 'libni', '12345678Lb', 'libni');
        try {
            $conexion = $conn->Conectar();
            $stmt=$conexion->query('SELECT * from producto');
            $rows=$stmt->fetchAll(PDO::FETCH_ASSOC);
            return $rows; 
            $conn->Desconectar();
        } catch (PDOException $e) {
            echo "Error al conectarse ====>" . $e;
        }
       }
       function eliminarProducto($id){
        $conn = new Conexion('localhost', 'libni', '12345678Lb', 'libni');
        try {
            $conexion = $conn->Conectar();
            $stmt = $conexion->prepare("DELETE FROM producto WHERE id = $id");
            $stmt->execute();
            return "Exito";  
        } catch (PDOException $e) {
            echo "Error al conectarse ====>" . $e;
        }
       }
       function agregarProducto($id, $nombre, $descripcion){
        $conn = new Conexion('localhost', 'libni', '12345678Lb', 'libni');
        try {
            $conexion = $conn->Conectar();
            $stmt = $conexion->prepare("INSERT INTO producto (id, nombre, descripcion) VALUES (?, ?, ?)");
            $stmt->bindParam(1, $id);
            $stmt->bindParam(2, $nombre);
            $stmt->bindParam(3, $descripcion);
            $stmt->execute();
            return "Agregado Exitosamente";
        } catch(PDOException $e) {
            return "Error al conectar a la base de datos: " . $e;
        }
    }
       function traerDatos($id){
        $conn = new Conexion('localhost', 'libni', '12345678Lb', 'libni');
        try {
            $conexion = $conn->Conectar();
            $stmt=$conexion->query("SELECT * from producto WHERE id = {$id}");
            $rows=$stmt->fetch(PDO::FETCH_ASSOC);
            return $rows;
            $conn->Desconectar();
        } catch (PDOException $e) {
            echo "Error al conectarse ====>" . $e;
        }
       }
       /*function guardarProducto($id,$nombre,$descripcion){
        $conn = new Conexion('localhost', 'libni', '12345678Lb', 'libni');
        try {
            $conexion = $conn->Conectar();
            $stmt = $conexion->prepare("INSERT INTO producto VALUE ($id,'{$nombre}','{$descripcion}')");
            $stmt->execute();
            return "Exito";  
        } catch (PDOException $e) {
            echo "Error al conectarse ====>" . $e;
        }
       }*/
       function actualizarProducto($id,$nombre,$descripcion){
        $conn = new Conexion('localhost', 'libni', '12345678Lb', 'libni');
        try {
            $conexion = $conn->Conectar();
            $stmt = $conexion->prepare("UPDATE producto SET nombre='$nombre', descripcion='$descripcion' WHERE id =$id");
            $stmt->execute();
            return "Actualizado Exitosamente";
        } catch (PDOException $e) {
            echo "Error al conectarse ====>" . $e;
        }
       }
    }
?>




 