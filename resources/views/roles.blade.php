<x-dashboard-layout>
    <div class="m-4 my-6 p-4 min-h-screen bg-white border border-gray-200 rounded-lg shadow-sm dark:border-gray-700 sm:p-6 dark:bg-gray-800">
        <!-- Card header -->
        <div class="items-center justify-between lg:flex">
            <div class="mb-4 lg:mb-0">
                <h3 class="mb-2 text-xl font-bold uppercase text-gray-900 dark:text-white">{{ __('Roles') }}</h3>
                <span class="text-base font-normal text-gray-500 dark:text-gray-400">{{ __('This is a list of all Roles') }}</span>
            </div>
            <div class="items-center sm:flex">
                {{-- button add role --}}
                <a onclick="addrole()" data-drawer-target="drawer-role" data-drawer-show="drawer-role" aria-controls="drawer-role" data-drawer-placement="right"
                    class="flex items-center justify-center px-4 py-2 mb-2 text-sm font-medium text-white bg-green-500 border border-transparent rounded-md shadow-sm hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 sm:mb-0 sm:mr-2">
                    <svg class="w-5 h-5 mr-2 -ml-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v4h4a1 1 0 110 2h-4v4a1 1 0 11-2 0v-4H5a1 1 0 110-2h4V4a1 1 0 011-1z" clip-rule="evenodd"></path>
                    </svg>
                    <span>{{ __('Add Role') }}</span>
                </a>
            </div>
        </div>
        <!-- Table -->
        <div class="pt-10 grid grid-cols-1 sm:grid-cols-1 md:grid-cols-3 lg:grid-cols-3 xl:grid-cols-3 gap-5">
            @foreach ($roles as $role)
                <div class="w-full max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                    <div class="flex justify-end px-4 pt-4">
                        <button id="dropdownButton" data-dropdown-toggle="dropdown2-{{ $role->id }}" class="inline-block text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 focus:ring-4 focus:outline-none focus:ring-gray-200 dark:focus:ring-gray-700 rounded-lg text-sm p-1.5" type="button">
                            <span class="sr-only">Open dropdown</span>
                            <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z"></path>
                            </svg>
                        </button>
                        <!-- Dropdown menu -->
                        <div id="dropdown2-{{ $role->id }}" class="z-10 hidden text-base list-none bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
                            <ul class="py-2" aria-labelledby="dropdownButton">
                                {{-- <li>
                                    <a href="role/{{ $role->slug }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">View</a>
                                </li> --}}
                                <li>
                                    <a onclick="editerole({{ $role->id }})" data-drawer-target="drawer-role" data-drawer-show="drawer-role" aria-controls="drawer-role" data-drawer-placement="right"
                                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Edit</a>
                                </li>
                                <li>
                                    <form action="roles/{{ $role->id }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <a href="#"onclick="event.preventDefault();this.closest('form').submit();" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Delete</a>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="flex flex-col items-center pb-10">
                        {{-- <img class="h-24 mb-3" src="{{ asset('storage/image/role/' . $role->image) }}" alt="Bonnie image" /> --}}
                        <h5 class="mb-1 text-xl font-medium text-gray-900 dark:text-white">{{ $role->name }}</h5>
                        <span class="text-sm text-gray-500 dark:text-gray-400">{{ $role->description }}</span>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    {{-- drawer --}}
    <div id="drawer-role" aria-hidden="true" class="fixed top-0 right-0 z-40 w-full h-screen max-w-xs p-4 overflow-y-auto transition-transform translate-x-full bg-white dark:bg-gray-800" tabindex="-1" aria-labelledby="drawer-label" aria-hidden="true">
        <h5 id="title-edit" class="inline-flex items-center mb-6 text-sm font-semibold text-gray-500 uppercase dark:text-gray-400">Edit Role</h5>
        <h5 id="title-add" class="inline-flex items-center mb-6 text-sm font-semibold text-gray-500 uppercase dark:text-gray-400">Add Role</h5>
        <button type="button" data-drawer-dismiss="drawer-role" aria-controls="drawer-role" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 absolute top-2.5 right-2.5 inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white">
            <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
            </svg>
            <span class="sr-only">Close menu</span>
        </button>


        <form action="" method="POST" id="role_form" enctype="multipart/form-data">
            @csrf

            @foreach ($errors->all() as $error)
                <div class="alert alert-danger" role="alert">
                    {{ $error }}
                </div>
            @endforeach

            <div class="space-y-4">
                <input type="hidden" name="id" id="id" value="">
                <div>
                    <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Name') }}</label>
                    <input type="text" name="name" id="name"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                        placeholder="{{ __('Name') }}" required="">
                </div>
                <div>
                    <label for="permissions" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Permissions') }}</label>
                    <div id="permissions">
                        @foreach ($permissions as $permission)
                            <div class="flex items-center">
                                <input id="permission-{{ $permission->id }}" name="permissions[]" type="checkbox" value="{{ $permission->name }}"
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                <label for="checked-checkbox" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{ $permission->name }}</label>
                            </div>
                        @endforeach
                    </div>
                </div>


                <div id="btn-edit">
                    <button type="submit" class="text-white w-full justify-center bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                        Update Role
                    </button>
                </div>
                <div id="btn-add">
                    <button type="submit" class="text-white w-full justify-center bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                        Create Role
                    </button>
                </div>


        </form>
    </div>
    <script>
        // get user using ajax
        function editerole(id) {
            // hide #btn-add
            $('#btn-add').hide();
            $('#title-add').hide();
            // show #btn-edit
            $('#btn-edit').show();
            $('#title-edit').show();
            // add method put
            $('#role_form').attr('action', '/roles/' + id);
            $('#role_form').attr('method', 'POST');
            $('#role_form').append('@method('PUT')');

            $.ajax({
                url: '/admin/roles/' + id,
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    clearInputs()
                    $('#id').val(data.role.id);
                    $('#name').val(data.role.name);
                    var inputs = $('#permissions').find('input');
                    inputs.each(function() {
                        var id = $(this).attr('id').split('-')[1];
                        data.permissions.forEach(permission => {
                            if (permission.id == id) {
                                $(this).prop('checked', true);
                            }
                        });
                    });

                }

            });
        }

        function clearInputs() {
            $('#id').val('');
            $('#name').val('');
            var inputs = $('#permissions').find('input');
            inputs.each(function() {
                $(this).prop('checked', false);
            });
        }

        function addrole() {
            // show #btn-add
            $('#btn-add').show();
            $('#title-add').show();
            // hide #btn-edit
            $('#btn-edit').hide();
            $('#title-edit').hide();
            // remove method put
            $('#role_form').attr('action', '/roles');
            $('#role_form').attr('method', 'POST');
            $('#role_form').find("input[name='_method']").remove();
            // clear input
            clearInputs()

        }
    </script>

</x-dashboard-layout>
