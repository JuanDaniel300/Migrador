var contadorConsultasSqlServer = 0;

function agregarNuevaConsultaSqlServer() {
    contadorConsultasSqlServer++;

    var nuevaConsultaSqlServer = document.createElement('div');
    nuevaConsultaSqlServer.className = 'consultasSqlServer';
    nuevaConsultaSqlServer.id = 'consultasSqlServer-' + contadorConsultasSqlServer;
    nuevaConsultaSqlServer.innerHTML = `
        <textarea id="consultaSqlServer" name="txt_ConsultaSqlServer" class="txt_ConsultaSqlServer" rows="10 placeholder="ConsultaSqlServer  #${contadorConsultasSqlServer}"></textarea>
    `;

    var btnEliminarSqlServer = document.createElement('button');
    btnEliminarSqlServer.className = 'eliminarConsultaSqlServer';
    btnEliminarSqlServer.textContent = 'X';
    btnEliminarSqlServer.addEventListener('click', function() {
        nuevaConsultaSqlServer.remove();
        document.getElementById('pestanasSqlServer').removeChild(document.getElementById('pestanasSqlServer').children[contadorConsultasSqlServer - 1]);
        contadorConsultasSqlServer--;
        mostrarConsultaSqlServer('consultasSqlServer-' + contadorConsultasSqlServer);
    });

    nuevaConsultaSqlServer.appendChild(btnEliminarSqlServer);

    document.getElementById('consultasSqlServer').appendChild(nuevaConsultaSqlServer);

    var nuevaPestanaSqlServer = document.createElement('li');
    nuevaPestanaSqlServer.className = 'li_nuevaPestanaSqlServer';
    nuevaPestanaSqlServer.innerHTML = `<a href="#consultasSqlServer-${contadorConsultasSqlServer}">Query#${contadorConsultasSqlServer}</a>`;
    nuevaPestanaSqlServer.appendChild(btnEliminarSqlServer); 
    document.getElementById('pestanasSqlServer').appendChild(nuevaPestanaSqlServer);

    nuevaPestanaSqlServer.querySelector('a').addEventListener('click', function(event) {
        event.preventDefault();
        mostrarConsultaSqlServer(nuevaConsultaSqlServer.id);
    });

    mostrarConsultaSqlServer(nuevaConsultaSqlServer.id);
}

function mostrarConsultaSqlServer(idConsultaSqlServer) {
    var consultasSqlServer = document.querySelectorAll('.consultasSqlServer');
    consultasSqlServer.forEach(function(consultaSqlServer) {
        if (consultaSqlServer.id === idConsultaSqlServer) {
            consultaSqlServer.style.display = 'block';
        } else {
            consultaSqlServer.style.display = 'none';
        }
    });
}

function inicializarPestanasSqlServer() {
    document.getElementById('AgregarNuevaConsultaSqlServer').addEventListener('click', agregarNuevaConsultaSqlServer);
}

document.addEventListener('DOMContentLoaded', inicializarPestanasSqlServer);