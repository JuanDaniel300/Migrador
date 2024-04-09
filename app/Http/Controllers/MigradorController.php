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
                                            WHERE t.name != 'sysdiagrams' AND typ.name != 'sysname'
                                            ORDER BY 
                                                s.name DESC, t.name DESC        
                                ");
            
            foreach ($tablesAndColumns as $tableAndColumn) {
                $tableName = $tableAndColumn->TABLE_NAME_WITH_SCHEMA_NAME;
                $tablesAndColumnsByDatabase[$databaseName][$tableName][] = $tableAndColumn;
                
            }
        }


        return [
            'databases' => $databases,
            'tablesAndColumnsByDatabase' => $tablesAndColumnsByDatabase
        ];
        
    }

    public function convertirJsonSqlServer(request $request)
    {
        $database = $request->input('escogerBDSqlServer');
        
        try {
            
            DB::connection('sqlsrv')->statement("USE $database");
            
            $tablesSqlServer = DB::connection('sqlsrv')->select("SELECT 
                                    t.name AS TABLE_NAME_SQLSERVER, 
                                    c.name AS COLUMN_NAME_SQLSERVER, 
                                    typ.name AS DATA_TYPE_SQLSERVER, 
                                    c.is_nullable AS IS_NULLABLE_SQLSERVER, 
                                    c.is_identity AS IS_IDENTITY_SQLSERVER,
                                    CASE 
                                        WHEN pk.name IS NOT NULL THEN pk.name
                                        ELSE '0'
                                    END AS PRIMARY_KEY_CONSTRAINT_NAME_SQLSERVER
                                FROM 
                                    $database.sys.tables AS t
                                JOIN 
                                    $database.sys.columns AS c ON t.object_id = c.object_id
                                JOIN 
                                    $database.sys.types AS typ ON c.system_type_id = typ.system_type_id
                                LEFT JOIN 
                                    $database.sys.key_constraints AS pk ON t.object_id = pk.parent_object_id AND c.column_id = pk.unique_index_id AND pk.type = 'PK'
                                WHERE t.name != 'sysdiagrams' AND typ.name != 'sysname'
                                ORDER BY 
                                    t.name DESC");


            $foreign_keys_SqlServer = DB::connection('sqlsrv')->select("SELECT 
                                    fk.name AS FOREIGN_KEY_CONSTRAINT_NAME,
                                    OBJECT_NAME(fkc.parent_object_id) AS SOURCE_TABLE_NAME,
                                    COL_NAME(fkc.parent_object_id, fkc.parent_column_id) AS SOURCE_COLUMN_NAME,
                                    OBJECT_NAME(fkc.referenced_object_id) AS REFERENCED_TABLE_NAME,
                                    COL_NAME(fkc.referenced_object_id, fkc.referenced_column_id) AS REFERENCED_COLUMN_NAME
                                FROM 
                                    $database.sys.foreign_keys AS fk
                                JOIN 
                                    $database.sys.foreign_key_columns AS fkc ON fk.object_id = fkc.constraint_object_id");
        
            
            $tablesJsonSqlServer = [];
            $currentTableSqlServer = null;
            
            foreach ($tablesSqlServer as $rowSqlServer) {
                if ($rowSqlServer->TABLE_NAME_SQLSERVER !== $currentTableSqlServer) {
                    $currentTableSqlServer = $rowSqlServer->TABLE_NAME_SQLSERVER;
                    $tablaJsonSqlServer = [
                        'tabla_name' => $currentTableSqlServer,
                        'campos' => []
                    ];
                    $tablesJsonSqlServer[] = $tablaJsonSqlServer;
                }

                $type = $rowSqlServer->DATA_TYPE_SQLSERVER;

                if ($type === 'nvarchar') {
                    $type = 'varchar(255)';
                }

                $campoSqlServer = [
                    'nombre_campos' => $rowSqlServer->COLUMN_NAME_SQLSERVER,
                    'type' => $type,
                    'parametros' => [
                        'not_null' => $rowSqlServer->IS_NULLABLE_SQLSERVER == 0 ? true : false,
                        'null' => $rowSqlServer->IS_NULLABLE_SQLSERVER == 0 ? false : true,
                        'identity' => $rowSqlServer->IS_IDENTITY_SQLSERVER == 0 ? false : true,
                        'nombre_primary' => $rowSqlServer->PRIMARY_KEY_CONSTRAINT_NAME_SQLSERVER
                    ]
                ];
                $tablesJsonSqlServer[count($tablesJsonSqlServer) - 1]['campos'][] = $campoSqlServer;
            }
        
            $foreignKeysJsonSqlServer = [];
            foreach ($foreign_keys_SqlServer as $fk_SqlServer) {
                $foreignKeysJsonSqlServer[] = [
                    'nombre_fk' => $fk_SqlServer->FOREIGN_KEY_CONSTRAINT_NAME,
                    'campo_origen' => $fk_SqlServer->SOURCE_COLUMN_NAME,
                    'tabla_origen' => $fk_SqlServer->SOURCE_TABLE_NAME,
                    'campo_referencia' => $fk_SqlServer->REFERENCED_COLUMN_NAME,
                    'tabla_referencia' => $fk_SqlServer->REFERENCED_TABLE_NAME
                ];
            }
        
            $jsonArray = [
                'tables' => $tablesJsonSqlServer,
                'foreignKeys' => $foreignKeysJsonSqlServer
            ];

            return response()->json(['success' => true, 'data' => $jsonArray], 200);
            
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Error en la migración de la base de datos'], 500);
        }
    }

    public function migrarBDSqlServer(request $request)
    {
        $database = $request->input('database');
        $strings = json_decode($request->input('migrador'));

        try {

            DB::connection('mysql')->statement("CREATE DATABASE $database");

            DB::connection('mysql')->statement("USE $database");

            foreach ($strings as $string) {
                DB::connection('mysql')->statement("$string");
            }

            return response()->json(['strings' => $strings]);

        } catch (\Exception $e) {

            return response()->json(['error' => 'Error interno del servidor'], 500);
        }
    }
    
    public function ejecutarConsultaSqlServer($database, $consulta)
    {
        try {
            DB::connection('sqlsrv')->statement("USE $database");
    
            $resultados = DB::connection('sqlsrv')->select($consulta);
    
            $columnas = !empty($resultados) ? array_keys((array) $resultados[0]) : [];
    
            $tablaHtml = '<table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">';
            $tablaHtml .= '<thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400" style="position: sticky; top: 0; z-index: 10; height: 50px;">';
            $tablaHtml .= '<tr>';
    
            foreach ($columnas as $columna) {
                $tablaHtml .= '<th class="px-6 py-3">' . $columna . '</th>';
            }
    
            $tablaHtml .= '</tr></thead>';
    
            $tablaHtml .= '<tbody>';
    
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
    
            return response()->json(['tablaHtml' => $tablaHtml]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }
    
    public function mostrarDBMySQL()
    {

        $exclude_databases = ["information_schema", "mysql", "performance_schema", "sys"];


        $mysql = "SELECT `SCHEMA_NAME` AS SCHEMA_NAME2 FROM information_schema.schemata WHERE `SCHEMA_NAME` NOT IN ('" . implode("','", $exclude_databases) . "')";

    
        $databases2 = DB::connection('mysql')->select($mysql);


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

    public function convertirJsonMySql(request $request)
    {

        $database = $request->input('escogerBDMySql');

        try {

            $tablasMySql = DB::connection('mysql')->select("
                    SELECT 
                    c.TABLE_NAME,
                    c.COLUMN_NAME,
                    c.DATA_TYPE,
                    c.IS_NULLABLE,
                    c.COLUMN_KEY,
                    CASE 
                        WHEN c.EXTRA = 'auto_increment' THEN 'YES' 
                        ELSE 'NO' 
                    END AS IS_AUTO_INCREMENT
                FROM 
                    INFORMATION_SCHEMA.COLUMNS c
                WHERE 
                    c.TABLE_SCHEMA = ?
                ORDER BY 
                    c.TABLE_NAME, c.ORDINAL_POSITION;
                ", [$database]);

                
            $foreign_keys_MySql = DB::connection('mysql')->select("       
                    SELECT 
                    fk.CONSTRAINT_NAME AS FOREIGN_KEY_CONSTRAINT_NAME,
                    fk.COLUMN_NAME AS SOURCE_COLUMN_NAME,
                    fk.TABLE_NAME AS SOURCE_TABLE_NAME,
                    fk.REFERENCED_COLUMN_NAME AS REFERENCED_COLUMN_NAME,
                    fk.REFERENCED_TABLE_NAME AS REFERENCED_TABLE_NAME
                FROM 
                    INFORMATION_SCHEMA.KEY_COLUMN_USAGE fk
                WHERE 
                    fk.TABLE_SCHEMA = ?
                    AND
                    fk.CONSTRAINT_NAME <> 'PRIMARY'
                ORDER BY 
                    fk.TABLE_NAME;
                ", [$database]);


            $tablasJsonMySql = [];
            $currentTableMySql = null;

            foreach ($tablasMySql as $rowMySql) {
                if ($rowMySql->TABLE_NAME !== $currentTableMySql) {
                    $currentTableMySql = $rowMySql->TABLE_NAME;
                    $tablaJsonMySql = [
                        'tabla_name' => $currentTableMySql,
                        'campos' => []
                    ];
                    $tablasJsonMySql[] = $tablaJsonMySql;
                }

                $type = $rowMySql->DATA_TYPE;
                if ($type === 'enum') {
                    $type = 'bit';
                }

                $campoSqlServer = [
                    'nombre_campos' => $rowMySql->COLUMN_NAME,
                    'type' => $type,
                    'parametros' => [
                        'not_null' => $rowMySql->IS_NULLABLE == 'NO' ? true : false,
                        'null' => $rowMySql->IS_NULLABLE == 'NO' ? false : true,
                        'identity' => $rowMySql->IS_AUTO_INCREMENT == 'YES' ? true : false,
                        'nombre_primary' => ($rowMySql->COLUMN_KEY == 'PRI') ? true : false
                    ]
                ];
                $tablasJsonMySql[count($tablasJsonMySql) - 1]['campos'][] = $campoSqlServer;
            }

            $foreignKeysJsonMySql = [];
            foreach ($foreign_keys_MySql as $fk_MySql) {
                $foreignKeysJsonMySql[] = [
                    'nombre_fk' => $fk_MySql->FOREIGN_KEY_CONSTRAINT_NAME,
                    'campo_origen' => $fk_MySql->SOURCE_COLUMN_NAME,
                    'tabla_origen' => $fk_MySql->SOURCE_TABLE_NAME,
                    'campo_referencia' => $fk_MySql->REFERENCED_COLUMN_NAME,
                    'tabla_referencia' => $fk_MySql->REFERENCED_TABLE_NAME
                ];
            }


            $jsonArray = [
                'tables' => $tablasJsonMySql,
                'foreignKeys' => $foreignKeysJsonMySql
            ];


            return response()->json(['success' => true, 'data' => $jsonArray], 200);
            
        } catch (\Exception $e) {

            return response()->json(['success' => false, 'message' => 'Error en la migración de la base de datos'], 500);
        }
    }

    public function migrarBDMySql(request $request)
    {

        $database = $request->input('database');
        $strings = json_decode($request->input('migrador'));

        try {

            DB::connection('sqlsrv')->statement("CREATE DATABASE $database");

            DB::connection('sqlsrv')->statement("USE $database");

            foreach ($strings as $string) {
                DB::connection('sqlsrv')->statement("$string");
            }

            return response()->json(['strings' => $strings]);

        } catch (\Exception $e) {

            return response()->json(['error' => 'Error interno del servidor'], 500);
        }
    }

    public function ejecutarConsultaMySql($database, $consulta)
    {
        try {
            DB::connection('mysql')->statement("USE $database");
    
            $resultados = DB::connection('mysql')->select($consulta);
    
            $columnas = !empty($resultados) ? array_keys((array) $resultados[0]) : [];
    
            $tablaHtml = '<table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">';
            $tablaHtml .= '<thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400" style="position: sticky; top: 0; z-index: 10; height: 50px;">';
            $tablaHtml .= '<tr>';
    
            foreach ($columnas as $columna) {
                $tablaHtml .= '<th class="px-6 py-3">' . $columna . '</th>';
            }
    
            $tablaHtml .= '</tr></thead>';
    
            $tablaHtml .= '<tbody>';
    
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
    
            return response()->json(['tablaHtml' => $tablaHtml]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }

}