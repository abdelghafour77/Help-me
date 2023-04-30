<x-dashboard-layout>
    <x-slot name="title">{{ __('Logs') }}</x-slot>

    <div class="m-4 my-6 min-h-screen p-4 bg-white border border-gray-200 rounded-lg shadow-sm dark:border-gray-700 sm:p-6 dark:bg-gray-800">
        <!-- Card header -->
        <div class="items-center justify-between lg:flex">
            <div class="mb-4 lg:mb-0">
                <h3 class="mb-2 text-xl font-bold uppercase text-gray-900 dark:text-white">{{ __('Logs') }}</h3>
                <span class="text-base font-normal text-gray-500 dark:text-gray-400">{{ __('This is a log list of all users') }}</span>
            </div>

        </div>
        <!-- Table -->
        <div class="flex flex-col mt-6">
            <div class="overflow-x-auto rounded-lg">
                <div class="inline-block min-w-full align-middle">
                    <div class="overflow-hidden shadow sm:rounded-lg">
                        @if ($logs->count() > 0)
                            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-600">
                                <thead class="bg-gray-50 dark:bg-gray-700">
                                    <tr>
                                        <th scope="col" width="%1" class="p-4 text-xs font-medium tracking-wider text-center text-gray-500 uppercase dark:text-white">
                                            Type
                                        </th>
                                        <th scope="col" width="%1" class="p-4 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-white">
                                            Message
                                        </th>
                                        <th scope="col" width="%1" class="p-4 text-xs font-medium tracking-wider text-center text-gray-500 uppercase dark:text-white">
                                            Method
                                        </th>
                                        <th scope="col" class="p-4 text-xs font-medium tracking-wider text-center text-gray-500 uppercase dark:text-white">
                                            ip
                                        </th>
                                        <th scope="col" class="p-4 text-xs font-medium tracking-wider text-center text-gray-500 uppercase dark:text-white">
                                            User ID
                                        </th>
                                        <th scope="col" class="p-4 text-xs font-medium tracking-wider text-center text-gray-500 uppercase dark:text-white">
                                            User role
                                        </th>
                                        <th scope="col" class="p-4 text-xs font-medium tracking-wider text-center text-gray-500 uppercase dark:text-white">
                                            Created at
                                        </th>
                                        <th scope="col" class="p-4 text-xs font-medium tracking-wider text-center text-gray-500 uppercase dark:text-white">
                                            More
                                        </th>

                                    </tr>
                                </thead>
                                <tbody class="bg-white dark:bg-gray-800">
                                    @foreach ($logs as $log)
                                        <tr class="{{ $loop->even ? 'bg-gray-50 dark:bg-gray-700' : '' }}">

                                            <td class="flex justify-center p-4 text-sm font-normal text-gray-500 whitespace-nowrap dark:text-gray-400">
                                                @if ($log->type == 'info')
                                                    <span class="bg-blue-100 text-blue-800 text-xs font-medium inline-flex items-center px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-blue-400 border border-blue-400">
                                                        <svg aria-hidden="true" class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"></path>
                                                        </svg>
                                                        {{ $log->type }}
                                                    </span>
                                                @elseif($log->type == 'error')
                                                    <span class="bg-blue-100 text-red-800 text-xs font-medium inline-flex items-center px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-red-400 border border-red-400">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3 mr-1" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z" />
                                                        </svg>
                                                        {{ $log->type }}
                                                    </span>
                                                @elseif($log->type == 'warning')
                                                    <span class="bg-blue-100 text-yellow-800 text-xs font-medium inline-flex items-center px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-yellow-400 border border-yellow-400">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3 mr-1" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" />
                                                        </svg>
                                                        {{ $log->type }}
                                                    </span>
                                                @endif
                                            </td>
                                            <td class="p-4 text-sm font-semibold text-gray-900 whitespace-nowrap dark:text-white">
                                                <p class="truncate w-24 md:w-64">{{ $log->message }}</p>

                                            </td>
                                            <td class="flex justify-center items-center text-center p-4 text-sm font-normal text-gray-900 whitespace-nowrap dark:text-white">
                                                @if ($log->method == 'DELETE')
                                                    <span class="bg-red-100 text-red-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-red-900 dark:text-red-300">{{ $log->method }}</span>
                                                @elseif ($log->method == 'POST')
                                                    <span class="bg-green-100 text-green-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300">{{ $log->method }}</span>
                                                @elseif($log->method == 'PUT')
                                                    <span class="bg-blue-100 text-blue-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-blue-900 dark:text-blue-300">{{ $log->method }}</span>
                                                @elseif($log->method == 'GET')
                                                    <span class="bg-yellow-100 text-yellow-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-yellow-900 dark:text-yellow-300">{{ $log->method }}</span>
                                                @endif
                                            </td>
                                            <td class=" text-center p-4 text-sm font-normal text-gray-500 whitespace-nowrap dark:text-gray-400">
                                                {{ $log->ip }}
                                            </td>
                                            <td class="text-center  p-4 text-sm font-normal text-gray-500 whitespace-nowrap dark:text-gray-400">
                                                {{ $log->user_id }}
                                            </td>
                                            <td class="text-center p-4 text-sm font-normal text-gray-500 whitespace-nowrap dark:text-gray-400">
                                                {{ $log->user_role }}
                                            </td>
                                            <td class="p-4 whitespace-nowrap text-center">
                                                <span title="{{ $log->created_at }}" class="text-center px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                    {{ $log->created_at->diffForHumans() }}
                                                </span>
                                            </td>
                                            <td class="p-4 text-sm font-normal text-gray-500 whitespace-nowrap dark:text-gray-400 text-center">
                                                <button type="button" onclick="getlog({{ $log->id }})" name="get" data-drawer-target="drawer-log" data-drawer-show="drawer-log" aria-controls="drawer-log" data-drawer-placement="right">
                                                    <svg class="h-6 w-6 text-blue-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                                                    </svg>
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @else
                            <div class="flex flex-col items-center justify-center">
                                <div class="flex flex-col items-center justify-center">

                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-16 h-16 text-gray-400">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M20.25 7.5l-.625 10.632a2.25 2.25 0 01-2.247 2.118H6.622a2.25 2.25 0 01-2.247-2.118L3.75 7.5M10 11.25h4M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125z" />
                                    </svg>


                                    <span class="text-gray-400 text-xl font-medium">{{ __('No logs found') }}...</span>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>


    </div>
    {{-- drawer --}}
    <div id="drawer-log" aria-hidden="true" class="fixed top-0 right-0 z-40 w-full h-screen max-w-xs p-4 overflow-y-auto transition-transform translate-x-full bg-white dark:bg-gray-800" tabindex="-1" aria-labelledby="drawer-label" aria-hidden="true">
        <h5 id="drawer-label" class="inline-flex items-center mb-6 text-sm font-semibold text-gray-500 uppercase dark:text-gray-400">Log Info</h5>
        <button type="button" data-drawer-dismiss="drawer-log" aria-controls="drawer-log"
            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 absolute top-2.5 right-2.5 inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white">
            <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
            </svg>
            <span class="sr-only">Close menu</span>
        </button>
        <div class="space-y-4 text-gray-700 dark:text-white">
            <h4 class="text-4xl font-bold text-gray-400 sm:text-sm dark:text-gray-300"> Message: </h4>
            <span class="" id="message"></span>
            <h4 class="text-4xl font-bold text-gray-400 sm:text-sm dark:text-gray-300"> User ID: </h4>
            <span id="user_id"></span>
            <h4 class="text-4xl font-bold text-gray-400 sm:text-sm dark:text-gray-300"> User full name: </h4>
            <span id="user_full_name"></span>
            <h4 class="text-4xl font-bold text-gray-400 sm:text-sm dark:text-gray-300"> User email: </h4>
            <span id="user_email"></span>
            <h4 class="text-4xl font-bold text-gray-400 sm:text-sm dark:text-gray-300"> User role: </h4>
            <span id="user_role"></span>
            <h4 class="text-4xl font-bold text-gray-400 sm:text-sm dark:text-gray-300"> Date: </h4>
            <span id="date"></span>
            <h4 class="text-4xl font-bold text-gray-400 sm:text-sm dark:text-gray-300"> Method: </h4>
            <span id="method"></span>
            <h4 class="text-4xl font-bold text-gray-400 sm:text-sm dark:text-gray-300"> Type: </h4>
            <span id="type"></span>
            <h4 class="text-4xl font-bold text-gray-400 sm:text-sm dark:text-gray-300"> IP: </h4>
            <span id="ip"></span>
            <h4 class="text-4xl font-bold text-gray-400 sm:text-sm dark:text-gray-300"> URL: </h4>
            <span>
                <a href="" id="url" target="_blank" class="text-blue-500 hover:text-blue-600"></a>
            </span>

        </div>
    </div>
    <script>
        // get log using ajax
        function getlog(id) {
            $.ajax({
                url: '/admin/logs/' + id,
                type: 'GET',
                dataType: 'json',
                complete: function(data) {
                    $('#message').html(data.responseJSON.message)
                    $('#user_id').html(data.responseJSON.user_id)
                    $('#user_full_name').html(data.responseJSON.user.full_name)
                    $('#user_email').html(data.responseJSON.user.email)
                    $('#user_role').html(data.responseJSON.user_role)
                    $('#date').html(data.responseJSON.created_at)
                    $('#ip').html(data.responseJSON.ip)
                    $('#url').attr('href', data.responseJSON.url)
                    $('#url').text(data.responseJSON.url)

                    if (data.responseJSON.type == "error") {
                        $('#type').html(
                            '<span class="bg-red-100 text-red-800 text-xs font-medium inline-flex items-center px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-red-400 border border-red-400"><svg aria-hidden="true" class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"></path></svg> Error </span>'
                        )
                    } else if (data.responseJSON.type == "info") {
                        $('#type').html(
                            '<span class="bg-blue-100 text-blue-800 text-xs font-medium inline-flex items-center px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-blue-400 border border-blue-400"><svg aria-hidden="true" class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"></path></svg> Info </span>'
                        )

                    } else if (data.responseJSON.type == "warning") {
                        $('#type').html(
                            '<span class="bg-blue-100 text-yellow-800 text-xs font-medium inline-flex items-center px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-yellow-400 border border-yellow-400"><svg aria-hidden="true" class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"></path></svg> Warning </span>'
                        )
                    }
                    if (data.responseJSON.method == 'GET') {
                        $('#method').html('<span class="bg-yellow-100 text-yellow-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-yellow-900 dark:text-yellow-300">' + data.responseJSON.method + '</span>')
                    } else if (data.responseJSON.method == 'POST') {
                        $('#method').html('<span class="bg-green-100 text-green-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300">' + data.responseJSON.method + '</span>')
                    } else if (data.responseJSON.method == 'PUT') {
                        $('#method').html('<span class="bg-blue-100 text-blue-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-blue-900 dark:text-blue-300">' + data.responseJSON.method + '</span>')
                    } else if (data.responseJSON.method == 'DELETE') {
                        $('#method').html('<span class="bg-red-100 text-red-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-red-900 dark:text-red-300">' + data.responseJSON.method + '</span>')
                    }
                }
            });
        }
    </script>
</x-dashboard-layout>
