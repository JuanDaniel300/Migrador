
const modalResultadoConsulta = document.querySelector('.modalResultadoConsulta');

const btn_ejecutarConsultaSqlServer = document.getElementById('ejecutarConsultaSqlServer');

const cerrarModalResultadoConsulta =  document.querySelector('.cerrarModalResultadoConsulta');

btn_ejecutarConsultaSqlServer.addEventListener('click', function(){

    const select_databaseSqlSever = document.getElementById('databaseSqlSever').value;
    const txt_consultaSqlServer = document.getElementById('consultaSqlServer').value;

    if(select_databaseSqlSever == "Database" || txt_consultaSqlServer == ""){
        alert('Rellene todo los datos');
    }else{

        const url = `/ejecutar/${select_databaseSqlSever}/${txt_consultaSqlServer}`;

        $.ajax({
            type: "GET",
            url: url,
            dataType: "json",
            success: function(data) {
                if (data.error) {
                    alert('Error de consulta');
                } else {
                    modalResultadoConsulta.classList.remove('hidden');
                    overlay.style.display = "block";
                    document.getElementById('resultadoQuery').innerHTML = data.tablaHtml;
                }
            },
            error: function(xhr, status, error) {
                console.log(error);
            }
        });

    }
});

cerrarModalResultadoConsulta.addEventListener('click', function(){
    modalResultadoConsulta.classList.add('hidden');
    overlay.style.display = "none";
});