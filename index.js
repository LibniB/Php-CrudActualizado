function cargarDatos(){
    fetch('./controllers/traerProductosController.php')
    .then(response =>response.json())
    .then(data =>{
        const tablaDatos = document.getElementById('tablaDatos');
        tablaDatos.innerHTML = '';
        data.forEach(row =>{
            const tr = document.createElement('tr');
            tr.innerHTML = `
            <td>${row.id}</td>
            <td>${row.nombre}</td>
            <td>${row.descripcion}</td>
            <td><button id='eliminar' onClick='eliminarProducto(${row.id})'>Eliminar</button></td>

            <td>
            <button type="button"
            class="btn btn-primary"
            data-bs-toggle="modal"
            data-bs-target="#exampleModal"
            onClick="traerDatos(${row.id})">Actualizar</button></td>

            `;
            tablaDatos.appendChild(tr);
        });
    });
}
function eliminarProducto(id){

    fetch('./controllers/eliminarProductoController.php?id='+id)

    .then((response)=> response.text())
    .then(data=>{
        alert("ok");

    });
}

function traerDatos(id){
    
    fetch('./controllers/traerDatosController.php?id='+id)
    .then((response) => response.json())
    .then((data) => {
        var inputNombre = document.getElementById("nombreProducto");
        var inputDescripcion = document.getElementById("descripcion");
        var inputId= document.getElementById("idProducto");
        inputNombre.value=data.nombre;
        inputDescripcion.value=data.descripcion;
        inputId.value=data.id;
    });
}

cargarDatos();
