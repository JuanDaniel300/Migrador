var contadorConsultasMySql = 0;

function agregarNuevaConsultaMySql() {
    contadorConsultasMySql++;

    var nuevaConsultaMySql = document.createElement('div');
    nuevaConsultaMySql.className = 'consultaMySql';
    nuevaConsultaMySql.id = 'consultaMySql-' + contadorConsultasMySql;
    nuevaConsultaMySql.innerHTML = `
        <textarea id="consultaMySql" name="txt_ConsultaMySql" class="txt_ConsultaMySql" rows="10 placeholder="ConsultaMySql  #${contadorConsultasMySql}"></textarea>
    `;

    var btnEliminarMySql = document.createElement('button');
    btnEliminarMySql.className = 'eliminarConsultaMySql';
    btnEliminarMySql.textContent = 'X';
    btnEliminarMySql.addEventListener('click', function() {
        nuevaConsultaMySql.remove();
        document.getElementById('pestanasMySql').removeChild(document.getElementById('pestanasMySql').children[contadorConsultasMySql - 1]);
        contadorConsultasMySql--;
        mostrarConsultaMySql('consultaMySql-' + contadorConsultasMySql);
    });

    nuevaConsultaMySql.appendChild(btnEliminarMySql);

    document.getElementById('consultasMySql').appendChild(nuevaConsultaMySql);

    var nuevaPestanaMySql = document.createElement('li');
    nuevaPestanaMySql.className = 'li_nuevaPestanaMySql';
    nuevaPestanaMySql.innerHTML = `<a href="#consultaMySql-${contadorConsultasMySql}">Query#${contadorConsultasMySql}</a>`;
    nuevaPestanaMySql.appendChild(btnEliminarMySql); 
    document.getElementById('pestanasMySql').appendChild(nuevaPestanaMySql);

    nuevaPestanaMySql.querySelector('a').addEventListener('click', function(event) {
        event.preventDefault();
        mostrarConsultaMySql(nuevaConsultaMySql.id);
    });

    mostrarConsultaMySql(nuevaConsultaMySql.id);
}

function mostrarConsultaMySql(idConsultaMySql) {
    var consultasMySql = document.querySelectorAll('.consultaMySql');
    consultasMySql.forEach(function(consultaMySql) {
        if (consultaMySql.id === idConsultaMySql) {
            consultaMySql.style.display = 'block';
        } else {
            consultaMySql.style.display = 'none';
        }
    });
}

function inicializarPestanasMySql() {
    document.getElementById('AgregarNuevaConsultaMySql').addEventListener('click', agregarNuevaConsultaMySql);
}

document.addEventListener('DOMContentLoaded', inicializarPestanasMySql);