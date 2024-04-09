<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MysqlController extends Controller
{
    public function obtenerSchemaDatabase()
    {

        $database = "prueba1";

        $query = "
        SELECT 
            c.TABLE_NAME,
            c.COLUMN_NAME,
            c.DATA_TYPE,
            c.IS_NULLABLE,
            c.COLUMN_KEY,
            CASE 
                WHEN kcu.COLUMN_NAME IS NOT NULL THEN 'YES' 
                ELSE 'NO' 
            END AS HAS_FOREIGN_KEY,
            kcu.REFERENCED_TABLE_NAME AS REFERENCED_TABLE,
            kcu.REFERENCED_COLUMN_NAME AS REFERENCED_COLUMN
        FROM 
            INFORMATION_SCHEMA.COLUMNS c
        LEFT JOIN 
            INFORMATION_SCHEMA.KEY_COLUMN_USAGE kcu 
        ON 
            c.TABLE_SCHEMA = kcu.TABLE_SCHEMA
        AND 
            c.TABLE_NAME = kcu.TABLE_NAME
        AND 
            c.COLUMN_NAME = kcu.COLUMN_NAME
        WHERE 
            c.TABLE_SCHEMA = ?
        ORDER BY 
            c.TABLE_NAME, c.ORDINAL_POSITION;
        ";

        $exec = DB::select($query, [$database]);

        $json_data = $this->formatJson($exec);

        dump($json_data);
        die();

        return response()->json([
            "code" => "200",
            "mensaje" => "Base de datos extraida con exito",
            "data" => $json_data
        ], 200);
    }

    public function formatJson($tables)
    {
        $baseDatosJson = [];
        $currentTable = null;

        foreach ($tables as $row) {

            if ($row->TABLE_NAME !== $currentTable) {
                $currentTable = $row->TABLE_NAME;

                $tablaJson = [
                    'tabla_name' => $currentTable,
                    'campos' => [],
                    'foreignKey' => []
                ];

                $baseDatosJson[] = $tablaJson;
            }

            $campo = [
                'nombre_campos' => $row->COLUMN_NAME,
                'type' => $row->DATA_TYPE,
                'parametros' => [
                    'not_null' => $row->IS_NULLABLE == 'NO' ? true : false,
                    'null' => $row->IS_NULLABLE == 'NO' ? false : true,
                    'primary_key' => ($row->COLUMN_KEY == 'PRI') ? true : false
                ]
            ];

            $baseDatosJson[count($baseDatosJson) - 1]['campos'][] = $campo;

            if ($row->HAS_FOREIGN_KEY == 'YES') {
                $foreignKey = [
                    'nombre' => "fk_" . $row->TABLE_NAME . "_" . $row->COLUMN_NAME,
                    'campo' => $row->COLUMN_NAME,
                    'tabla' => $row->REFERENCED_TABLE,
                    'tabla_campo' => $row->REFERENCED_COLUMN
                ];

                $baseDatosJson[count($baseDatosJson) - 1]['foreignKey'][] = $foreignKey;
            }
        }

        $json_data = json_encode($baseDatosJson, JSON_PRETTY_PRINT);
        return $json_data;
    }
}
