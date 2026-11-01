  <!-- ============ NAVBAR ============ -->
  <header>
    <nav class="ah-nav" aria-label="Navigasi utama">
      <div class="container">
        <a class="ah-brand" href="{{ route('home') }}" aria-label="Beranda DulAuto">
          <span class="ah-brand-mark" aria-hidden="true">
            <svg viewBox="0 0 24 24" fill="none"><path d="M3 13l2-5.5A2 2 0 0 1 6.9 6h10.2a2 2 0 0 1 1.9 1.5L21 13v5a1 1 0 0 1-1 1h-1a1 1 0 0 1-1-1v-1H6v1a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1v-5z" fill="#fff"/><circle cx="7" cy="15" r="1.3" fill="#2f6bff"/><circle cx="17" cy="15" r="1.3" fill="#2f6bff"/></svg>
          </span>
          Dul<b>Auto</b>
        </a>

        <ul class="ah-nav-links ah-nav-desktop" role="list">
          <li><a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">Beranda</a></li>
          <li><a href="{{ route('inventory.index') }}" class="{{ request()->routeIs('inventory.index') ? 'active' : '' }}">Inventory</a></li>
          <li><a href="{{ route('home') }}#finance">Pembiayaan</a></li>
          <li><a href="{{ route('home') }}#services">Layanan</a></li>
          <li><a href="{{ route('home') }}#faq">FAQ</a></li>
        </ul>

        <div class="ah-nav-cta ah-nav-desktop">
          <a href="{{ route('inventory.index') }}" class="btn btn-ghost btn-sm">Lihat katalog</a>
          <a href="{{ route('home') }}#finance" class="btn btn-ah btn-sm">Simulasi angsuran</a>
        </div>

        <button class="ah-burger" aria-label="Buka menu" aria-expanded="false" aria-controls="mobileMenu">
          <span></span><span></span><span></span>
        </button>
      </div>
    </nav>

    <div class="ah-overlay" aria-hidden="true"></div>
    <div class="ah-mobile-menu" id="mobileMenu" aria-label="Navigasi seluler">
      <a href="{{ route('home') }}">Beranda</a>
      <a href="{{ route('inventory.index') }}">Inventory</a>
      <a href="{{ route('home') }}#finance">Pembiayaan</a>
      <a href="{{ route('home') }}#services">Layanan</a>
      <a href="{{ route('home') }}#faq">FAQ</a>
      <hr>
      <a href="{{ route('inventory.index') }}" class="btn btn-ghost">Lihat katalog</a>
      <a href="{{ route('home') }}#finance" class="btn btn-ah">Simulasi angsuran</a>
    </div>
  </header>
