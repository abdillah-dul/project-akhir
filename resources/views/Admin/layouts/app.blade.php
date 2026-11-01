<!DOCTYPE html>
<html lang="id" dir="ltr" data-color-theme="Blue_Theme" class="light selected" data-layout="vertical"
    data-boxed-layout="boxed" data-card="shadow">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Dashboard') - DulAuto Admin</title>
    <link rel="shortcut icon" type="image/png" href="{{ asset('admin-assets/tailwindadmin/assets/images/logos/favicon.png') }}">
    <link rel="stylesheet" href="{{ asset('admin-assets/tailwindadmin/assets/css/theme.css') }}">
    @stack('styles')
</head>
<body class="DEFAULT_THEME bg-white dark:bg-dark">
    <main>
        <div id="main-wrapper" class="flex">
            @include('Admin.partials.sidebar')

            <div class="page-wrapper w-full" role="main">
                @include('Admin.partials.topbar')

                <main class="max-w-full pt-6">
                    <div class="container py-5">
                        @yield('content')
                    </div>
                </main>
            </div>
        </div>
    </main>

    <script src="{{ asset('admin-assets/tailwindadmin/assets/js/vendor.min.js') }}"></script>
    <script src="{{ asset('admin-assets/tailwindadmin/assets/js/theme/app.init.js') }}"></script>
    <script src="{{ asset('admin-assets/tailwindadmin/assets/js/theme/app.min.js') }}"></script>
    <script src="{{ asset('admin-assets/tailwindadmin/assets/js/theme.js') }}"></script>
    <script src="{{ asset('admin-assets/tailwindadmin/assets/libs/simplebar/dist/simplebar.min.js') }}"></script>
    <script src="{{ asset('admin-assets/tailwindadmin/assets/libs/preline/dist/preline.js') }}"></script>
    @stack('scripts')
</body>
</html>
