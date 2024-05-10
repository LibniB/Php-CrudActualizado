<?php
include ('../conexiones/conexion.php');
class ProductosDAO{
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
			// foreach ($conexion->query('SELECT * from productos') as $fila) {
			//     print_r(json_encode($fila));
			// }  
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
 
	} catch (PDOException $e) {
		echo "Error al conectarse ====>" . $e;
	}
   }

function agregarProducto(){
	
	$conn = new Conexion('localhost', 'libni', '12345678Lb', 'libni');
	try {
		$conexion = $conn->Conectar();
		
        $stmt->execute();
 
	} catch (PDOException $e) {
		echo "Error al conectarse ====>" . $e;
	}
   }

function traerDatos($id) {
    $conn = new Conexion('localhost', 'libni', '12345678Lb', 'libni');
    try {
        $conexion = $conn->Conectar();
        $stmt = $conexion->prepare("SELECT * FROM producto WHERE id = {$id}");
        $stmt->execute();
        $rows = $stmt->fetch(PDO::FETCH_ASSOC);
        return $rows; // Add this line to return the data
    } catch (PDOException $e) {
        echo "Error al conectarse: " . $e->getMessage();
    }
}

}







// $conexion = new Conexion('localhost', 'libni', '12345678Lb', 'libni');

// try {
// 	$mbd = $conexion->Conectar();
//     foreach ($mbd->query('SELECT * from producto') as $fila) {
//         print_r(json_encode($fila));
//         echo "<br/>";
//     }
// } catch (PDOException $e) {
//     print "¡Error!: " . $e->getMessage() . "<br/>";
// }

// $conexion->Desconectar();


	// $mbd = new PDO('mysql:host=localhost;dbname=libni', "libni", "12345678Lb");
	// echo "conexion exitosa <br/>";
	// try {
	// 	$mbd = new PDO('mysql:host=localhost;dbname=libni', "libni", "12345678Lb");
	// 	foreach($mbd->query('SELECT * from producto') as $fila) {
	// 		print_r($fila);
	// 		echo "<br/>";
	// 	}
	// 	$mbd = null;
		
	// } catch (PDOException $e) {
	// 	print "¡Error!: " . $e->getMessage() . "<br/>";
	// 	die();
	// }
?>

 