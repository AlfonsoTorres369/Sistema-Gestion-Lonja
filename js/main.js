function mostrarElem(id) {
    document.getElementById(id).style.display = 'block';
}

function quitarElem(id) {
    document.getElementById(id).style.display = 'none';
}

function guardarCapturas() {

    if (confirm("¿Desea introducir más capturas?")) {
        
        //Hacer la funcionalidad de guardar lote, mostrar pagina para introducir nuevo lote para la misma captura (mismo id_captura)
        
    } else {
        
        //Guardar el lote en la BBDD

    }
}