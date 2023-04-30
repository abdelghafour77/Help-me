<x-dashboard-layout>
    <x-slot name="title">{{ __('Dashboard') }}</x-slot>
    <div class="px-4 pt-4 min-h-screen">

        <div class="pb-4 grid w-full grid-cols-1 gap-4 mt-4 xl:grid-cols-2 2xl:grid-cols-3">
            <div class="items-center justify-between p-4 bg-white border border-gray-200 rounded-lg shadow-sm sm:flex dark:border-gray-700 sm:p-6 dark:bg-gray-800">
                <div class="w-full">
                    <h3 class="text-3xl font-normal text-gray-500 dark:text-gray-400">{{ __('New questions') }}</h3>
                    <span class="text-2xl font-bold leading-none text-gray-900 sm:text-3xl dark:text-white">{{ $questionsCount }}</span>
                    <p class="flex items-center text-base font-normal text-gray-500 dark:text-gray-400">
                        <span class="flex items-center mr-1.5 text-lg {{ $percentageQuestionsChange <= 0 ? 'text-red-500 dark:text-red-400' : 'text-green-500 dark:text-green-400' }}">
                            @if ($percentageQuestionsChange <= 0)
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 4.5l15 15m0 0V8.25m0 11.25H8.25" />
                                </svg>
                            @else
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 19.5l15-15m0 0H8.25m11.25 0v11.25" />
                                </svg>
                            @endif
                            {{ $percentageQuestionsChange }}%
                        </span>
                        {{ __('Since last month') }}
                    </p>
                </div>
                {{-- <div class="w-full" id="new-products-chart"></div> --}}
            </div>
            <div class="pb-4 items-center justify-between p-4 bg-white border border-gray-200 rounded-lg shadow-sm sm:flex dark:border-gray-700 sm:p-6 dark:bg-gray-800">
                <div class="w-full">
                    <h3 class="text-3xl font-normal text-gray-500 dark:text-gray-400">{{ __('Users') }}</h3>
                    <span class="text-2xl font-bold leading-none text-gray-900 sm:text-3xl dark:text-white">{{ $usersCount }}</span>
                    <p class="flex items-center text-base font-normal text-gray-500 dark:text-gray-400">
                        <span class="flex items-center mr-1.5 text-lg {{ $percentageChange <= 0 ? 'text-red-500 dark:text-red-400' : 'text-green-500 dark:text-green-400' }}">
                            @if ($percentageChange <= 0)
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 4.5l15 15m0 0V8.25m0 11.25H8.25" />
                                </svg>
                            @else
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 19.5l15-15m0 0H8.25m11.25 0v11.25" />
                                </svg>
                            @endif
                            {{ $percentageChange }}%
                        </span>
                        {{ __('Since last month') }}
                    </p>
                </div>
                {{-- <div class="w-full" id="week-signups-chart"></div> --}}
            </div>
            <div class="pb-4 bg-white border border-gray-200 rounded-lg shadow-sm dark:border-gray-700 sm:p-6 dark:bg-gray-800">
                <div class="w-full">
                    <h3 class="mb-2 text-2xl font-normal text-gray-500 dark:text-gray-400">Audience by age</h3>
                    <div class="flex items-center mb-2">
                        <div class="w-16 text-sm font-medium dark:text-white">50+</div>
                        <div class="w-full bg-gray-200 rounded-full h-2.5 dark:bg-gray-700">

                            <div class="bg-primary-600 h-2.5 rounded-full dark:bg-primary-500" style="width: {{ $audienceByAge['twenty']['percentage'] }}%"></div>
                        </div>
                    </div>
                    <div class="flex items-center mb-2">
                        <div class="w-16 text-sm font-medium dark:text-white">40+</div>
                        <div class="w-full bg-gray-200 rounded-full h-2.5 dark:bg-gray-700">
                            <div class="bg-primary-600 h-2.5 rounded-full dark:bg-primary-500" style="width: {{ $audienceByAge['thirty']['percentage'] }}%"></div>
                        </div>
                    </div>
                    <div class="flex items-center mb-2">
                        <div class="w-16 text-sm font-medium dark:text-white">30+</div>
                        <div class="w-full bg-gray-200 rounded-full h-2.5 dark:bg-gray-700">
                            <div class="bg-primary-600 h-2.5 rounded-full dark:bg-primary-500" style="width: {{ $audienceByAge['forty']['percentage'] }}%"></div>
                        </div>
                    </div>
                    <div class="flex items-center mb-2">
                        <div class="w-16 text-sm font-medium dark:text-white">20+</div>
                        <div class="w-full bg-gray-200 rounded-full h-2.5 dark:bg-gray-700">
                            <div class="bg-primary-600 h-2.5 rounded-full dark:bg-primary-500" style="width: {{ $audienceByAge['fifty']['percentage'] }}%"></div>
                        </div>
                    </div>
                </div>
                <div id="traffic-channels-chart" class="w-full"></div>
            </div>
        </div>


    </div>
</x-dashboard-layout>
