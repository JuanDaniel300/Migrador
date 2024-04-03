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

        $database = 'prueba1';
        
        $tables = DB::select("SELECT t.name AS TABLE_NAME, c.name AS COLUMN_NAME, typ.name AS DATA_TYPE, c.is_nullable AS IS_NULLABLE
                              FROM $database.sys.tables AS t
                              JOIN $database.sys.columns AS c ON t.object_id = c.object_id
                              JOIN $database.sys.types AS typ ON c.system_type_id = typ.system_type_id
                              WHERE t.lob_data_space_id != 1
                              ORDER BY t.name DESC");

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
                    'not_null' => $row->IS_NULLABLE == 'NO' ? true : false,
                    'null' => $row->IS_NULLABLE == 'NO' ? false : true,
                    'ext' => 'Nothing'
                ]
            ];

            $baseDatosJson[count($baseDatosJson) - 1]['campos'][] = $campo;
        }

        $json_data = json_encode($baseDatosJson, JSON_PRETTY_PRINT);
        return $json_data;
    }
}
