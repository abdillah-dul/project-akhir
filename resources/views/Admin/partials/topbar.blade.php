<header class="sticky top-header top-0 inset-x-0 z-10 flex flex-wrap md:justify-start md:flex-nowrap text-sm bg-white dark:bg-dark">
    <div class="with-vertical w-full">
        <div class="w-full mx-auto px-4 lg:py-4 py-3 lg:px-4">
            <div class="relative md:flex md:items-center md:justify-between">
                <div class="flex justify-between items-center w-full">
                    <div class="flex items-center gap-3">
                        <button type="button"
                            class="xl:hidden btn btn-outline-primary"
                            data-hs-overlay="#application-sidebar-brand"
                            aria-controls="application-sidebar-brand"
                            aria-label="Buka navigasi">Menu</button>
                        <div>
                            <p class="mb-0 text-xs text-bodytext">DulAuto / Admin</p>
                            <p class="mb-0 text-base font-semibold text-dark dark:text-white">@yield('title', 'Dashboard')</p>
                        </div>
                    </div>
                    <a href="{{ url('/') }}" class="btn btn-outline-primary">Lihat halaman utama</a>
                </div>
            </div>
        </div>
    </div>
</header>
