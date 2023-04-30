<x-dashboard-layout>
    <x-slot name="title">{{ __('Reports') }}</x-slot>
    <div class="m-4 my-6 p-4 bg-white border min-h-screen border-gray-200 rounded-lg shadow-sm dark:border-gray-700 sm:p-6 dark:bg-gray-800">
        <!-- Card header -->
        <div class="items-center justify-between lg:flex">
            <div class="mb-4 lg:mb-0">
                <h3 class="mb-2 text-xl font-bold uppercase text-gray-900 dark:text-white">Reports</h3>
                <span class="text-base font-normal text-gray-500 dark:text-gray-400">This is a report list of all users</span>
            </div>
        </div>
        <!-- Table -->
        <div class="flex flex-col mt-6">
            <div class="overflow-x-auto rounded-lg">
                <div class="inline-block min-w-full align-middle">
                    <div class="overflow-hidden shadow sm:rounded-lg">
                        @if ($reports->count() > 0)
                            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-600">
                                <thead class="bg-gray-50 dark:bg-gray-700">
                                    <tr>
                                        <th scope="col" width="%1" class="p-4 text-xs font-medium tracking-wider text-center text-gray-500 uppercase dark:text-white">
                                            ID
                                        </th>
                                        <th scope="col" width="%1" class="p-4 text-xs font-medium tracking-wider text-center text-gray-500 uppercase dark:text-white">
                                            Report Type
                                        </th>
                                        <th scope="col" width="%1" class="p-4 text-xs font-medium tracking-wider text-center text-gray-500 uppercase dark:text-white">
                                            User
                                        </th>
                                        <th scope="col" class="p-4 text-xs font-medium tracking-wider text-center text-gray-500 uppercase dark:text-white">
                                            Description
                                        </th>
                                        <th scope="col" class="p-4 text-xs font-medium tracking-wider text-center text-gray-500 uppercase dark:text-white">
                                            User ID
                                        </th>
                                        <th scope="col" class="p-4 text-xs font-medium tracking-wider text-center text-gray-500 uppercase dark:text-white">
                                            Status
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
                                    @foreach ($reports as $report)
                                        <tr class="{{ $loop->even ? 'bg-gray-50 dark:bg-gray-700' : '' }}">
                                            <td class="p-4 text-sm text-center font-semibold text-gray-900 whitespace-nowrap dark:text-white">
                                                {{ $report->id }}
                                            </td>
                                            <td class="flex justify-center p-4 text-sm font-normal text-gray-500 whitespace-nowrap dark:text-gray-400">
                                                @if ($report->reportable_type == 'question')
                                                    <span class="bg-blue-100 text-blue-800 text-xs font-medium inline-flex items-center px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-blue-400 border border-blue-400">
                                                        <svg aria-hidden="true" class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"></path>
                                                        </svg>
                                                        {{ __('question') }}
                                                    </span>
                                                @elseif($report->reportable_type == 'answer')
                                                    <span class="bg-blue-100 text-yellow-800 text-xs font-medium inline-flex items-center px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-yellow-400 border border-yellow-400">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3 mr-1" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" />
                                                        </svg>
                                                        {{ __('answer') }}
                                                    </span>
                                                @endif
                                            </td>
                                            <td class="p-4 text-sm text-center font-semibold text-gray-900 whitespace-nowrap dark:text-white">
                                                {{ $report->user->full_name }}
                                            </td>

                                            <td class=" text-center p-4 text-sm font-normal text-gray-500 whitespace-nowrap dark:text-gray-400">
                                                <p class="truncate max-w-24 md:max-w-64">{{ $report->description ?? 'Without description' }}</p>
                                            </td>
                                            <td class="text-center  p-4 text-sm font-normal text-gray-500 whitespace-nowrap dark:text-gray-400">
                                                {{ $report->user_id }}
                                            </td>
                                            <td class="text-center p-4 text-sm font-normal text-gray-500 whitespace-nowrap dark:text-gray-400">
                                                @if ($report->is_resolved == 0)
                                                    <span class="bg-blue-100 text-orange-400 text-xs font-medium inline-flex items-center px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-orange-300 border border-orange-300">
                                                        pending
                                                    </span>
                                                @else
                                                    <span class="bg-blue-100 text-green-800 text-xs font-medium inline-flex items-center px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-green-400 border border-green-400">
                                                        resolved
                                                    </span>
                                                @endif
                                            </td>
                                            <td class="p-4 whitespace-nowrap text-center">
                                                <span title="{{ $report->created_at }}" class="text-center px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                    {{ $report->created_at->diffForHumans() }}
                                                </span>
                                            </td>
                                            <td class="p-4 text-sm font-normal text-gray-500 whitespace-nowrap dark:text-gray-400 text-center">
                                                <button type="button" onclick="getreport({{ $report->id }})" name="get" data-drawer-target="drawer-report" data-drawer-show="drawer-report" aria-controls="drawer-report" data-drawer-placement="right">
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
                                            d="M12 12.75c1.148 0 2.278.08 3.383.237 1.037.146 1.866.966 1.866 2.013 0 3.728-2.35 6.75-5.25 6.75S6.75 18.728 6.75 15c0-1.046.83-1.867 1.866-2.013A24.204 24.204 0 0112 12.75zm0 0c2.883 0 5.647.508 8.207 1.44a23.91 23.91 0 01-1.152 6.06M12 12.75c-2.883 0-5.647.508-8.208 1.44.125 2.104.52 4.136 1.153 6.06M12 12.75a2.25 2.25 0 002.248-2.354M12 12.75a2.25 2.25 0 01-2.248-2.354M12 8.25c.995 0 1.971-.08 2.922-.236.403-.066.74-.358.795-.762a3.778 3.778 0 00-.399-2.25M12 8.25c-.995 0-1.97-.08-2.922-.236-.402-.066-.74-.358-.795-.762a3.734 3.734 0 01.4-2.253M12 8.25a2.25 2.25 0 00-2.248 2.146M12 8.25a2.25 2.25 0 012.248 2.146M8.683 5a6.032 6.032 0 01-1.155-1.002c.07-.63.27-1.222.574-1.747m.581 2.749A3.75 3.75 0 0115.318 5m0 0c.427-.283.815-.62 1.155-.999a4.471 4.471 0 00-.575-1.752M4.921 6a24.048 24.048 0 00-.392 3.314c1.668.546 3.416.914 5.223 1.082M19.08 6c.205 1.08.337 2.187.392 3.314a23.882 23.882 0 01-5.223 1.082" />
                                    </svg>

                                    <span class="text-gray-400 text-xl font-medium">{{ __('No reports found') }}...</span>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>


    </div>
    {{-- drawer --}}
    <div id="drawer-report" aria-hidden="true" class="fixed top-0 right-0 z-40 w-full h-screen max-w-xs p-4 overflow-y-auto transition-transform translate-x-full bg-white dark:bg-gray-800" tabindex="-1" aria-labelledby="drawer-label" aria-hidden="true">
        <h5 id="drawer-label" class="inline-flex items-center mb-6 text-sm font-semibold text-gray-500 uppercase dark:text-gray-400">Report Info</h5>
        <button type="button" data-drawer-dismiss="drawer-report" aria-controls="drawer-report"
            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 absolute top-2.5 right-2.5 inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white">
            <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
            </svg>
            <span class="sr-only">Close menu</span>
        </button>
        <div class="space-y-4 text-gray-700 dark:text-white">
            <h4 class="text-4xl font-bold text-gray-400 sm:text-sm dark:text-gray-300"> Report ID: </h4>
            <span class="" id="report_id"></span>
            <h4 class="text-4xl font-bold text-gray-400 sm:text-sm dark:text-gray-300"> Type: </h4>
            <span id="type"></span>
            <h4 class="text-4xl font-bold text-gray-400 sm:text-sm dark:text-gray-300"> Status: </h4>
            <span id="status"></span>
            <h4 class="text-4xl font-bold text-gray-400 sm:text-sm dark:text-gray-300"> Report type: </h4>
            <span id="report_type"></span>
            <h4 class="text-4xl font-bold text-gray-400 sm:text-sm dark:text-gray-300"> Report type description: </h4>
            <span id="report_type_description"></span>
            <h4 class="text-4xl font-bold text-gray-400 sm:text-sm dark:text-gray-300"> Description: </h4>
            <span id="description"></span>
            <h4 class="text-4xl font-bold text-gray-400 sm:text-sm dark:text-gray-300"> User ID: </h4>
            <span id="user_id"></span>
            <h4 class="text-4xl font-bold text-gray-400 sm:text-sm dark:text-gray-300"> User Full Name: </h4>
            <span id="user_full_name"></span>
            <h4 class="text-4xl font-bold text-gray-400 sm:text-sm dark:text-gray-300"> User role: </h4>
            <span id="user_role"></span>
            <h4 class="text-4xl font-bold text-gray-400 sm:text-sm dark:text-gray-300"> Date: </h4>
            <span id="date"></span>
            <h4 class="text-4xl font-bold text-gray-400 sm:text-sm dark:text-gray-300"> URL: </h4>
            <a id="url" href="" target="_blank" class="text-primary-700 hover:text-primary-800 dark:text-primary-500 dark:hover:text-primary-400"> View </a>
            {{-- buttons --}}
            <div class="flex gap-1">
                <button id="btn-resolve" type="submit" onclick="changeFormAction('PUT')"
                    class="text-white w-full whitespace-nowrap justify-center bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                    Resolve
                </button>
                <button id="btn-delete" type="submit" onclick="changeFormAction('DELETE')"
                    class="text-white w-full whitespace-nowrap justify-center bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">
                    Delete
                </button>
            </div>

        </div>
    </div>

    <script>
        // get report using ajax
        function getreport(id) {
            $.ajax({
                url: '/admin/reports/' + id,
                type: 'GET',
                dataType: 'json',
                complete: function(data) {
                    console.log(data.responseJSON)
                    $('#report_id').html(data.responseJSON.data.id)
                    $('#type').html(data.responseJSON.data.reportable_type)
                    $('#report_type').html(data.responseJSON.data.report_type.name)
                    $('#report_type_description').html(data.responseJSON.data.report_type.description)
                    $('#description').html(data.responseJSON.data.description)
                    $('#user_id').html(data.responseJSON.data.user_id)
                    $('#user_full_name').html(data.responseJSON.data.user.full_name)
                    $('#user_role').html(data.responseJSON.data.user.role)
                    $('#date').html(data.responseJSON.data.created_at)
                    $('#btn-resolve').html('Resolve ' + data.responseJSON.data.reportable_type);
                    $('#btn-delete').html('Delete ' + data.responseJSON.data.reportable_type);
                    if (data.responseJSON.data.reportable_type == 'answer') {
                        $('#url').attr('href', '/question/' + data.responseJSON.data.question.slug + '#answer-' + data.responseJSON.data.reportable_id);
                    } else if (data.responseJSON.data.reportable_type == 'question') {
                        $('#url').attr('href', '/question/' + data.responseJSON.data.question.slug);
                    }
                    if (data.responseJSON.data.is_resolved == 0) {
                        $('#status').html('<span class="bg-blue-100 text-orange-400 text-xs font-medium inline-flex items-center px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-orange-300 border border-orange-300">pending</span>');
                    } else {
                        $('#status').html('<span class="bg-blue-100 text-green-800 text-xs font-medium inline-flex items-center px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-green-400 border border-green-400">resolved</span>');
                    }
                }
            });
        }
    </script>
</x-dashboard-layout>
