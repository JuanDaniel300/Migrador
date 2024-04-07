<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MigradorController extends Controller
{

    public function mostrarDBSqlServer()
    {

        $databases = DB::select("SELECT name AS DATABASE_NAME
                                    FROM sys.databases
                                    WHERE state_desc = 'ONLINE'
                                        AND name NOT IN ('master', 'tempdb', 'model', 'msdb')
                                ");

        $tablesAndColumnsByDatabase = [];

        foreach ($databases as $database) {
            $databaseName = $database->DATABASE_NAME;

            $tablesAndColumns  = DB::select("SELECT t.name AS TABLE_NAME, c.name AS COLUMN_NAME, typ.name AS DATA_TYPE, c.is_nullable AS IS_NULLABLE
                                    FROM $databaseName.sys.tables AS t
                                    JOIN $databaseName.sys.columns AS c ON t.object_id = c.object_id
                                    JOIN $databaseName.sys.types AS typ ON c.system_type_id = typ.system_type_id
                                    WHERE t.lob_data_space_id != 1
                                    ORDER BY t.name DESC
                                ");

            foreach ($tablesAndColumns as $tableAndColumn) {
                $tableName = $tableAndColumn->TABLE_NAME;
                $tablesAndColumnsByDatabase[$databaseName][$tableName][] = $tableAndColumn;
            }
        }

        // $json_data = json_encode($tablesAndColumnsByDatabase, JSON_PRETTY_PRINT);
        // echo($json_data);
        // die();



        return view('migrador')->with('tablesAndColumnsByDatabase', $tablesAndColumnsByDatabase)->with('databaseName', $databases);
    }


    public function convertirJson()
    {

        $database = 'Roomie';

        $tables = DB::select("SELECT 
                                t.name AS TABLE_NAME, 
                                c.name AS COLUMN_NAME, 
                                typ.name AS DATA_TYPE, 
                                c.is_nullable AS IS_NULLABLE, 
                                c.is_identity AS IS_IDENTITY,
                                CASE 
                                    WHEN pk.name IS NOT NULL THEN pk.name
                                    ELSE '0'
                                END AS PRIMARY_KEY_CONSTRAINT_NAME
                            FROM 
                                $database.sys.tables AS t
                            JOIN 
                                $database.sys.columns AS c ON t.object_id = c.object_id
                            JOIN 
                                $database.sys.types AS typ ON c.system_type_id = typ.system_type_id
                            LEFT JOIN 
                                $database.sys.key_constraints AS pk ON t.object_id = pk.parent_object_id AND c.column_id = pk.unique_index_id AND pk.type = 'PK'
                            WHERE 
                                t.lob_data_space_id != 1
                            ORDER BY 
                                t.name DESC");

        $baseDatosJson = [];

        $currentTable = null;

        foreach ($tables as $row) {

            if ($row->TABLE_NAME !== $currentTable) {
                $currentTable = $row->TABLE_NAME;

                $tablaJson = [
                    'tabla_name' => $currentTable,
                    'campos' => []
                ];


                $baseDatosJson[] = $tablaJson;
            }

            $campo = [
                'nombre_campos' => $row->COLUMN_NAME,
                'type' => $row->DATA_TYPE,
                'parametros' => [
                    'not_null' => $row->IS_NULLABLE == 0 ? true : false,
                    'null' => $row->IS_NULLABLE == 0 ? false : true,
                    'identity' => $row->IS_IDENTITY,
                    'nombre_primary' => $row->PRIMARY_KEY_CONSTRAINT_NAME
                ]
            ];

            $baseDatosJson[count($baseDatosJson) - 1]['campos'][] = $campo;
        }

        $json_data = json_encode($baseDatosJson, JSON_PRETTY_PRINT);
        return $json_data;
    }


    public function ejecutarConsulta()
    {
        try {
            $database = 'Roomie';


            $resultados = DB::select('SELECT * FROM Acuerdos');

            $tablaHtml = '<table border="1">';
            $tablaHtml .= '<thead><tr>';

            foreach ($resultados[0] as $columna => $valor) {
                $tablaHtml .= '<th>' . $columna . '</th>';
            }

            $tablaHtml .= '</tr></thead>';
            $tablaHtml .= '<tbody>';

            foreach ($resultados as $fila) {
                $tablaHtml .= '<tr>';

                foreach ($fila as $valor) {
                    $tablaHtml .= '<td>' . $valor . '</td>';
                }

                $tablaHtml .= '</tr>';
            }

            $tablaHtml .= '</tbody></table>';

            return response()->json(['tablaHtml' => $tablaHtml]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }
}
