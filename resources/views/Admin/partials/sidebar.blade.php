<aside id="application-sidebar-brand"
    class="hs-overlay hs-overlay-open:translate-x-0 -translate-x-full left-0 transform hidden xl:block xl:translate-x-0 xl:end-auto xl:bottom-0 fixed top-0 with-vertical transition-all duration-300 h-screen z-20 flex-shrink-0 border-r w-[270px] border-border bg-white dark:bg-dark">
    <div class="py-5 px-5 flex justify-between">
        <a href="{{ url('/admin') }}" class="flex items-center gap-3 text-nowrap">
            <span class="flex h-10 w-10 items-center justify-center rounded-lg bg-primary text-lg font-bold text-white">D</span>
            <span>
                <span class="block text-lg font-semibold text-dark dark:text-white">DulAuto</span>
                <span class="block text-xs text-bodytext">Admin showroom</span>
            </span>
        </a>
    </div>

    <div class="scroll-sidebar overflow-y-auto" style="height: calc(100vh - 112px)">
        <div class="px-6 mt-8 mini-layout">
            <nav class="hs-accordion-group w-full flex flex-col" aria-label="Navigasi admin">
                <ul id="sidebarnav">
                    <li class="caption mb-3">
                        <span class="hide-menu text-xs font-semibold text-bodytext">Menu utama</span>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link dark-sidebar-link {{ request()->is('admin') ? 'active activemenu' : '' }}"
                            href="{{ url('/admin') }}">
                            <span class="hide-menu">Dashboard</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link dark-sidebar-link {{ request()->routeIs('pelanggan.*') ? 'active activemenu' : '' }}"
                            href="{{ route('pelanggan.index') }}">
                            <span class="hide-menu">Pelanggan</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link dark-sidebar-link {{ request()->routeIs('barang.*') ? 'active activemenu' : '' }}"
                            href="{{ route('barang.index') }}">
                            <span class="hide-menu">Barang</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link dark-sidebar-link {{ request()->routeIs('kendaraan.*') ? 'active activemenu' : '' }}"
                            href="{{ route('kendaraan.index') }}">
                            <span class="hide-menu">Kendaraan</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link dark-sidebar-link {{ request()->routeIs('users.*') ? 'active activemenu' : '' }}"
                            href="{{ route('users.index') }}">
                            <span class="hide-menu">User</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</aside>
