const btn_confirmarMySQL = document.getElementById('confirmarMySQL');


let base_datos = {
  "tables": [
    {
      "tabla_name": "acuerdos",
      "campos": [
        {
          "nombre_campos": "id_acuerdos",
          "type": "int",
          "parametros": {
            "not_null": true,
            "null": false,
            "identity": true,
            "nombre_primary": true
          }
        },
        {
          "nombre_campos": "id_reunion",
          "type": "int",
          "parametros": {
            "not_null": true,
            "null": false,
            "identity": false,
            "nombre_primary": false
          }
        },
        {
          "nombre_campos": "acuerdo",
          "type": "varchar",
          "parametros": {
            "not_null": true,
            "null": false,
            "identity": false,
            "nombre_primary": false
          }
        },
        {
          "nombre_campos": "responsable",
          "type": "int",
          "parametros": {
            "not_null": true,
            "null": false,
            "identity": false,
            "nombre_primary": false
          }
        },
        {
          "nombre_campos": "fechacompromiso",
          "type": "datetime",
          "parametros": {
            "not_null": true,
            "null": false,
            "identity": false,
            "nombre_primary": false
          }
        },
        {
          "nombre_campos": "creadopor",
          "type": "int",
          "parametros": {
            "not_null": true,
            "null": false,
            "identity": false,
            "nombre_primary": false
          }
        },
        {
          "nombre_campos": "fechacreacion",
          "type": "datetime",
          "parametros": {
            "not_null": true,
            "null": false,
            "identity": false,
            "nombre_primary": false
          }
        },
        {
          "nombre_campos": "modificadopor",
          "type": "int",
          "parametros": {
            "not_null": false,
            "null": true,
            "identity": false,
            "nombre_primary": false
          }
        },
        {
          "nombre_campos": "fechamodificacion",
          "type": "datetime",
          "parametros": {
            "not_null": false,
            "null": true,
            "identity": false,
            "nombre_primary": false
          }
        },
        {
          "nombre_campos": "eliminadopor",
          "type": "int",
          "parametros": {
            "not_null": false,
            "null": true,
            "identity": false,
            "nombre_primary": false
          }
        },
        {
          "nombre_campos": "fechaeliminacion",
          "type": "datetime",
          "parametros": {
            "not_null": false,
            "null": true,
            "identity": false,
            "nombre_primary": false
          }
        }
      ]
    },
    {
      "tabla_name": "asociarrequerimientos",
      "campos": [
        {
          "nombre_campos": "idasociarrequerimiento",
          "type": "bigint",
          "parametros": {
            "not_null": true,
            "null": false,
            "identity": true,
            "nombre_primary": true
          }
        },
        {
          "nombre_campos": "idsala",
          "type": "bigint",
          "parametros": {
            "not_null": false,
            "null": true,
            "identity": false,
            "nombre_primary": false
          }
        },
        {
          "nombre_campos": "idrequerimiento",
          "type": "bigint",
          "parametros": {
            "not_null": false,
            "null": true,
            "identity": false,
            "nombre_primary": false
          }
        }
      ]
    },
    {
      "tabla_name": "asociarsalas",
      "campos": [
        {
          "nombre_campos": "idasociarsala",
          "type": "bigint",
          "parametros": {
            "not_null": true,
            "null": false,
            "identity": true,
            "nombre_primary": true
          }
        },
        {
          "nombre_campos": "idusuario",
          "type": "bigint",
          "parametros": {
            "not_null": false,
            "null": true,
            "identity": false,
            "nombre_primary": false
          }
        },
        {
          "nombre_campos": "idsala",
          "type": "bigint",
          "parametros": {
            "not_null": false,
            "null": true,
            "identity": false,
            "nombre_primary": false
          }
        }
      ]
    },
    {
      "tabla_name": "comentarios",
      "campos": [
        {
          "nombre_campos": "idcomentario",
          "type": "bigint",
          "parametros": {
            "not_null": true,
            "null": false,
            "identity": true,
            "nombre_primary": true
          }
        },
        {
          "nombre_campos": "idreservacion",
          "type": "bigint",
          "parametros": {
            "not_null": false,
            "null": true,
            "identity": false,
            "nombre_primary": false
          }
        },
        {
          "nombre_campos": "opinion",
          "type": "varchar",
          "parametros": {
            "not_null": false,
            "null": true,
            "identity": false,
            "nombre_primary": false
          }
        },
        {
          "nombre_campos": "comentario",
          "type": "varchar",
          "parametros": {
            "not_null": false,
            "null": true,
            "identity": false,
            "nombre_primary": false
          }
        },
        {
          "nombre_campos": "creadopor",
          "type": "smallint",
          "parametros": {
            "not_null": false,
            "null": true,
            "identity": false,
            "nombre_primary": false
          }
        },
        {
          "nombre_campos": "fechacreacion",
          "type": "datetime",
          "parametros": {
            "not_null": false,
            "null": true,
            "identity": false,
            "nombre_primary": false
          }
        },
        {
          "nombre_campos": "modificadopor",
          "type": "smallint",
          "parametros": {
            "not_null": false,
            "null": true,
            "identity": false,
            "nombre_primary": false
          }
        },
        {
          "nombre_campos": "fechamodificacion",
          "type": "datetime",
          "parametros": {
            "not_null": false,
            "null": true,
            "identity": false,
            "nombre_primary": false
          }
        },
        {
          "nombre_campos": "eliminadopor",
          "type": "smallint",
          "parametros": {
            "not_null": false,
            "null": true,
            "identity": false,
            "nombre_primary": false
          }
        },
        {
          "nombre_campos": "fechaeliminacion",
          "type": "datetime",
          "parametros": {
            "not_null": false,
            "null": true,
            "identity": false,
            "nombre_primary": false
          }
        }
      ]
    },
    {
      "tabla_name": "detallesreservaciones",
      "campos": [
        {
          "nombre_campos": "iddetalle",
          "type": "bigint",
          "parametros": {
            "not_null": true,
            "null": false,
            "identity": true,
            "nombre_primary": true
          }
        },
        {
          "nombre_campos": "idreservacion",
          "type": "bigint",
          "parametros": {
            "not_null": false,
            "null": true,
            "identity": false,
            "nombre_primary": false
          }
        },
        {
          "nombre_campos": "idrequerimiento",
          "type": "bigint",
          "parametros": {
            "not_null": false,
            "null": true,
            "identity": false,
            "nombre_primary": false
          }
        }
      ]
    },
    {
      "tabla_name": "estatus",
      "campos": [
        {
          "nombre_campos": "idestatu",
          "type": "bigint",
          "parametros": {
            "not_null": true,
            "null": false,
            "identity": true,
            "nombre_primary": true
          }
        },
        {
          "nombre_campos": "idreservacion",
          "type": "bigint",
          "parametros": {
            "not_null": false,
            "null": true,
            "identity": false,
            "nombre_primary": false
          }
        },
        {
          "nombre_campos": "estatu",
          "type": "bit",
          "parametros": {
            "not_null": false,
            "null": true,
            "identity": false,
            "nombre_primary": false
          }
        },
        {
          "nombre_campos": "asunto",
          "type": "varchar",
          "parametros": {
            "not_null": false,
            "null": true,
            "identity": false,
            "nombre_primary": false
          }
        },
        {
          "nombre_campos": "descripcion",
          "type": "varchar",
          "parametros": {
            "not_null": false,
            "null": true,
            "identity": false,
            "nombre_primary": false
          }
        },
        {
          "nombre_campos": "creadopor",
          "type": "smallint",
          "parametros": {
            "not_null": false,
            "null": true,
            "identity": false,
            "nombre_primary": false
          }
        },
        {
          "nombre_campos": "fechacreacion",
          "type": "datetime",
          "parametros": {
            "not_null": false,
            "null": true,
            "identity": false,
            "nombre_primary": false
          }
        },
        {
          "nombre_campos": "modificadopor",
          "type": "smallint",
          "parametros": {
            "not_null": false,
            "null": true,
            "identity": false,
            "nombre_primary": false
          }
        },
        {
          "nombre_campos": "fechamodificacion",
          "type": "datetime",
          "parametros": {
            "not_null": false,
            "null": true,
            "identity": false,
            "nombre_primary": false
          }
        },
        {
          "nombre_campos": "eliminadopor",
          "type": "smallint",
          "parametros": {
            "not_null": false,
            "null": true,
            "identity": false,
            "nombre_primary": false
          }
        },
        {
          "nombre_campos": "fechaeliminacion",
          "type": "datetime",
          "parametros": {
            "not_null": false,
            "null": true,
            "identity": false,
            "nombre_primary": false
          }
        }
      ]
    },
    {
      "tabla_name": "evidencias",
      "campos": [
        {
          "nombre_campos": "idevidencia",
          "type": "int",
          "parametros": {
            "not_null": true,
            "null": false,
            "identity": true,
            "nombre_primary": true
          }
        },
        {
          "nombre_campos": "idacuerdo",
          "type": "int",
          "parametros": {
            "not_null": false,
            "null": true,
            "identity": false,
            "nombre_primary": false
          }
        },
        {
          "nombre_campos": "nombrearchivo",
          "type": "varchar",
          "parametros": {
            "not_null": false,
            "null": true,
            "identity": false,
            "nombre_primary": false
          }
        }
      ]
    },
    {
      "tabla_name": "horas",
      "campos": [
        {
          "nombre_campos": "id",
          "type": "int",
          "parametros": {
            "not_null": true,
            "null": false,
            "identity": false,
            "nombre_primary": true
          }
        },
        {
          "nombre_campos": "hora",
          "type": "time",
          "parametros": {
            "not_null": false,
            "null": true,
            "identity": false,
            "nombre_primary": false
          }
        }
      ]
    },
    {
      "tabla_name": "horasduracion",
      "campos": [
        {
          "nombre_campos": "id",
          "type": "int",
          "parametros": {
            "not_null": true,
            "null": false,
            "identity": false,
            "nombre_primary": true
          }
        },
        {
          "nombre_campos": "horasduracion",
          "type": "int",
          "parametros": {
            "not_null": false,
            "null": true,
            "identity": false,
            "nombre_primary": false
          }
        }
      ]
    },
    {
      "tabla_name": "minutosduracion",
      "campos": [
        {
          "nombre_campos": "id",
          "type": "int",
          "parametros": {
            "not_null": true,
            "null": false,
            "identity": false,
            "nombre_primary": true
          }
        },
        {
          "nombre_campos": "minutosduracion",
          "type": "int",
          "parametros": {
            "not_null": false,
            "null": true,
            "identity": false,
            "nombre_primary": false
          }
        }
      ]
    },
    {
      "tabla_name": "requerimientos",
      "campos": [
        {
          "nombre_campos": "idrequerimiento",
          "type": "bigint",
          "parametros": {
            "not_null": true,
            "null": false,
            "identity": true,
            "nombre_primary": true
          }
        },
        {
          "nombre_campos": "nombre",
          "type": "varchar",
          "parametros": {
            "not_null": false,
            "null": true,
            "identity": false,
            "nombre_primary": false
          }
        },
        {
          "nombre_campos": "notificar",
          "type": "bit",
          "parametros": {
            "not_null": false,
            "null": true,
            "identity": false,
            "nombre_primary": false
          }
        },
        {
          "nombre_campos": "correo",
          "type": "varchar",
          "parametros": {
            "not_null": false,
            "null": true,
            "identity": false,
            "nombre_primary": false
          }
        },
        {
          "nombre_campos": "creadopor",
          "type": "smallint",
          "parametros": {
            "not_null": false,
            "null": true,
            "identity": false,
            "nombre_primary": false
          }
        },
        {
          "nombre_campos": "fechacreacion",
          "type": "datetime",
          "parametros": {
            "not_null": false,
            "null": true,
            "identity": false,
            "nombre_primary": false
          }
        },
        {
          "nombre_campos": "modificadopor",
          "type": "smallint",
          "parametros": {
            "not_null": false,
            "null": true,
            "identity": false,
            "nombre_primary": false
          }
        },
        {
          "nombre_campos": "fechamodificacion",
          "type": "datetime",
          "parametros": {
            "not_null": false,
            "null": true,
            "identity": false,
            "nombre_primary": false
          }
        },
        {
          "nombre_campos": "eliminadopor",
          "type": "smallint",
          "parametros": {
            "not_null": false,
            "null": true,
            "identity": false,
            "nombre_primary": false
          }
        },
        {
          "nombre_campos": "fechaeliminacion",
          "type": "datetime",
          "parametros": {
            "not_null": false,
            "null": true,
            "identity": false,
            "nombre_primary": false
          }
        }
      ]
    },
    {
      "tabla_name": "reservaciones",
      "campos": [
        {
          "nombre_campos": "idreservacion",
          "type": "bigint",
          "parametros": {
            "not_null": true,
            "null": false,
            "identity": true,
            "nombre_primary": true
          }
        },
        {
          "nombre_campos": "idsala",
          "type": "bigint",
          "parametros": {
            "not_null": false,
            "null": true,
            "identity": false,
            "nombre_primary": false
          }
        },
        {
          "nombre_campos": "idusuario",
          "type": "bigint",
          "parametros": {
            "not_null": false,
            "null": true,
            "identity": false,
            "nombre_primary": false
          }
        },
        {
          "nombre_campos": "numeropersona",
          "type": "smallint",
          "parametros": {
            "not_null": false,
            "null": true,
            "identity": false,
            "nombre_primary": false
          }
        },
        {
          "nombre_campos": "fechasolicitud",
          "type": "datetime",
          "parametros": {
            "not_null": false,
            "null": true,
            "identity": false,
            "nombre_primary": false
          }
        },
        {
          "nombre_campos": "motivo",
          "type": "varchar",
          "parametros": {
            "not_null": false,
            "null": true,
            "identity": false,
            "nombre_primary": false
          }
        },
        {
          "nombre_campos": "horainicio",
          "type": "time",
          "parametros": {
            "not_null": false,
            "null": true,
            "identity": false,
            "nombre_primary": false
          }
        },
        {
          "nombre_campos": "horaduracion",
          "type": "int",
          "parametros": {
            "not_null": false,
            "null": true,
            "identity": false,
            "nombre_primary": false
          }
        },
        {
          "nombre_campos": "minutoduracion",
          "type": "int",
          "parametros": {
            "not_null": false,
            "null": true,
            "identity": false,
            "nombre_primary": false
          }
        },
        {
          "nombre_campos": "horafinal",
          "type": "time",
          "parametros": {
            "not_null": false,
            "null": true,
            "identity": false,
            "nombre_primary": false
          }
        },
        {
          "nombre_campos": "estadoreservacion",
          "type": "char",
          "parametros": {
            "not_null": false,
            "null": true,
            "identity": false,
            "nombre_primary": false
          }
        },
        {
          "nombre_campos": "detalle",
          "type": "char",
          "parametros": {
            "not_null": false,
            "null": true,
            "identity": false,
            "nombre_primary": false
          }
        },
        {
          "nombre_campos": "creadopor",
          "type": "smallint",
          "parametros": {
            "not_null": false,
            "null": true,
            "identity": false,
            "nombre_primary": false
          }
        },
        {
          "nombre_campos": "fechacreacion",
          "type": "datetime",
          "parametros": {
            "not_null": false,
            "null": true,
            "identity": false,
            "nombre_primary": false
          }
        },
        {
          "nombre_campos": "modificadopor",
          "type": "smallint",
          "parametros": {
            "not_null": false,
            "null": true,
            "identity": false,
            "nombre_primary": false
          }
        },
        {
          "nombre_campos": "fechamodificacion",
          "type": "datetime",
          "parametros": {
            "not_null": false,
            "null": true,
            "identity": false,
            "nombre_primary": false
          }
        },
        {
          "nombre_campos": "eliminadopor",
          "type": "smallint",
          "parametros": {
            "not_null": false,
            "null": true,
            "identity": false,
            "nombre_primary": false
          }
        },
        {
          "nombre_campos": "fechaeliminacion",
          "type": "datetime",
          "parametros": {
            "not_null": false,
            "null": true,
            "identity": false,
            "nombre_primary": false
          }
        }
      ]
    },
    {
      "tabla_name": "salas",
      "campos": [
        {
          "nombre_campos": "idsala",
          "type": "bigint",
          "parametros": {
            "not_null": true,
            "null": false,
            "identity": true,
            "nombre_primary": true
          }
        },
        {
          "nombre_campos": "nombre",
          "type": "varchar",
          "parametros": {
            "not_null": false,
            "null": true,
            "identity": false,
            "nombre_primary": false
          }
        },
        {
          "nombre_campos": "capacidad",
          "type": "smallint",
          "parametros": {
            "not_null": false,
            "null": true,
            "identity": false,
            "nombre_primary": false
          }
        },
        {
          "nombre_campos": "descripcion",
          "type": "varchar",
          "parametros": {
            "not_null": false,
            "null": true,
            "identity": false,
            "nombre_primary": false
          }
        },
        {
          "nombre_campos": "color",
          "type": "varchar",
          "parametros": {
            "not_null": false,
            "null": true,
            "identity": false,
            "nombre_primary": false
          }
        },
        {
          "nombre_campos": "ubicacion",
          "type": "varchar",
          "parametros": {
            "not_null": false,
            "null": true,
            "identity": false,
            "nombre_primary": false
          }
        },
        {
          "nombre_campos": "estatusala",
          "type": "bit",
          "parametros": {
            "not_null": false,
            "null": true,
            "identity": false,
            "nombre_primary": false
          }
        },
        {
          "nombre_campos": "estadosala",
          "type": "char",
          "parametros": {
            "not_null": false,
            "null": true,
            "identity": false,
            "nombre_primary": false
          }
        },
        {
          "nombre_campos": "correo",
          "type": "char",
          "parametros": {
            "not_null": false,
            "null": true,
            "identity": false,
            "nombre_primary": false
          }
        },
        {
          "nombre_campos": "creadopor",
          "type": "smallint",
          "parametros": {
            "not_null": false,
            "null": true,
            "identity": false,
            "nombre_primary": false
          }
        },
        {
          "nombre_campos": "fechacreacion",
          "type": "datetime",
          "parametros": {
            "not_null": false,
            "null": true,
            "identity": false,
            "nombre_primary": false
          }
        },
        {
          "nombre_campos": "modificadopor",
          "type": "smallint",
          "parametros": {
            "not_null": false,
            "null": true,
            "identity": false,
            "nombre_primary": false
          }
        },
        {
          "nombre_campos": "fechamodificacion",
          "type": "datetime",
          "parametros": {
            "not_null": false,
            "null": true,
            "identity": false,
            "nombre_primary": false
          }
        },
        {
          "nombre_campos": "eliminadopor",
          "type": "smallint",
          "parametros": {
            "not_null": false,
            "null": true,
            "identity": false,
            "nombre_primary": false
          }
        },
        {
          "nombre_campos": "fechaeliminacion",
          "type": "datetime",
          "parametros": {
            "not_null": false,
            "null": true,
            "identity": false,
            "nombre_primary": false
          }
        }
      ]
    },
    {
      "tabla_name": "usuarios",
      "campos": [
        {
          "nombre_campos": "idusuario",
          "type": "bigint",
          "parametros": {
            "not_null": true,
            "null": false,
            "identity": true,
            "nombre_primary": true
          }
        },
        {
          "nombre_campos": "nombre",
          "type": "varchar",
          "parametros": {
            "not_null": false,
            "null": true,
            "identity": false,
            "nombre_primary": false
          }
        },
        {
          "nombre_campos": "password",
          "type": "varchar",
          "parametros": {
            "not_null": false,
            "null": true,
            "identity": false,
            "nombre_primary": false
          }
        },
        {
          "nombre_campos": "roles",
          "type": "varchar",
          "parametros": {
            "not_null": false,
            "null": true,
            "identity": false,
            "nombre_primary": false
          }
        },
        {
          "nombre_campos": "correo",
          "type": "varchar",
          "parametros": {
            "not_null": false,
            "null": true,
            "identity": false,
            "nombre_primary": false
          }
        },
        {
          "nombre_campos": "cargo",
          "type": "varchar",
          "parametros": {
            "not_null": false,
            "null": true,
            "identity": false,
            "nombre_primary": false
          }
        },
        {
          "nombre_campos": "departamento",
          "type": "varchar",
          "parametros": {
            "not_null": false,
            "null": true,
            "identity": false,
            "nombre_primary": false
          }
        },
        {
          "nombre_campos": "folio",
          "type": "int",
          "parametros": {
            "not_null": false,
            "null": true,
            "identity": false,
            "nombre_primary": false
          }
        }
      ]
    }
  ],
  "foreignKeys": [
    {
      "nombre_fk": "fk_asociarrequerimientos_reference_requerimientos",
      "campo_origen": "idrequerimiento",
      "tabla_origen": "asociarrequerimientos",
      "campo_referencia": "idrequerimiento",
      "tabla_referencia": "requerimientos"
    },
    {
      "nombre_fk": "fk_asociarrequerimientos_reference_salas",
      "campo_origen": "idsala",
      "tabla_origen": "asociarrequerimientos",
      "campo_referencia": "idsala",
      "tabla_referencia": "salas"
    },
    {
      "nombre_fk": "fk_asociarsalas_reference_salas",
      "campo_origen": "idsala",
      "tabla_origen": "asociarsalas",
      "campo_referencia": "idsala",
      "tabla_referencia": "salas"
    },
    {
      "nombre_fk": "fk_asociarsalas_reference_usuarios",
      "campo_origen": "idusuario",
      "tabla_origen": "asociarsalas",
      "campo_referencia": "idusuario",
      "tabla_referencia": "usuarios"
    },
    {
      "nombre_fk": "fk_comentarios_reference_reservaciones",
      "campo_origen": "idreservacion",
      "tabla_origen": "comentarios",
      "campo_referencia": "idreservacion",
      "tabla_referencia": "reservaciones"
    },
    {
      "nombre_fk": "fk_detallesreservaciones_reference_requerimientos",
      "campo_origen": "idrequerimiento",
      "tabla_origen": "detallesreservaciones",
      "campo_referencia": "idrequerimiento",
      "tabla_referencia": "requerimientos"
    },
    {
      "nombre_fk": "fk_detallesreservaciones_reference_reservaciones",
      "campo_origen": "idreservacion",
      "tabla_origen": "detallesreservaciones",
      "campo_referencia": "idreservacion",
      "tabla_referencia": "reservaciones"
    },
    {
      "nombre_fk": "fk_estatus_reference_reservaciones",
      "campo_origen": "idreservacion",
      "tabla_origen": "estatus",
      "campo_referencia": "idreservacion",
      "tabla_referencia": "reservaciones"
    },
    {
      "nombre_fk": "fk_reservaciones_reference_salas",
      "campo_origen": "idsala",
      "tabla_origen": "reservaciones",
      "campo_referencia": "idsala",
      "tabla_referencia": "salas"
    },
    {
      "nombre_fk": "fk_reservaciones_reference_usuarios",
      "campo_origen": "idusuario",
      "tabla_origen": "reservaciones",
      "campo_referencia": "idusuario",
      "tabla_referencia": "usuarios"
    }
  ]
}



const strings = []; 


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


btn_confirmarMySQL.addEventListener('click', function(){

    for (const tabla of base_datos.tables) {
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

    
    for (const fk of base_datos.foreignKeys) {
      const nombre_fk = fk.nombre_fk.toLowerCase();
      const campo_origen = fk.campo_origen;
      const tabla_origen = fk.tabla_origen;
      const tabla_referencia = fk.tabla_referencia;
      const campo_referencia = fk.campo_referencia;
      let string_fk = `ALTER TABLE ${tabla_origen} ADD CONSTRAINT ${nombre_fk} FOREIGN KEY (${campo_origen}) REFERENCES ${tabla_referencia} (${campo_referencia});`;
      strings.push(string_fk);
    }

    console.log(strings);

    const csrfToken = document.head.querySelector('meta[name="csrf-token"]').content;

    $.ajax({
        type: "POST",
        url: "/migrar-bd-mysql",
        headers: {
            'X-CSRF-TOKEN': csrfToken
        },
        data: { migradormysql: JSON.stringify(strings) },
        success: function (response) {
            console.log("Migración exitosa");
            console.log(response.strings);
        },
        error: function (xhr, status, error) {
            console.log("Error en la migración de la base de datos:", error);
        }
    });
});



  
  
  
  