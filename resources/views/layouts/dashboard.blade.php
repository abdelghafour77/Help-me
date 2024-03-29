<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>Help Me - {{ $title ?? '' }}</title>
    <script async>
        if (localStorage.getItem('color-theme') === 'dark') {
            document.documentElement.classList.add('dark')
        } else {
            document.documentElement.classList.remove('dark')
        }
    </script>
</head>

<body>
    <x-flash />
    <x-dashboard.navbar-dashboard />

    <div class="flex pt-16 overflow-hidden bg-gray-50 dark:bg-gray-900">

        <x-dashboard.sidebar />

        <div id="main-content" class="relative w-full h-full overflow-y-auto bg-gray-50 lg:ml-64 dark:bg-gray-900">
            <main>
                {{ $slot }}
            </main>
            <x-dashboard.footer-dashboard />
        </div>
    </div>

</body>

</html>
