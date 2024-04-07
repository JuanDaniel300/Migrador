<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MigradorController extends Controller
{
    public function mostrarVista()
    {

        $resultadosSqlServer = $this->mostrarDBSqlServer();

        $databases  = $resultadosSqlServer['databases'];
        $tablesAndColumnsByDatabase = $resultadosSqlServer['tablesAndColumnsByDatabase'];


        $resultadosMySQL = $this->mostrarDBMySQL();

        $databases2  = $resultadosMySQL['databases2'];
        $tablesAndColumnsByDatabase2 = $resultadosMySQL['tablesAndColumnsByDatabase2'];

        
        return view('migrador', compact('tablesAndColumnsByDatabase', 'databases', 'tablesAndColumnsByDatabase2', 'databases2'));
    }

    public function mostrarDBSqlServer()
    {

        $databases = DB::connection('sqlsrv')->select("SELECT name AS DATABASE_NAME
                                    FROM sys.databases
                                    WHERE state_desc = 'ONLINE'
                                        AND name NOT IN ('master', 'tempdb', 'model', 'msdb')
                                ");

        $tablesAndColumnsByDatabase = [];

        foreach ($databases as $database) {
            $databaseName = $database->DATABASE_NAME;
<<<<<<< Updated upstream

            $tablesAndColumns  = DB::select("SELECT t.name AS TABLE_NAME, c.name AS COLUMN_NAME, typ.name AS DATA_TYPE, c.is_nullable AS IS_NULLABLE
                                    FROM $databaseName.sys.tables AS t
                                    JOIN $databaseName.sys.columns AS c ON t.object_id = c.object_id
                                    JOIN $databaseName.sys.types AS typ ON c.system_type_id = typ.system_type_id
                                    WHERE t.lob_data_space_id != 1
                                    ORDER BY t.name DESC
=======
        
            $tablesAndColumns  = DB::connection('sqlsrv')->select("SELECT 
                                                s.name AS SCHEMA_NAME,
                                                t.name AS TABLE_NAME, 
                                                c.name AS COLUMN_NAME, 
                                                typ.name AS DATA_TYPE, 
                                                CASE WHEN c.is_nullable = 1 THEN 'YES' ELSE 'NO' END AS IS_NULLABLE,
                                                s.name +'.'+ t.name AS TABLE_NAME_WITH_SCHEMA_NAME
                                            FROM $databaseName.sys.schemas AS s
                                            INNER JOIN $databaseName.sys.tables AS t ON s.schema_id = t.schema_id
                                            INNER JOIN $databaseName.sys.columns AS c ON t.object_id = c.object_id
                                            INNER JOIN $databaseName.sys.types AS typ ON c.system_type_id = typ.system_type_id
                                            ORDER BY 
                                                s.name DESC, t.name DESC        
>>>>>>> Stashed changes
                                ");

            foreach ($tablesAndColumns as $tableAndColumn) {
                $tableName = $tableAndColumn->TABLE_NAME_WITH_SCHEMA_NAME;
                $tablesAndColumnsByDatabase[$databaseName][$tableName][] = $tableAndColumn;
                
            }
        }


<<<<<<< Updated upstream


        return view('migrador')->with('tablesAndColumnsByDatabase', $tablesAndColumnsByDatabase)->with('databaseName', $databases);
=======
        return [
            'databases' => $databases,
            'tablesAndColumnsByDatabase' => $tablesAndColumnsByDatabase
        ];
        
>>>>>>> Stashed changes
    }

    public function convertirJson()
    {

<<<<<<< Updated upstream
        $database = 'Roomie';

        $tables = DB::select("SELECT 
=======
        $database = 'Prueba1';

        DB::connection('sqlsrv')->statement("USE $database");
        
        $tables = DB::connection('sqlsrv')->select("SELECT 
>>>>>>> Stashed changes
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

        $foreign_keys = DB::connection('sqlsrv')->select("SELECT 
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
                    'identity' => $row->IS_IDENTITY == 0 ? false : true,
                    'nombre_primary' => $row->PRIMARY_KEY_CONSTRAINT_NAME
                ]
            ];

            $baseDatosJson[count($baseDatosJson) - 1]['campos'][] = $campo;
        }

        $json_data = json_encode($baseDatosJson, JSON_PRETTY_PRINT);
        echo($json_data);
        die();
        return $json_data;
    }

    public function ejecutarConsulta($database, $consulta)
    {
        try {
<<<<<<< Updated upstream
            $database = 'Roomie';


            $resultados = DB::select('SELECT * FROM Acuerdos');

            $tablaHtml = '<table border="1">';
            $tablaHtml .= '<thead><tr>';

            foreach ($resultados[0] as $columna => $valor) {
                $tablaHtml .= '<th>' . $columna . '</th>';
            }

=======
            DB::connection('sqlsrv')->statement("USE $database");
    
            $resultados = DB::connection('sqlsrv')->select($consulta);
    
            $columnas = !empty($resultados) ? array_keys((array) $resultados[0]) : [];
    
            $tablaHtml = '<table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">';
            $tablaHtml .= '<thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400" style="position: sticky; top: 0; z-index: 10; height: 50px;">';
            $tablaHtml .= '<tr>';
    
            foreach ($columnas as $columna) {
                $tablaHtml .= '<th class="px-6 py-3">' . $columna . '</th>';
            }
    
>>>>>>> Stashed changes
            $tablaHtml .= '</tr></thead>';
    
            $tablaHtml .= '<tbody>';
<<<<<<< Updated upstream

            foreach ($resultados as $fila) {
                $tablaHtml .= '<tr>';

                foreach ($fila as $valor) {
                    $tablaHtml .= '<td>' . $valor . '</td>';
                }

                $tablaHtml .= '</tr>';
            }

            $tablaHtml .= '</tbody></table>';

=======
    
            if (empty($resultados)) {
                $tablaHtml .= '<tr><td colspan="' . count($columnas) . '">La tabla está vacía.</td></tr>';
            } else {
                foreach ($resultados as $fila) {
                    $tablaHtml .= '<tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">';
    
                    foreach ($fila as $valor) {
                        $tablaHtml .= '<td class="px-6 py-4">' . $valor . '</td>';
                    }
    
                    $tablaHtml .= '</tr>';
                }
            }
    
            $tablaHtml .= '</tbody>';
            $tablaHtml .= '</table>';
    
>>>>>>> Stashed changes
            return response()->json(['tablaHtml' => $tablaHtml]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }
<<<<<<< Updated upstream
=======
    
    public function mostrarDBMySQL()
    {

        $exclude_databases = ["information_schema", "mysql", "performance_schema", "sys"];


        $sql = "SELECT `SCHEMA_NAME` AS SCHEMA_NAME2 FROM information_schema.schemata WHERE `SCHEMA_NAME` NOT IN ('" . implode("','", $exclude_databases) . "')";

    
        $databases2 = DB::connection('mysql')->select($sql);


        $tablesAndColumnsByDatabase2 = [];

        foreach ($databases2 as $database) {
            $databaseName2 = $database->SCHEMA_NAME2;


            $tablesAndColumns2 = DB::connection('mysql')->select("SELECT 
                                                TABLE_SCHEMA AS SCHEMA_NAME2,
                                                TABLE_NAME AS TABLE_NAME2, 
                                                COLUMN_NAME AS COLUMN_NAME2, 
                                                DATA_TYPE AS DATA_TYPE2, 
                                                IS_NULLABLE
                                            FROM information_schema.columns 
                                            WHERE TABLE_SCHEMA = '$databaseName2'
                                            ORDER BY TABLE_NAME ASC");

            foreach ($tablesAndColumns2 as $tableAndColumn2) {
                $tableName2 = $tableAndColumn2->TABLE_NAME2;
                $tablesAndColumnsByDatabase2[$databaseName2][$tableName2][] = $tableAndColumn2;
            }

        }

        return [
            'databases2' => $databases2,
            'tablesAndColumnsByDatabase2' => $tablesAndColumnsByDatabase2
        ];
    }

    
    
>>>>>>> Stashed changes
}
