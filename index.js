function cargarDatos() {
    fetch("./controllers/traerProductosController.php")
      .then((response) => response.json())
      .then((data) => {
        const tablaDatos = document.getElementById("tablaDatos");
        tablaDatos.innerHTML = "";
        data.forEach((row) => {
          const tr = document.createElement("tr");
          tr.innerHTML = `
                  <td>${row.id}</td>
                  <td>${row.nombre}</td>
                  <td>${row.descripcion}</td>
                  <td>
                    <button onclick='traerDatos(${row.id})' type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#exampleModal" >Actualizar</button>
                    <button class="btn btn-danger" onClick='eliminarProducto(${row.id})'>Eliminar</button>
                  </td>
                  
  
              `;
          tablaDatos.appendChild(tr);
        });
      });
  }
  
  function limpiarFormulario(){
    var inputId = document.getElementById("id");
    var inputNombre = document.getElementById("nombre");
    var inputDescripcion = document.getElementById("descripcion");
    inputId.value = "";
    inputNombre.value = "";
    inputDescripcion.value = "";
  }
  function guardarProducto(id, nombre, descripcion) {
    fetch(
      `./controllers/guardarProductoController.php?id=${id}&nombre=${nombre}&descripcion=${descripcion}`
    )
      .then((response) => response.text())
      .then((data) => {
        limpiarFormulario();
        cargarDatos();        
      });
  }
  

  function eliminarProducto(id) {
    Swal.fire({
        icon: 'warning',
        title: '¿Estás seguro de eliminar el producto?',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sí, eliminar!'    
    }).then((result) => {
        if (result.isConfirmed) {
            fetch("./controllers/eliminarProductoController.php?id=" + id)
                .then((response) => response.text())
                .then((data) => {
                    cargarDatos();
                    Swal.fire({
                        icon: 'success',
                        title: 'Producto eliminado',
                        text: data.message
                    });
                })
                .catch((error) => {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Ocurrió un error al eliminar el producto'
                    });
                });
        }
    });
}
  
  function agregarProducto() {
    const id = document.getElementById("id").value;
    const nombre = document.getElementById("nombre").value;
    const descripcion = document.getElementById("descripcion").value;
  
    fetch(
      `./controllers/agregarProductoController.php?id=${id}&nombre=${nombre}&descripcion=${descripcion}`
    )
      .then((response) => {
        return response.text();

      })
      .then((data) => {
        mostrarAlerta("Producto agregado con exito")
        cargarDatos();
        document.getElementById("id").value = "";
        document.getElementById("nombre").value = "";
        document.getElementById("descripcion").value = "";
      })
      .catch((error) => {
        console.error('Error:', error);
        mostrarAlerta("Ocurrió un error al agregar el producto");
    });;
  }
  
  function traerDatos(id) {
    fetch(`./controllers/traerDatosController.php?id=${id}`)
      .then((response) => response.json())
      .then((data) => {
        var inputCodigo = document.getElementById("id");
        var inputNombre = document.getElementById("nombre");
        var inputDescripcion = document.getElementById("descripcion");
        inputCodigo.value = data["id"];
        inputNombre.value = data["nombre"];
        inputDescripcion.value = data["descripcion"];
      });
  
    var boton = document.getElementById("submit-btn");
    boton.onclick = function () {
      var inputCodigo = document.getElementById("id");
      var inputNombre = document.getElementById("nombre");
      var inputDescripcion = document.getElementById("descripcion");
      var valId = inputCodigo.value;
      var valNombre = inputNombre.value;
      var valDescripcion = inputDescripcion.value;
      limpiarFormulario();
      guardarProducto(valId, valNombre, valDescripcion);
      mostrarAlerta("Producto actualizado con exito")
    };
  }

  function mostrarAlerta(mensaje) {
    let alerta = document.getElementById("alertMesage");
    alerta.innerHTML = mensaje;
    alerta.style.display = "block"; // Mostrar la alerta
  
    setTimeout(function() {
      alerta.style.display = "none"; // Ocultar la alerta después de 2 segundos
    }, 5000);
  }
  
  
  cargarDatos();