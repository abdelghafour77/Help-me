<x-dashboard-layout>

    <div class="m-4 my-6 min-h-screen p-4 bg-white border border-gray-200 rounded-lg shadow-sm dark:border-gray-700 sm:p-6 dark:bg-gray-800">
        <!-- Card header -->
        <div class="items-center justify-between lg:flex">
            <div class="mb-4 lg:mb-0">
                <h3 class="mb-2 text-xl font-bold uppercase text-gray-900 dark:text-white">{{ __('Deleted Users') }}</h3>
                <span class="text-base font-normal text-gray-500 dark:text-gray-400">{{ __('This is a list of all deleted users in plateform') }}</span>
            </div>

        </div>
        <!-- Table -->
        @if ($users->count())
            <div class="flex flex-col mt-6">
                <div class="overflow-x-auto rounded-lg">
                    <div class="inline-block min-w-full align-middle">
                        <div class="overflow-hidden shadow sm:rounded-lg">
                            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-600">
                                <thead class="bg-gray-50 dark:bg-gray-700">
                                    <tr>
                                        <th scope="col" width="%1" class="p-4 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-white">
                                            @username
                                        </th>
                                        <th scope="col" width="%1" class="p-4 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-white">
                                            Full Name
                                        </th>
                                        <th scope="col" width="%1" class="p-4 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-white">
                                            Email
                                        </th>
                                        <th scope="col" class="p-4 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-white">
                                            Phone
                                        </th>
                                        <th scope="col" class="p-4 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-white">
                                            Score
                                        </th>
                                        <th scope="col" class="p-4 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-white">
                                            Status
                                        </th>
                                        <th scope="col" class="p-4 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-white">
                                            Birthday
                                        </th>
                                        <th scope="col" class="p-4 text-xs font-medium tracking-wider text-center text-gray-500 uppercase dark:text-white">
                                            Joined At
                                        </th>
                                        <th scope="col" class="p-4 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-white">
                                            Action
                                        </th>

                                    </tr>
                                </thead>
                                <tbody class="bg-white dark:bg-gray-800">
                                    @foreach ($users as $user)
                                        <tr class="{{ $loop->even ? 'bg-gray-50 dark:bg-gray-700' : '' }}">
                                            <td class="flex items-center p-4 text-sm font-normal text-gray-900 whitespace-nowrap dark:text-white">
                                                <div class="relative h-10 w-10">
                                                    <img class="h-full w-full rounded-full object-cover object-center" src="{{ asset('/storage/image/user/' . $user->avatar) }}" alt="" />
                                                    <span class="absolute right-0 bottom-0 h-2 w-2 rounded-full bg-green-400 ring ring-white"></span>
                                                </div>
                                                <span class="pl-3"> {{ $user->username }}</span>
                                            </td>
                                            <td class="p-4 text-sm font-normal text-gray-500 whitespace-nowrap dark:text-gray-400">
                                                {{ $user->full_name }}
                                            </td>
                                            <td class="p-4 text-sm font-semibold text-gray-900 whitespace-nowrap dark:text-white">
                                                {{ $user->email }}
                                            </td>
                                            <td class="p-4 text-sm font-normal text-gray-500 whitespace-nowrap dark:text-gray-400">
                                                {{ $user->phone }}
                                            </td>
                                            <td class="p-4 text-sm font-normal text-gray-500 whitespace-nowrap dark:text-gray-400">
                                                {{ $user->score }}
                                            </td>
                                            <td class="p-4 text-sm font-normal text-gray-500 whitespace-nowrap dark:text-gray-400">
                                                <div class="flex items-center">
                                                    {{-- <div class="h-2.5 w-2.5 rounded-full bg-green-500 mr-2"></div> --}}
                                                    @if ($user->status)
                                                        Enabled
                                                    @else
                                                        Disabled
                                                    @endif
                                                </div>
                                            </td>
                                            <td class="p-4 text-sm font-normal text-gray-500 whitespace-nowrap dark:text-gray-400 text-center">
                                                {{ $user->birthday ?? 'Not Set' }}
                                            </td>
                                            <td class="p-4 whitespace-nowrap text-center">
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                    {{ $user->created_at->diffForHumans() }}
                                                </span>
                                            </td>
                                            <td class="p-4 text-sm font-normal text-gray-500 whitespace-nowrap dark:text-gray-400 text-center">
                                                {{-- <div class="flex justify-end gap-4"> --}}

                                                {{-- <button data-drawer-target="drawer-user"></button> --}}
                                                <button type="button" onclick="editeuser({{ $user->id }})" name="edite" data-drawer-target="drawer-user" data-drawer-show="drawer-user" aria-controls="drawer-user" data-drawer-placement="right">
                                                    <svg class="h-6 w-6 text-blue-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-6 w-6" x-tooltip="tooltip">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125" />
                                                    </svg>
                                                </button>
                                                {{-- <button type="button" name="delete">
                                                    <svg class="h-6 w-6 text-red-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-6 w-6" x-tooltip="tooltip">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                                    </svg>
                                                </button> --}}
                                                {{-- </div> --}}
                                            </td>

                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="flex justify-center items-center h-96">
                <div class="flex flex-col items-center">
                    <img src="{{ asset('images/empty.svg') }}" alt="empty" class="w-96">
                    <h1 class="text-3xl font-semibold text-gray-700 dark:text-gray-200">{{ __('No Users Found') }}</h1>
                </div>
            </div>
        @endif

    </div>
    {{-- drawer --}}
    <div id="drawer-user" aria-hidden="true" class="fixed top-0 right-0 z-40 w-full h-screen max-w-xs p-4 overflow-y-auto transition-transform translate-x-full bg-white dark:bg-gray-800" tabindex="-1" aria-labelledby="drawer-label" aria-hidden="true">
        <h5 id="drawer-label" class="inline-flex items-center mb-6 text-sm font-semibold text-gray-500 uppercase dark:text-gray-400">Edit User</h5>
        <button type="button" data-drawer-dismiss="drawer-user" aria-controls="drawer-user" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 absolute top-2.5 right-2.5 inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white">
            <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
            </svg>
            <span class="sr-only">Close menu</span>
        </button>


        <form action="" method="POST" id="user_form">
            @csrf
            @method('PUT')
            <div class="space-y-4">
                <input type="hidden" id="user_id" value="">
                <div>
                    <label for="full_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Full Name') }}</label>
                    <input type="text" name="full_name" id="full_name"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                        placeholder="{{ __('Full Name') }}" required="">
                </div>
                <div>
                    <label for="username" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Username') }}</label>
                    <input type="text" name="username" id="username"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                        placeholder="{{ __('Username') }}" required="">
                </div>

                <div>
                    <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Email') }}</label>
                    <input type="email" name="email" id="email"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                        placeholder="{{ __('Email') }}" required="">
                </div>
                <div>
                    <label for="phone" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Phone Number') }}</label>
                    <input type="phone" name="phone" id="phone"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                        placeholder="{{ __('Phone Number') }}" required="">
                </div>
                <div>
                    <label for="birthday" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Birthday') }}</label>
                    <input type="date" name="birthday" id="birthday"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                        placeholder="{{ __('Birthday') }}">
                </div>

                <div>
                    <label for="status" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Status</label>
                    <select id="status" name="status"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                        <option selected disabled>Status</option>
                        <option value="1">Enabled</option>
                        <option value="0">Disabled</option>

                    </select>
                </div>
                <div>
                    <label for="role" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Role</label>
                    <select id="role" name="role"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                        <option selected disabled>Select Role</option>
                        @foreach ($roles as $role)
                            <option value="{{ $role->name }}">{{ $role->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class=" flex justify-center w-full pb-4 space-x-4 ">
                    <button type="submit" onclick="changeFormAction('PUT')"
                        class="text-white w-full justify-center bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                        Update User
                    </button>


                    <button type="submit" onclick="changeFormAction('DELETE')"
                        class="text-white w-full justify-center bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">
                        Delete User
                    </button>


                </div>
            </div>
        </form>
    </div>
    <script>
        // get user using ajax
        function editeuser(id) {
            $.ajax({
                url: '/admin/users/' + id,
                type: 'GET',
                dataType: 'json',
                complete: function(data) {

                },
                success: function(data) {

                    $('#user_id').val(data.user.id);
                    $('#user_form').attr('action', '/users/' + data.user.id);
                    $('#full_name').val(data.user.full_name);
                    $('#username').val(data.user.username);
                    $('#email').val(data.user.email);
                    $('#phone').val(data.user.phone);
                    $('#birthday').val(data.user.birthday);
                    $('#status').val(data.user.status);
                    $('#role').val(data.role);


                }
            });
        }

        function changeFormAction(method) {
            $("input[name='_method']").val(method);
            if (method == "DELETE") {
                $('#user_form').attr('action', '/users-deleted/' + $('#user_id').val());

            } else {
                $('#user_form').attr('action', '/users/' + $('#user_id').val());
            }

        }
    </script>
</x-dashboard-layout>
