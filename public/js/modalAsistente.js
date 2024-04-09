const modal =  document.querySelector('.modal');

const showModal =  document.querySelector('.show-modal');
const closeModal =  document.querySelector('.close-modal');

const prevBtn = document.getElementById('prev-btn');
const nextBtn = document.getElementById('next-btn');
const btn_confirmarSqlServer = document.getElementById('confirmarSqlServer');
const btn_confirmarMySQL = document.getElementById('confirmarMySQL');

const overlay = document.getElementById("modalOverlay");

const manejadorBDSelect = document.getElementById('manejadorBD');
const sqlServerDiv = document.getElementById('escogerBDSqlServer');
const mySqlDiv = document.getElementById('escogerBDMySql');




const steps = ['step-1', 'step-2', 'step-3'];
let currentStep = 0;

function showStep(stepIndex) {
    steps.forEach(step => {
        const element = document.getElementById(step + '-content');
        if (element) {
            if (step === steps[stepIndex]) {
                element.classList.remove('hidden');
            } else {
                element.classList.add('hidden');
            }
        }
    });
}

function updateButtons() {
    prevBtn.disabled = currentStep === 0;
    nextBtn.disabled = currentStep === steps.length - 1;

    
    const isLastStep = currentStep === steps.length - 1;
    
    if (isLastStep) {
        const selectedOption = parseInt(manejadorBDSelect.value);
        if (selectedOption === 0) {
            btn_confirmarSqlServer.classList.remove('hidden');
            btn_confirmarMySQL.classList.add('hidden');
        } else if (selectedOption === 1) {
            btn_confirmarSqlServer.classList.add('hidden');
            btn_confirmarMySQL.classList.remove('hidden');
        } else {
            btn_confirmarSqlServer.classList.add('hidden');
            btn_confirmarMySQL.classList.add('hidden');
        }
    } else {
        btn_confirmarSqlServer.classList.add('hidden');
        btn_confirmarMySQL.classList.add('hidden');
    }
}

function updateStepIndicator() {
    const stepIndicators = document.querySelectorAll('.flex li');
    stepIndicators.forEach((indicator, index) => {
            indicator.style.color = '';
        if (index === currentStep) {
            indicator.style.color = '#FFC301';
        } else if (index < currentStep) {
            indicator.style.color = '#3B82F6';
        }
    });
}

function updateModalContent() {
    const content = document.querySelector(`#${steps[currentStep]}-content p`);
    if (content) {
        switch (currentStep) {
            case 0:
                content.textContent = 'Content for step 1.';
                break;
            case 1:
                content.textContent = 'Content for step 2.';
                break;
            case 2:
                content.innerHTML = `<p>Seguro que quiere migrar esa base de datos, dale click en <strong>confirma</strong> para hacer la migración.</p>`;
                break;
        }
    }
}

function initModal() {
    showStep(currentStep);
    updateButtons();
    updateStepIndicator();
    updateModalContent();
}

prevBtn.addEventListener('click', () => {
    if (currentStep > 0) {
        currentStep--;
        initModal();
    }
});

nextBtn.addEventListener('click', () => {
    if (currentStep < steps.length - 1) {
        currentStep++;
        initModal();
    }
});

document.addEventListener('DOMContentLoaded', initModal);

showModal.addEventListener('click', function(){
    modal.classList.remove('hidden');
    manejadorBDSelect.value = 'Manejador';
    sqlServerDiv.value = 'BDSqlServer';
    mySqlDiv.value = 'BDMySql';
    overlay.style.display = "block";
    currentStep = 0;
    initModal();
});

closeModal.addEventListener('click', function(){
    modal.classList.add('hidden');
    overlay.style.display = "none";
});


manejadorBDSelect.addEventListener('change', function() {
    const selectedOption = parseInt(manejadorBDSelect.value);

    if (selectedOption === 0) {
        sqlServerDiv.classList.remove('hidden');
        mySqlDiv.classList.add('hidden');
    } else if (selectedOption === 1) {
        mySqlDiv.classList.remove('hidden');
        sqlServerDiv.classList.add('hidden');
    } else {
        sqlServerDiv.classList.add('hidden');
        mySqlDiv.classList.add('hidden');
    }
});

// manejadorBDSelect.addEventListener('change', function() {
//     const selectedOption = parseInt(manejadorBDSelect.value);

//     if (selectedOption === 0) {
//         sqlServerDiv.classList.remove('hidden');
//         mySqlDiv.classList.add('hidden');
//         btn_confirmarSqlServer.style.display = "none";
//         btn_confirmarMySQL.style.display = "block";
//     } else if (selectedOption === 1) {
//         mySqlDiv.classList.remove('hidden');
//         sqlServerDiv.classList.add('hidden');
//         btn_confirmarMySQL.style.display = "none";
//         btn_confirmarSqlServer.style.display = "block";
//     } else {
//         sqlServerDiv.classList.add('hidden');
//         mySqlDiv.classList.add('hidden');
//         btn_confirmarMySQL.style.display = "none";
//         btn_confirmarSqlServer.style.display = "none";
//     }
// });


$(document).ready(function() {
    $('#escogerBDSqlServer').change(function() {
        let databaseSqlServer = $(this).val(); 
        if (databaseSqlServer) {
            $('#confirmarSqlServer').prop('disabled', false); 
        } else {
            $('#confirmarSqlServer').prop('disabled', true);
        }
    });

    $('#confirmarSqlServer').click(function() {
        let databaseSqlServer = $('#escogerBDSqlServer').val(); 
        if (databaseSqlServer) {
            obtenerEstructuraBD(databaseSqlServer); 
        } else {
            alert('Por favor, selecciona una base de datos antes de confirmar.'); 
        }
    });

    function obtenerEstructuraBD(databaseSqlServer) {
        const csrfToken = document.head.querySelector('meta[name="csrf-token"]').content;

        $.ajax({
            type: "POST",
            url: "/convertir-json",
            headers: {
                'X-CSRF-TOKEN': csrfToken
            },
            data: {
                escogerBDSqlServer: databaseSqlServer
            },
            success: function (response) {
                if (response.success) {
                    console.log("Estructura de la base de datos obtenida correctamente");
                    migrarBD(databaseSqlServer, response.data);
                } else {
                    console.log("Error al obtener la estructura de la base de datos:", response.message);
                }
            },
            error: function (xhr, status, error) {
                console.log("Error en la solicitud AJAX:", error);
            }
        });
    }

    function migrarBD(databaseSqlServer, base_datos_sqlserver) {
        const csrfToken = document.head.querySelector('meta[name="csrf-token"]').content;
        const strings = [];

        for (const tabla of base_datos_sqlserver.tables) {
            const nombre_tabla = tabla.tabla_name.toLowerCase();
            const campos = crearCampos(tabla.campos); 
            let string = `CREATE TABLE IF NOT EXISTS \`${nombre_tabla}\` (`;
            string += campos.join(", ");
            const nombre_primary = tabla.campos.find(campo => campo.parametros.nombre_primary);
            if (nombre_primary) {
                string += `, PRIMARY KEY (\`${nombre_primary.nombre_campos}\`) USING BTREE`;
            }
            string += ");";
            strings.push(string);
        }

        for (const fk of base_datos_sqlserver.foreignKeys) {
            const nombre_fk = fk.nombre_fk.toLowerCase();
            const campo_origen = fk.campo_origen;
            const tabla_origen = fk.tabla_origen;
            const tabla_referencia = fk.tabla_referencia;
            const campo_referencia = fk.campo_referencia;
            let string_fk = `ALTER TABLE \`${tabla_origen}\` ADD CONSTRAINT \`${nombre_fk}\` FOREIGN KEY (\`${campo_origen}\`) REFERENCES \`${tabla_referencia}\` (\`${campo_referencia}\`);`;
            strings.push(string_fk);
        }

        $.ajax({
            type: "POST",
            url: "/migrar-bd",
            headers: {
                'X-CSRF-TOKEN': csrfToken
            },
            data: {
                database: databaseSqlServer,
                migrador: JSON.stringify(strings)
            },
            success: function (response) {
                console.log("Migración exitosa");
                console.log(response.strings);
            },
            error: function (xhr, status, error) {
                console.log("Error en la migración de la base de datos:", error);
            }
        });
    }

    function crearCampos(campos) {
        let camposSQL = [];
        for (const campo of campos) {
            const nombre_campo = campo.nombre_campos.toLowerCase();
            let type = campo.type;
            const parametros = campo.parametros;
            let campoString = `\`${nombre_campo}\` ${type}`;
            if (type.toLowerCase() === 'nvarchar') {
                type = 'varchar(255)';
            }
            if (type.toLowerCase() === 'varchar') {
                campoString += "(255)";
            }
            if(parametros.not_null){
                campoString += " NOT NULL";
            } else {
                campoString += " NULL";
            }
            if(parametros.identity){
                campoString += " AUTO_INCREMENT";
            }
            camposSQL.push(campoString);
        }
        return camposSQL;
    }
});




$(document).ready(function() {
    $('#escogerBDMySql').change(function() {
        let databaseMySql = $(this).val(); 
        if (databaseMySql) {
            $('#confirmarMySQL').prop('disabled', false); 
        } else {
            $('#confirmarMySQL').prop('disabled', true);
        }
    });

    $('#confirmarMySQL').click(function() {
        let databaseMySql = $('#escogerBDMySql').val(); 
        if (databaseMySql) {
            obtenerEstructuraBDMySql(databaseMySql); 
        } else {
            alert('Por favor, selecciona una base de datos antes de confirmar.'); 
        }
    });

    function obtenerEstructuraBDMySql(databaseMySql) {
        const csrfToken = document.head.querySelector('meta[name="csrf-token"]').content;

        $.ajax({
            type: "POST",
            url: "/convertir-json-mysql",
            headers: {
                'X-CSRF-TOKEN': csrfToken
            },
            data: {
                escogerBDMySql: databaseMySql
            },
            success: function (response) {
                if (response.success) {
                    console.log("Estructura de la base de datos obtenida correctamente");
                    migrarBDMySql(databaseMySql, response.data);
                } else {
                    console.log("Error al obtener la estructura de la base de datos:", response.message);
                }
            },
            error: function (xhr, status, error) {
                console.log("Error en la solicitud AJAX:", error);
            }
        });
    }

    function migrarBDMySql(databaseMySql, base_datos_mysql) {
        const csrfToken = document.head.querySelector('meta[name="csrf-token"]').content;
        const strings = [];

        for (const tabla of base_datos_mysql.tables) {
            const nombre_tabla = tabla.tabla_name.toLowerCase();
            const campos = crearCampos(tabla.campos); 
            let string = `CREATE TABLE ${nombre_tabla} (`;
            string += campos.join(", ");
            const nombre_primary = tabla.campos.find(campo => campo.parametros.nombre_primary);
            if (nombre_primary) {
                string += `, PRIMARY KEY (${nombre_primary.nombre_campos})`;
            }
            string += ");";
            strings.push(string);
        }

        for (const fk of base_datos_mysql.foreignKeys) {
            const nombre_fk = fk.nombre_fk.toLowerCase();
            const campo_origen = fk.campo_origen;
            const tabla_origen = fk.tabla_origen;
            const tabla_referencia = fk.tabla_referencia;
            const campo_referencia = fk.campo_referencia;
            let string_fk = `ALTER TABLE ${tabla_origen} ADD CONSTRAINT ${nombre_fk} FOREIGN KEY (${campo_origen}) REFERENCES ${tabla_referencia} (${campo_referencia});`;
            strings.push(string_fk);
        }

        $.ajax({
            type: "POST",
            url: "/migrar-bd-mysql",
            headers: {
                'X-CSRF-TOKEN': csrfToken
            },
            data: {
                database: databaseMySql,
                migrador: JSON.stringify(strings)
            },
            success: function (response) {
                console.log("Migración exitosa");
                console.log(response.strings);
            },
            error: function (xhr, status, error) {
                console.log("Error en la migración de la base de datos:", error);
            }
        });
    }

    function crearCampos(campos){
        let camposSQL = [];
        for(const campo of campos){
            const nombre_campo = campo.nombre_campos.toLowerCase();
            let type = campo.type.toUpperCase();
            const parametros = campo.parametros;
            let campoString = `${nombre_campo} ${type}`;
      
            if (type.toLowerCase() === 'nvarchar') {
              type = 'varchar(255)';
            }
            if (type.toLowerCase() === 'varchar') {
                campoString += "(255)";
            }
            if(parametros.not_null){
                campoString += " NOT NULL";
            } else {
                campoString += " NULL";
            }
            if(parametros.identity){
              campoString += " IDENTITY(1,1)";
            }
      
            camposSQL.push(campoString);
        }
        return camposSQL;
      }
});

