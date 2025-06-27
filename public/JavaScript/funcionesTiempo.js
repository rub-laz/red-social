document.addEventListener('readystatechange', inicializar, false);

function inicializar() {
    if (document.readyState == 'complete') {
        var seleccion = document.getElementById('ubicacion');
        seleccion.addEventListener('change',enviarPeticionAJAXTiempo);
    }
}

function enviarPeticionAJAXTiempo() {
    var ubicacion = document.getElementById('ubicacion').value;
    if (ubicacion == "Actual"){
        obtenerPosicionActual();
    } else if(ubicacion != "Seleccion"){
        var xhr = new XMLHttpRequest();
        xhr.addEventListener('readystatechange', gestionarRespuestaTiempo, false);
        xhr.open('POST', '/tiempo'); 
        xhr.setRequestHeader("Content-type","application/x-www-form-urlencoded");
        xhr.send("valor=" + ubicacion);
    }
}

function obtenerPosicionActual(){
    var opciones = {
    enableHighAccuracy: true,
    timeout: 10000,
    maximumAge: 30000};
    navigator.geolocation.getCurrentPosition(gestionarExito,gestionarFracaso,opciones);
}

function gestionarExito(posicion){
    var latitud = posicion.coords.latitude;
    var longitud = posicion.coords.longitude;
    ubicacion = latitud +","+longitud;
    var xhr = new XMLHttpRequest();
    xhr.addEventListener('readystatechange', gestionarRespuestaTiempo, false);
    xhr.open('POST', '/tiempo'); 
    xhr.setRequestHeader("Content-type","application/x-www-form-urlencoded");
    xhr.send("valor=" + ubicacion);
}

function gestionarFracaso(error){
    alert('Se ha producido el siguiente error\n' + error.message);
}

function gestionarRespuestaTiempo(evento) {
    if (evento.target.readyState == 4 && evento.target.status == 200) {
        var apiTiempo = document.getElementById("apitiempo");
        var datosTiempo = document.getElementById("datosTiempo");
        if (datosTiempo) {
            datosTiempo.remove();
        }
        datosTiempo = document.createElement("div");
        datosTiempo.id="datosTiempo";
        var datos = JSON.parse(evento.target.responseText);
        
        if (datos) {
            var fecha = document.createTextNode("Fecha: "+datos.location.localtime);
            var ubicacion = document.createTextNode("Ubicación: "+datos.location.name + " (" + datos.location.country+")");
            var temActual = document.createTextNode("Temp. actual: "+datos.current.temp_c + "° C");
            var condicionActual = document.createTextNode("Ahora mismo: "+datos.current.condition.text);
            var tempMax = document.createTextNode("Temp.max: " +datos.forecast.forecastday[0].day.maxtemp_c+"° C");
            var tempMin = document.createTextNode("Temp.min: "+ datos.forecast.forecastday[0].day.mintemp_c+"° C");
            var parrafoFecha = document.createElement("p");
            var parrafoUbicacion = document.createElement("p");
            var parrafoTemActual = document.createElement("p");
            var parrafoCondicionActual = document.createElement("p");
            var imagen = document.createElement("img");
            var parrafoTempMax = document.createElement("p");
            var parrafoTempMin = document.createElement("p");

            var icono_url = datos.current.condition.icon;
            
            parrafoFecha.appendChild(fecha);
            parrafoUbicacion.appendChild(ubicacion);
            parrafoTemActual.appendChild(temActual)
            parrafoCondicionActual.appendChild(condicionActual)
            imagen.src=icono_url;
            parrafoTempMax.appendChild(tempMax);
            parrafoTempMin.appendChild(tempMin);
            datosTiempo.appendChild(parrafoFecha);
            datosTiempo.appendChild(parrafoUbicacion);
            datosTiempo.appendChild(parrafoTemActual);
            datosTiempo.appendChild(parrafoCondicionActual);
            datosTiempo.appendChild(imagen);
            datosTiempo.appendChild(parrafoTempMax);
            datosTiempo.appendChild(parrafoTempMin);
            apiTiempo.appendChild(datosTiempo);

        }else{
            alert('Ha surgido un error con la API, intentelo más tarde');
        }
    }
}
