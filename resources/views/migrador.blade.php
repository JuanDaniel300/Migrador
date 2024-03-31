<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Migrador</title>
    <link rel="stylesheet" href="{{asset('/css/estilosMigrador.css')}}">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
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
        
    <button data-modal-target="static-modal" data-modal-toggle="static-modal" class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">
        Toggle modal
    </button>
  

    <div id="static-modal" data-modal-backdrop="static" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-2xl max-h-full">

            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">

                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                        Static modal
                    </h3>
                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="static-modal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <div class="p-4 md:p-5 space-y-4">
                    <p class="text-base leading-relaxed text-gray-500 dark:text-gray-400">
                        With less than a month to go before the European Union enacts new consumer privacy laws for its citizens, companies around the world are updating their terms of service agreements to comply.
                    </p>
                    <p class="text-base leading-relaxed text-gray-500 dark:text-gray-400">
                        The European Union’s General Data Protection Regulation an Union. It requires that could personally affect them.
                    </p>
                </div>
                <!-- Modal footer -->
                <div class="flex items-center p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                    <button data-modal-hide="static-modal" type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">I accept</button>
                    <button data-modal-hide="static-modal" type="button" class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Decline</button>
                </div>
            </div>
        </div>
    </div>
  
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

            <div class="col-span-2 bg-white">
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