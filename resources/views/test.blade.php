<!DOCTYPE html>
<html lang="en" class="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>Document</title>
</head>

<body>
    <x-dashboard.navbar-dashboard />

    <div class="flex pt-16 overflow-hidden bg-gray-50 dark:bg-gray-900">

        <x-dashboard.sidebar />

        <div id="main-content" class="relative w-full h-full overflow-y-auto bg-gray-50 lg:ml-64 dark:bg-gray-900">
            <main>
                <x-dashboard.stacked />
            </main>
            <x-dashboard.footer-dashboard />
        </div>
        {{-- <x-dashboard.stacked /> --}}
        {{-- <x-dashboard.500 /> --}}
        {{-- <x-dashboard.404 /> --}}
        {{-- <x-dashboard.maintenance /> --}}
        {{-- <x-dashboard.settings /> --}}

        {{-- <x-dashboard.navbar-dashboard /> --}}
        {{-- <x-dashboard.sidebar /> --}}
        {{-- <x-dashboard.crud /> --}}




        {{-- <x-dashboard.footer-dashboard /> --}}
        {{-- <x-dashboard.footer /> --}}

        <script async defer src="https://buttons.github.io/buttons.js"></script>
        <script src="{{ asset('assets/app.bundle.js') }}"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.2/datepicker.min.js"></script>
</body>


</html>
