<x-home-layout>
    <div class="bg-white dark:bg-gray-900 pt-14 min-h-screen ">

        <div class="flex flex-col p-2 py-6 m-h-screen max-w-screen-lg px-4 mx-auto lg:grid-cols-12 ">

            <div class="bg-white dark:bg-gray-700 items-center justify-between w-full flex rounded-full shadow-md p-2 mb-5">
                <input class="font-bold rounded-full w-full py-4 pl-4 text-gray-700 bg-gray-100 dark:bg-gray-600 dark:text-gray-200 leading-tight focus:outline-none focus:shadow-outline lg:text-sm text-xs" type="text" placeholder="Search">
                <div class="bg-gray-600 p-2 hover:bg-blue-400 cursor-pointer mx-2 rounded-full">
                    <svg class="w-6 h-6 text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                    </svg>
                </div>
            </div>

            <div class="pt-5 flex justify-between wrapper items-center">
                <div class="px-3">
                    <div class="lg:text-2xl md:text-xl text-lg lg:pt-3 p-1 font-black text-gray-300">Search Results </div>
                    <div class="lg:text-lg md:text-lg text-sm lg:pt-1 p-1 font-black text-gray-500">500 results </div>
                </div>
                <div>
                    <a href="/askQuestion" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                        Ask Question
                    </a>

                </div>
            </div>
            <div class="flex flex-col items-center gap-4 lg:p-4 p-2 rounde-lg m-2 ">
                <div class="bg-gray-50 dark:bg-gray-800 border-gray-500 flex items-center justify-between w-full p-2  hover:bg-gray-100 cursor-pointer border rounded-lg max-w-screen-md">
                    <div class="lg:flex md:flex items-center flex">
                        <div class="h-12 w-12 bg-gray-600 shrink-0 mb-2 lg:mb-0 border md:mb-0 rounded-full mr-3 flex items-center font-bold justify-center text-black dark:text-gray-300">
                            1234
                        </div>
                        <div class="flex flex-col text-gray-500 dark:text-gray-400">
                            <div class="text-sm leading-3 text-gray-900 dark:text-white font-bold w-full pb-3 ">
                                Club de Tenis de Concepcion
                            </div>
                            <div class="flex gap-1 pb-2">
                                <span class="bg-blue-100 text-blue-800 text-xs font-medium inline-flex items-center px-2.5 py-0.5  dark:bg-gray-700 dark:text-blue-400 border border-blue-400 rounded-full">PHP</span>

                                <div class="bg-blue-100 text-blue-800 text-xs font-medium inline-flex items-center px-2.5 py-0.5  dark:bg-gray-700 dark:text-orange-400 border border-orange-400 rounded-full">Javascript</div>
                            </div>
                            <div class="font-light text-sm text-gray-500 w-full">
                                Av. veteranos del 93, Parque ecuador, Concepcion.
                            </div>
                        </div>
                    </div>
                    <svg class="text-gray-200 w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M11.25 4.5l7.5 7.5-7.5 7.5m-6-15l7.5 7.5-7.5 7.5" />
                    </svg>
                </div>

            </div>

        </div>

    </div>
</x-home-layout>
