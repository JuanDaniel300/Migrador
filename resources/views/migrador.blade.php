<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Migrador</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="{{asset('/css/estilosMigrador.css')}}">
</head>
<body class="bg-[#156082]">
    <header class="bg-white">
        <nav class="mx-auto flex max-w-7xl items-center justify-between p-6 lg:px-8" aria-label="Global">
            <div class="flex lg:flex-1">
                <a href="#" class="-m-2.5 p-2.5">
                    <span class="sr-only">logoMigrador</span>
                    <img class="h-12 w-auto" src="{{asset('/images/logo_migrador.png')}}" alt="">
                </a>
            </div>
            <div class="hidden lg:flex lg:flex-1 lg:justify-end">
                <button class="bg-[#595959] hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full">Migrate</button>
            </div>
        </nav>
    </header>
    <div  class="container mx-auto mt-5">
        <div class="grid grid-cols-6 gap-4 mt-2">
            {{------------------------------------------------------------------------------------------}}
            {{--                    Aparatado de las base de dato SQL SERVER                          --}}
            {{------------------------------------------------------------------------------------------}}
            <div class="col-span-6 py-5">
                <button class="bg-[#595959] hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full" id="AgregarNuevaConsultaSqlServer">New Query</button>
                <button class="bg-[#FF9900] hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full">Execute</button>
                <select id="database" class="bg-gray-50 border border-gray-300 py-2 px-4 text-gray-900 rounded-lg">
                    <option selected>Database</option>
                    <option value="Database_#1">Database #1</option>
                    <option value="Database_#2">Database #2</option>
                    <option value="Database_#3">Database #3</option>
                </select>
            </div>

            <div class="col-span-2 bg-white seccion#2">
                <div class="flex items-center justify-between mx-2">
                    <header class="p-2 font-bold">SqlServer</header>
                    <div class="flex items-center space-x-2">
                        <i>connected</i>
                        <div class="w-5 h-5 bg-[#4EA72E] rounded-full"></div>
                    </div>
                </div>
                
                
                <details class="border-2 p-4 [&_svg]:open:-rotate-180">
                    <summary class="flex cursor-pointer list-none items-center gap-4">
                    <div>
                        <svg class="rotate-0 transform text-blue-700 transition-all duration-300" fill="none" height="20" width="20" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24">
                        <polyline points="6 9 12 15 18 9"></polyline>
                        </svg>
                    </div>
                    <div>Database #1</div>
                    </summary>
                    <p>Table #1</p>
                    <p>Table #2</p>
                    <p>Table #3</p>
                </details>
                <details class="border-2 p-4 [&_svg]:open:-rotate-180">
                    <summary class="flex cursor-pointer list-none items-center gap-4">
                    <div>
                        <svg class="rotate-0 transform text-blue-700 transition-all duration-300" fill="none" height="20" width="20" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24">
                        <polyline points="6 9 12 15 18 9"></polyline>
                        </svg>
                    </div>
                    <div>Database #2</div>
                    </summary>
                    <p>Table #1</p>
                    <p>Table #2</p>
                    <p>Table #3</p>
                </details>
                <details class="border-2 p-4 [&_svg]:open:-rotate-180">
                    <summary class="flex cursor-pointer list-none items-center gap-4">
                    <div>
                        <svg class="rotate-0 transform text-blue-700 transition-all duration-300" fill="none" height="20" width="20" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24">
                        <polyline points="6 9 12 15 18 9"></polyline>
                        </svg>
                    </div>
                    <div>Database #2</div>
                    </summary>
                    <p>Table #1</p>
                    <p>Table #2</p>
                    <p>Table #3</p>
                </details>
            </div>

            <div class="col-span-4">
                <ul class="flex flex-wrap -mb-px text-sm font-medium text-center" id="pestanasSqlServer"></ul>
                <div id="consultasSqlServer"></div>
            </div>


            <hr class="mt-5 col-span-6 h-1 border-4">

            {{------------------------------------------------------------------------------------------}}
            {{--                    Aparatado de las base de dato MySql                               --}}
            {{------------------------------------------------------------------------------------------}}

            <div class="col-span-6 py-5">
                <button class="bg-[#595959] hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full" id="AgregarNuevaConsultaMySql">New Query</button>
                <button class="bg-[#FF9900] hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full">Execute</button>
                <select id="database" class="bg-gray-50 border border-gray-300 py-2 px-4 text-gray-900 rounded-lg">
                    <option selected>Database</option>
                    <option value="Database_#1">Database #1</option>
                    <option value="Database_#2">Database #2</option>
                    <option value="Database_#3">Database #3</option>
                </select>
            </div>

            <div class="col-span-2 bg-white">
                <div class="flex items-center justify-between mx-2">
                    <header class="p-2 font-bold">SqlServer</header>
                    <div class="flex items-center space-x-2">
                        <button class="bg-blue-500 hover:bg-blue-700 py-1 px-3 rounded-full">Connect</button>
                        <i>Disconnected</i>
                        <div class="w-5 h-5 bg-[#FF0000] rounded-full"></div>
                    </div>
                </div>
                
                
                <details class="border-2 p-4 [&_svg]:open:-rotate-180">
                    <summary class="flex cursor-pointer list-none items-center gap-4">
                    <div>
                        <svg class="rotate-0 transform text-blue-700 transition-all duration-300" fill="none" height="20" width="20" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24">
                        <polyline points="6 9 12 15 18 9"></polyline>
                        </svg>
                    </div>
                    <div>Database #1</div>
                    </summary>
                    <p>Table #1</p>
                    <p>Table #2</p>
                    <p>Table #3</p>
                </details>
                <details class="border-2 p-4 [&_svg]:open:-rotate-180">
                    <summary class="flex cursor-pointer list-none items-center gap-4">
                    <div>
                        <svg class="rotate-0 transform text-blue-700 transition-all duration-300" fill="none" height="20" width="20" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24">
                        <polyline points="6 9 12 15 18 9"></polyline>
                        </svg>
                    </div>
                    <div>Database #2</div>
                    </summary>
                    <p>Table #1</p>
                    <p>Table #2</p>
                    <p>Table #3</p>
                </details>
                <details class="border-2 p-4 [&_svg]:open:-rotate-180">
                    <summary class="flex cursor-pointer list-none items-center gap-4">
                    <div>
                        <svg class="rotate-0 transform text-blue-700 transition-all duration-300" fill="none" height="20" width="20" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24">
                        <polyline points="6 9 12 15 18 9"></polyline>
                        </svg>
                    </div>
                    <div>Database #2</div>
                    </summary>
                    <p>Table #1</p>
                    <p>Table #2</p>
                    <p>Table #3</p>
                </details>
            </div>

            <div class="col-span-4">
                <ul class="flex flex-wrap -mb-px text-sm font-medium text-center" id="pestanasMySql"></ul>
                <div id="consultasMySql"></div>
            </div>

            <hr class="mt-5 col-span-6 h-1 border-4">

            <div class="col-span-6 bg-white mb-3 mt-5">
                <header class="p-2 font-bold border-2 border-black">Output</header>
                <textarea class="border-2 border-black" rows="10" readonly style="width: 100%"></textarea>
            </div>
        </div>
    </div>
    <script src="{{asset('/js/nuevaConsultaSqlServer.js')}}"></script>
    <script src="{{asset('/js/nuevaConsultaMySql.js')}}"></script>
</body>
</body>
</html>