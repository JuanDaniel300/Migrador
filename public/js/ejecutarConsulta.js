

function ejecutarConsultaSqlServer(){

}



fetch('/ejecutar')
    .then(response => response.json())
    .then(data => {
        document.getElementById('resultadoQuery').innerHTML = data.tablaHtml;
    })
    .catch(error => console.error('Error:', error));