document.addEventListener('readystatechange', inicializar, false);

function inicializar() {
    if (document.readyState == 'complete') {
        var buscador = document.getElementById('buscadorVideos');
        buscador.addEventListener('keydown', function(event) {
            if (event.key === 'Enter') {
                event.preventDefault(); // Para anular que se envie el formulario por defecto y recargue la página
                enviarPeticionAJAX();
            }
        });
    }
}

function enviarPeticionAJAX() {
    var palabra = document.getElementById('buscadorVideos').value;
    if (palabra != '') {
        var xhr = new XMLHttpRequest();
        xhr.addEventListener('readystatechange', gestionarRespuesta, false);
        xhr.open('POST', '/youtube'); 
        xhr.setRequestHeader("Content-type","application/x-www-form-urlencoded");
        xhr.send("valor=" + palabra);
    }
}

function gestionarRespuesta(evento) {
    if (evento.target.readyState == 4 && evento.target.status == 200) {
        var div_listaVideos = document.getElementById("div_listaVideos");
        var selectVideos = div_listaVideos.getElementsByTagName("select")[0];
        
        if (selectVideos) {
            div_listaVideos.removeChild(selectVideos);
        }
        var iframe = div_listaVideos.getElementsByTagName("iframe")[0];
        if (iframe) {
            div_listaVideos.removeChild(iframe);
        }
        
        var datos = JSON.parse(evento.target.responseText);
        
        if (datos && datos.items && datos.items.length > 0) {
            selectVideos = document.createElement("select");
            selectVideos.id = "selectorVideos";
            var opcion = document.createElement("option");
            opcion.innerText = "Selecciona un video de la lista";
            selectVideos.appendChild(opcion);

            for (var i = 0; i < datos.items.length; i++) {
                var opcion = document.createElement("option");
                opcion.value = datos.items[i].id.videoId;
                opcion.text = datos.items[i].snippet.title;
                selectVideos.appendChild(opcion);
            }
            div_listaVideos.appendChild(selectVideos);
            selectVideos.addEventListener("change",cargarVideo);
        } 
    }
}

function cargarVideo(){
    var iframe = div_listaVideos.getElementsByTagName("iframe")[0];
    if (iframe) {
            div_listaVideos.removeChild(iframe);
    }
    iframe = document.createElement("iframe");
    iframe.width = "300px";
    iframe.height = "168,75px";
    iframe.src = "https://www.youtube.com/embed/"+selectorVideos.value;
    div_listaVideos.appendChild(iframe);
}
