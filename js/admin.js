let botones_eliminar = document.querySelectorAll('.btn-eliminar');


botones_eliminar.forEach(boton => {
    boton.addEventListener('click', event => {
        let botonSeleccionado = event.currentTarget;
        let id = botonSeleccionado.getAttribute('data-id');
        let titulo = botonSeleccionado.getAttribute('data-titulo');
        if(confirm(`¿Seguro que quieres eliminar la película ${titulo}?`)){
            
            fetch('includes/control_peliculas.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: 'id=' + id + '&metodo=delete'
            })
            .then(response => response.json())
            .then(data => {
                if(data.success){
                    alert('Registro eliminado');
                    //eliminar fila de la tabla
                    const fila = document.getElementById(`fila-${id}`);
                    if(fila){
                        fila.remove();
                        //alert('fila  eliminada');
                    }
                }else{
                    alert('Error al eliminar: ' + data.message);
                }
            })
            .catch(error => {
                console.error('Error: '+ error);
                alert('Ocurrió un error al eliminar')
            })

    }
    })
});