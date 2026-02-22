function mostrarSeccion(id){
    const lista = ["info", "medicacion", "historial"];
    lista.forEach(item => {
        document.getElementById(item).style.display = "none";
    });
    document.getElementById(id).style.display = "block";
}

function abrirModal() { document.getElementById("modalFondo").style.display = "block"; }
function cerrarModal() { document.getElementById("modalFondo").style.display = "none"; }

window.onclick = function(event) {
    let modal = document.getElementById("modalFondo");
    if (event.target == modal) cerrarModal();
}
