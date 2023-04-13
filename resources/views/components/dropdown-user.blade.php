<div class="flex items-center ml-3">
    <div>
        <button type="button" class="flex text-sm bg-gray-800 rounded-full focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600" id="user-menu-button-2" aria-expanded="false" data-dropdown-toggle="dropdown-2">
            <span class="sr-only">Open user menu</span>
            <img class="w-8 h-8 rounded-full" src="{{ asset('storage/image/user/' . Auth::user()->avatar) }}" alt="user photo">
        </button>
    </div>
    <!-- Dropdown menu -->
    <div class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded shadow dark:bg-gray-700 dark:divide-gray-600" id="dropdown-2">
        <div class="px-4 py-3" role="none">
            <p class="text-sm text-gray-900 dark:text-white" role="none">
                {{ Auth::user()->full_name ?? 'Full name' }}
            </p>
            <p class="text-sm font-medium text-gray-900 truncate dark:text-gray-300" role="none">
                {{ Auth::user()->email ?? 'email@email.com' }}
            </p>
        </div>
        <ul class="py-1" role="none">
            <li>
                <a href="/dashboard" class="{{ request()->is('dashboard') ? 'bg-gray-100 dark:bg-gray-600' : '' }} block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white" role="menuitem">Dashboard</a>
            </li>
            <li>
                <a href="/settings" class="{{ request()->is('settings') ? 'bg-gray-100 dark:bg-gray-600' : '' }} block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white" role="menuitem">Settings</a>
            </li>

            <li>
                <form action="{{ route('logout') }}" method="post">
                    @csrf
                    <a href="#" onclick="event.preventDefault();this.closest('form').submit();" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white" role="menuitem">Logout</a>
                </form>

            </li>
        </ul>
    </div>
</div>
