  <!-- ============ FOOTER ============ -->
  <footer class="ah-footer">
    <div class="container">
      <div class="row g-4">
        <div class="col-lg-4">
          <a class="ah-brand mb-3" href="{{ route('home') }}" aria-label="Beranda DulAuto">
            <span class="ah-brand-mark" aria-hidden="true">
              <svg viewBox="0 0 24 24" fill="none"><path d="M3 13l2-5.5A2 2 0 0 1 6.9 6h10.2a2 2 0 0 1 1.9 1.5L21 13v5a1 1 0 0 1-1 1h-1a1 1 0 0 1-1-1v-1H6v1a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1v-5z" fill="#fff"/><circle cx="7" cy="15" r="1.3" fill="#2f6bff"/><circle cx="17" cy="15" r="1.3" fill="#2f6bff"/></svg>
            </span>
            Dul<b>Auto</b>
          </a>
          <p>Temukan kendaraan pilihan dengan informasi yang jelas dan layanan ramah dari tim DulAuto.</p>
          <p class="mb-1"><strong style="color:var(--ah-white)">DulAuto</strong></p>
          <p>Informasi katalog kendaraan yang jelas dan mudah dijelajahi.</p>
        </div>

        <div class="col-6 col-lg-2">
          <h5>Jelajahi</h5>
          <a href="{{ route('inventory.index') }}">Katalog kendaraan</a><br>
          <a href="{{ route('home') }}#finance">Pembiayaan</a><br>
          <a href="{{ route('home') }}#services">Layanan</a><br>
          <a href="{{ route('home') }}#finance">Simulasi angsuran</a><br>
          <a href="{{ route('home') }}#faq">FAQ</a>
        </div>

        <div class="col-6 col-lg-3">
          <h5>Informasi katalog</h5>
          <ul class="ah-hours">
            <li><span>Data kendaraan</span><span>Dari database</span></li>
            <li><span>Informasi harga</span><span>Dalam Rupiah</span></li>
            <li><span>Foto kendaraan</span><span>Ilustrasi pengganti</span></li>
          </ul>
        </div>

        <div class="col-lg-3">
          <h5>DulAuto</h5>
          <p>Jelajahi kendaraan berdasarkan informasi yang tersedia dan gunakan filter untuk menemukan pilihan yang sesuai.</p>
          <a href="{{ route('inventory.index') }}" class="btn btn-ghost btn-sm">Lihat katalog</a>
        </div>
      </div>

      <div class="ah-footer-bottom">
        <p class="m-0">&copy; <span data-year>{{ now()->year }}</span> DulAuto. Hak cipta dilindungi. Dibangun dengan Bootstrap 5.</p>
      </div>
    </div>
  </footer>
